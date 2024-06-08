<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;
use App\Models\Image;
use App\Models\Size;
use App\Models\Color;
use App\Models\Brand;

use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function index_ad()
    {
        $product = Product::with(['category', 'brand'])->get(); // Lấy tất cả sản phẩm kèm theo loại sản phẩm và nhãn hiệu
        return view('admin.quan-li-san-pham', compact('product')); // Truyền biến products tới view
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::where('trangthai', 0)->get();
        $color = Color::where('trangthai', 0)->get();
        $size = Size::where('trangthai', 0)->get();
        $brand = Brand::where('trangthai', 0)->get();
        return view('admin.them-san-pham', compact('category', 'color', 'size', 'brand'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Kiểm tra dữ liệu request
        dd($request->all());

        $request->validate([
            'dongia' => 'required|numeric|min:1',
            'giamgia' => 'required|numeric|max:100',
            'tensanpham' => 'required|unique:product,tensanpham',
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
            'tensanpham' => 'Không được để trống',
            'tensanpham.unique' => 'Tên sản phẩm đã tồn tại',
            'soluong.required' => 'Không được để trống',
            'soluong.integer' => 'Phải là số nguyên',
            'soluong.min' => 'Không được nhỏ hơn 0',
        ]);

        $product = new Product;
        $product->tensanpham = $request->input('tensanpham');
        $product->loaisp_id = $request->input('loaisp_id');
        $product->nh_id = $request->input('nhanhieu_id');
        $product->mota = $request->input('mota');
        $product->dongia = $request->input('dongia');
        $product->giamgia = $request->input('giamgia');
        $product->soluong = $request->input('soluong');
        $product->trangthai = $request->input('trangthai', '0');
        $product->save();

        foreach ($request->file('image') as $image) {
            $filename = $image->getClientOriginalName();
            $image->move(public_path('upload'), $filename);
            $hinhAnh = new Image;
            $hinhAnh->sp_id = $product->id;
            $hinhAnh->tenimage = 'upload/' . $filename;
            $hinhAnh->save();
        }
        Alert()->success('Thành công', 'Thêm sản phẩm thành công.');
        return redirect()->back();
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::where('trangthai', 0)->get();
        $brand = Brand::where('trangthai', 0)->get();
        $product = Product::find($id); // Lấy sản phẩm được chọn
        //$image = Image::where('sp_id', $id)->get();
        // $sanphamcon = ChiTietSanPham::where('sanpham_id', $id)->get();
        return view('admin.quan-li-san-pham', compact('product', 'category', 'brand'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Product $product)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
    }
}