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
use App\Models\Cart;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{


    public function index_ad(Request $request)
    {
        $query = Product::with(['category', 'brand']);

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('tensanpham', 'like', '%' . $search . '%')
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('tenloaisp', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('brand', function ($q) use ($search) {
                        $q->where('tennhanhieu', 'like', '%' . $search . '%');
                    });
            });
        }

        $product = $query->paginate(10);
        return view('admin.quan-li-san-pham', compact('product')); // Truyền biến product tới view
    }
    public function index_user()
    {
        $name_brand = ['Yame', 'Ben&Tod', 'Chuottrang', 'SomeHow', 'Uniqlo'];

        // Lấy thông tin về các nhãn hiệu
        $brands = Brand::whereIn('tennhanhieu', $name_brand)->get();

        // Lấy các sản phẩm thuộc các nhãn hiệu trên
        $brand_ids = $brands->pluck('id');
        $brand_detail = Product::whereIn('nh_id', $brand_ids)->get();

        // Lấy danh sách các sản phẩm chính
        $products = Product::where('trangthai', 0)
            ->whereIn('nh_id', $brand_ids)
            ->orderByDesc('created_at')
            ->with('image') // Load các ảnh liên kết
            ->get();

        // Tính toán số lượng sản phẩm trong giỏ hàng cho người dùng hiện tại
        // $count = Auth::check() ? Cart::where('user_id', Auth::id())->count() : 0;

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

        // if ($request->hasFile('image')) {
        //     foreach ($request->file('image') as $image) {
        //         $filename = $image->getClientOriginalName();
        //         $path = $image->storeAs('public/upload', $filename); // Lưu ảnh vào thư mục public/upload
        //         $hinhAnh = new Image;
        //         $hinhAnh->sp_id = $product->id;
        //         $hinhAnh->tenimage = 'upload/' . $filename; // Lưu đường dẫn ảnh vào cơ sở dữ liệu
        //         $hinhAnh->save();
        //     }
        // }
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $filenameWithExt = $image->getClientOriginalName(); // Lấy tên file gốc với đuôi mở rộng
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME); // Lấy tên file không có đuôi mở rộng
                $extension = $image->getClientOriginalExtension(); // Lấy đuôi mở rộng của file
                $fileNameToStore = $filename . '_' . time() . '.' . $extension; // Tên file mới
                $path = $image->storeAs('public/upload', $fileNameToStore); // Lưu ảnh vào thư mục public/upload

                // Lưu đường dẫn ảnh vào cơ sở dữ liệu
                $hinhAnh = new Image;
                $hinhAnh->sp_id = $product->id;
                $hinhAnh->tenimage = 'upload/' . $fileNameToStore;
                $hinhAnh->save();
            }

            Alert()->success('Thành công', 'Thêm sản phẩm thành công');
            return redirect()->back();
        }
    }


    public function show($id)
    {
        $category = Category::where('trangthai', 0)->get();
        $brand = Brand::where('trangthai', 0)->get();
        $product = Product::find($id); // Lấy sản phẩm được chọn
        $image = Image::where('sp_id', $id)->get();
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
        return view('admin.them-san-pham-con', compact('product', 'colors', 'sizes', 'subProducts', 'total'));
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
        $product = Product::findOrFail($id);
        $category = Category::all();
        $brand = Brand::all();
        $image = Image::where('sp_id', $id)->get();
        return view('admin.chinh-sua-san-pham', compact('product', 'category', 'brand', 'image'));
    }
    public function update(Request $request, $id)
    {
        //dd($request->all()); // In ra để kiểm tra dữ liệu gửi đi từ form

        $request->validate(
            [
                'dongia' => 'required|numeric|min:1',
                'giamgia' => 'required|numeric|max:100',
                'tensanpham' => 'required|unique:product,tensanpham,' . $id,
                'loaisp_id' => 'required',
                'nhanhieu_id' => 'required',
                'mota' => 'required',
                'soluong' => 'required|integer|min:0',
            ],
            [
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
            ]
        );

        $product = Product::findOrFail($id);
        $product->fill($request->all());
        $product->trangthai = $request->input('trangthai', '0');
        $product->save();

        // Xóa hình ảnh cũ của sản phẩm (nếu cần thiết)
        //$product->image()->delete();

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $filenameWithExt = $image->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $path = $image->storeAs('public/upload', $fileNameToStore);
                $hinhAnh = new Image;
                $hinhAnh->sp_id = $product->id;
                $hinhAnh->tenimage = 'upload/' . $fileNameToStore;
                $hinhAnh->save();
            }
        }

        Alert()->success('Thành công', 'Cập nhật sản phẩm thành công');
        return redirect()->back();
    }



    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->image()->delete();
        $product->productDetails()->delete();
        $product->delete();
        alert()->success('Thành công', 'Xóa sản phẩm thành công');
        return redirect()->back();
    }




    public function detail($id)
    {
        $product = Product::find($id);
        if (!$product) {
            abort(404); // Xử lý khi không tìm thấy sản phẩm
        }

        // Lấy tất cả các chi tiết sản phẩm
        $allDetails = Product_detail::where('sanpham_id', $id)->get();

        // Lấy các chi tiết sản phẩm duy nhất theo màu và kích thước
        $uniqueDetails = $allDetails->unique(function ($item) {
            return $item->mau_id . '-' . $item->size_id;
        });

        // Lấy màu và kích thước mặc định từ chi tiết sản phẩm đầu tiên (nếu có)
        $defaultDetail = $allDetails->first();
        $defaultColor = $defaultDetail ? $defaultDetail->mau_id : null;
        $defaultSize = $defaultDetail ? $defaultDetail->size_id : null;

        // Lấy tên màu và kích thước mặc định
        $color = Color::find($defaultColor);
        $size = Size::find($defaultSize);
        $colorName = $color ? $color->tenmau : null;
        $sizeName = $size ? $size->tensize : null;

        // Lấy danh sách các size và màu sắc có sẵn
        $availableSizes = Product_detail::select('size_id')->where('sanpham_id', $id)
            ->where('mau_id', $defaultColor)->distinct()->get();
        $availableColors = Product_detail::select('mau_id')->where('sanpham_id', $id)
            ->where('size_id', $defaultSize)->distinct()->get();

        // Lấy chi tiết sản phẩm mặc định
        $productDetail = Product_detail::where('sanpham_id', $id)
            ->where('mau_id', $defaultColor)
            ->where('size_id', $defaultSize)->first();

        // Lấy các hình ảnh của sản phẩm
        $image = Image::where('sp_id', $id)->get();

        // Lấy chi tiết sản phẩm mặc định
        $quantity = $productDetail ? $productDetail->soluong : null;

        // Tính tổng số lượng sản phẩm
        $product->totalStock = $allDetails->sum('soluong');

        return view('user.detail', compact('quantity', 'sizeName', 'colorName', 'productDetail', 'image', 'product', 'availableSizes', 'availableColors', 'uniqueDetails'));
    }

    public function shop()
    {
        // Lấy danh sách các sản phẩm chính

        $products = Product::where('trangthai', 0)
            ->with('image') // Load các ảnh liên kết
            ->paginate(9); // Giới hạn 9 sản phẩm mỗi trang
        return view('user.shop', compact('products'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $products = Product::where('tensanpham', 'like', "%$searchTerm%")
            ->where('trangthai', 0)
            ->paginate(9);

        return view('user.shop', compact('products'));
    }

    public function sort(Request $request)
    {

        $products = Product::query();

        // Xử lý sắp xếp theo giá
        if ($request->has('sort')) {
            if ($request->sort == 'gia-asc') {
                $products->orderBy('dongia', 'asc');
            } elseif ($request->sort == 'gia-desc') {
                $products->orderBy('dongia', 'desc');
            }
        }

        $products = $products->paginate(9); // hoặc bất kỳ phương thức lấy dữ liệu nào khác của bạn

        return view('user.shop', compact('products'));
    }
    public function filterByPrice(Request $request)
    {
        $query = Product::query();

        // Xử lý lọc theo giá dựa trên dữ liệu từ form
        if ($request->has('price_all')) {
            // Lọc tất cả sản phẩm (không áp dụng filter giá)
        } else {
            // Xử lý các khoảng giá được chọn
            $priceRanges = $request->input('price_range');

            foreach ($priceRanges as $range) {
                if ($range == 2) {
                    $query->orWhereBetween('dongia', [0, 500000]);
                } elseif ($range == 3) {
                    $query->orWhereBetween('dongia', [500001, 1000000]);
                }
                // Thêm các khoảng giá khác tương tự
            }
        }

        $products = $query->paginate(9); // Số sản phẩm trên mỗi trang

        return view('user.shop', compact('products'));
    }
}