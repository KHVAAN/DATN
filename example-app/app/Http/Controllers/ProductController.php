<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;
use App\Models\Image;
use App\Models\Size;
use App\Models\Color;
use App\Models\Brand;
use App\Models\Product_detail;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function index_ad()
    {
        $product = Product::with(['category', 'brand'])->get(); // Lấy tất cả sản phẩm kèm theo loại sản phẩm và nhãn hiệu
        return view('admin.quan-li-san-pham', compact('product')); // Truyền biến product tới view
    }
    public function index_user()
    {
        $name_brand = ['Yame', 'Ben & Tod', 'Chuottrang', 'SomeHow', 'Uniqlo'];
        // Lấy thông tin về các nhãn hiệu
        $brands = Brand::whereIn('tennhanhieu', $name_brand)->get();
        // Lấy các sản phẩm thuộc các nhãn hiệu trên
        $brand_detail = Product::whereIn('nh_id', $brands->pluck('id'))->get();
        $products = Product::where('trangthai', 1) // Lọc sản phẩm có trạng thái = 1 (hoặc có thể lọc theo điều kiện khác)
            ->orderByDesc('created_at') // Sắp xếp theo thời gian tạo mới nhất
            ->with('image') // Load các hình ảnh liên kết
            ->get(); // Lấy danh sách các sản phẩm
        return view('user.index', compact('brand_detail', 'brands', 'products'));
    }

    public function create()
    {
        $category = Category::where('trangthai', 0)->get();
        $color = Color::where('trangthai', 0)->get();
        $size = Size::where('trangthai', 0)->get();
        $brand = Brand::where('trangthai', 0)->get();
        return view('admin.them-san-pham', compact('category', 'color', 'size', 'brand'));
    }

    public function store(Request $request)
    {
        // Kiểm tra dữ liệu request
        //dd($request->all());

        $request->validate([
            'dongia' => 'required|numeric|min:1',
            'giamgia' => 'required|numeric|max:100',
            'tensanpham' => 'required|unique:product,tensanpham',
            'loaisp_id' => 'required',
            'nh_id' => 'required',
            'mota' => 'required',
            'soluong' => 'required|integer|min:0',
        ], [
            'giamgia.max' => 'Không được quá 100',
            'giamgia.required' => 'Không được để trống',
            'giamgia.numeric' => 'Phải là một số',
            'dongia.min' => 'Phải lớn hơn 0',
            'dongia.required' => 'Không được để trống',
            'loaisp_id.required' => 'Không được để trống',
            'nh_id.required' => 'Không được để trống',
            'mota.required' => 'Không được để trống',
            'tensanpham.required' => 'Không được để trống',
            'tensanpham.unique' => 'Tên sản phẩm đã tồn tại',
            'soluong.required' => 'Không được để trống',
            'soluong.integer' => 'Phải là số nguyên',
            'soluong.min' => 'Không được nhỏ hơn 0',
        ]);

        $product = new Product;
        $product->tensanpham = $request->input('tensanpham');
        $product->loaisp_id = $request->input('loaisp_id');
        $product->nh_id = $request->input('nh_id');
        $product->mota = $request->input('mota');
        $product->dongia = $request->input('dongia');
        $product->giamgia = $request->input('giamgia');
        $product->soluong = $request->input('soluong');
        $product->trangthai = $request->input('trangthai', '0');
        $product->save();

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $filename = $image->getClientOriginalName();
                $path = $image->storeAs('public/upload', $filename); // Lưu ảnh vào thư mục public/upload
                $hinhAnh = new Image;
                $hinhAnh->sp_id = $product->id;
                $hinhAnh->tenimage = 'upload/' . $filename; // Lưu đường dẫn ảnh vào cơ sở dữ liệu
                $hinhAnh->save();
            }
        }
        Alert()->success('Thành công', 'Thêm sản phẩm thành công');
        return redirect()->back();
    }


    public function show($id)
    {
        $category = Category::where('trangthai', 0)->get();
        $brand = Brand::where('trangthai', 0)->get();
        $product = Product::find($id); // Lấy sản phẩm được chọn
        $image = Image::where('sp_id', $id)->get();
        // $sanphamcon = ChiTietSanPham::where('sanpham_id', $id)->get();
        return view('admin.chi-tiet-san-pham', compact('product', 'category', 'brand', 'image'));
    }

    public function create_child(string $id)
    {
        $product = Product::findOrFail($id);
        $colors = Color::all();
        $sizes = Size::all();
        $subProducts = Product_detail::where('sanpham_id', $id)->with(['color', 'size'])->get();
        // Tính tổng số lượng tồn kho
        $total = $subProducts->sum('soluong');
        return view('admin.them-san-pham-con', compact('product', 'colors', 'sizes', 'subProducts','total'));
    }

    // Xử lý thêm sản phẩm con
    public function add_child(Request $request, $id)
    {
        $request->validate([
            'size' => 'nullable|exists:size,id',
            'mau' => 'required|exists:color,id',
            'soluong' => 'required|integer|min:1',
        ]);

        $existingProductDetail = Product_detail::where('sanpham_id', $id)
            ->where('mau_id', $request->input('mau'))
            ->where('size_id', $request->input('size'))
            ->first();

        if ($existingProductDetail) {
            $existingProductDetail->soluong += $request->input('soluong');
            $existingProductDetail->save();
            Alert()->success('Thành công', 'Số lượng sản phẩm con đã được cập nhật.');

        } else {
            $productDetail = new Product_detail();
            $productDetail->sanpham_id = $id;
            $productDetail->mau_id = $request->input('mau');
            $productDetail->size_id = $request->input('size');
            $productDetail->soluong = $request->input('soluong');
            $productDetail->save();
            Alert()->success('Thành công', 'Sản phẩm con được thêm thành công.');

        }
        return redirect()->back();
    }


    // Xử lý xóa sản phẩm con
    public function delete_child($id)
    {
        $productDetail = Product_detail::findOrFail($id);
        $productDetail->delete();
        Alert()->success('Thành công', 'Xóa sản phẩm con thành công');
        return redirect()->back();
    }
    public function edit($id)
    {
        $product = Product::with('image')->findOrFail($id);
        $category = Category::all();
        $brand = Brand::all();

        return view('admin.chinh-sua-san-pham', compact('product', 'category', 'brand'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'dongia' => 'required|numeric|min:1',
            'giamgia' => 'required|numeric|max:100',
            'tensanpham' => 'required|unique:product,tensanpham,' . $id,
            'loaisp_id' => 'required',
            'nhanhieu_id' => 'required',
            'mota' => 'required',
            'soluong' => 'required|integer|min:0',
        ], [
            'giamgia.max' => 'Không được quá 100',
            'giamgia.required' => 'Không được để trống',
            'giamgia.numeric' => 'Phải là một số',
            'dongia.min' => 'Phải lớn hơn 0',
            'dongia.required' => 'Không được để trống',
            'loaisp_id.required' => 'Không được để trống',
            'nhanhieu_id.required' => 'Không được để trống',
            'mota.required' => 'Không được để trống',
            'tensanpham.required' => 'Không được để trống',
            'tensanpham.unique' => 'Tên sản phẩm đã tồn tại',
            'soluong.required' => 'Không được để trống',
            'soluong.integer' => 'Phải là số nguyên',
            'soluong.min' => 'Không được nhỏ hơn 0',
        ]);

        $product = Product::findOrFail($id);
        $product->tensanpham = $request->input('tensanpham');
        $product->loaisp_id = $request->input('loaisp_id');
        $product->nh_id = $request->input('nhanhieu_id');
        $product->mota = $request->input('mota');
        $product->dongia = $request->input('dongia');
        $product->giamgia = $request->input('giamgia');
        $product->soluong = $request->input('soluong');
        $product->trangthai = $request->input('trangthai', '0');
        $product->save();

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('upload'), $filename);
                $hinhAnh = new Image;
                $hinhAnh->sp_id = $product->id;
                $hinhAnh->tenimage = 'upload/' . $filename;
                $hinhAnh->save();
            }
        }

        Alert()->success('Thành công', 'Cập nhật sản phẩm thành công');
        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        Image::where('sp_id', $product->id)->delete();
        $product->delete();
        alert()->success('Thành công', 'Xóa sản phẩm thành công');
        return redirect()->back();
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        // Thực hiện tìm kiếm trong cơ sở dữ liệu
        $product = Product::where('tensanpham', 'like', '%' . $search . '%')->get();

        return view('user.tim-kiem', compact('product'));
    }


    public function detail(string $id, Request $request)
    {
        $product = Product::find($id);

        $image = Image::where('sp_id', $id)->get();
        $giamgia = $product->giamgia;
        $dongia = $product->dongia;

        // Lấy chi tiết màu sắc độc nhất
        $uniqueDetails = Product_detail::where('sanpham_id', $id)->get()->unique('color.tenmau');

        // Lấy tất cả chi tiết sản phẩm
        $allDetails = Product_detail::where('sanpham_id', $id)->get();

        $colorId = $request->input('color');
        $sizeId = $request->input('size');

        // Lấy tên kích cỡ
        $size = Size::find($sizeId);
        $sizeName = $size->tensize ?? NULL;

        // Lấy kích cỡ khả dụng cho màu đã chọn
        $availableSizes = Product_detail::select('size_id')
            ->where('sanpham_id', $id)
            ->where('mau_id', $colorId)
            ->distinct()->get();

        // Lấy chi tiết màu sắc đã chọn
        $color = Color::find($colorId);
        $colorName = $color->tenmau ?? NULL;
        $colorId = $color->id ?? NULL;

        // Lấy chi tiết sản phẩm cho màu sắc và kích cỡ đã chọn
        $productDetail = Product_detail::where('sanpham_id', $id)
            ->where('mau_id', $colorId)
            ->where('size_id', $sizeId)
            ->first();

        $quantity = $productDetail->soluong ?? NULL;

        // // Lấy bình luận cho sản phẩm
        // $reviews = Review::where('product_id', $id)->get();


        return view('user.detail', compact('quantity', 'sizeName', 'sizeId', 'colorId', 'colorName', 'productDetail', 'image', 'product', 'availableSizes', 'uniqueDetails'));
    }
}