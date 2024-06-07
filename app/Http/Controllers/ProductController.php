<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

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
        $product = Product::all();
        return view('admin.quan-li-san-pham', compact('product'));
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
        return view('admin.them-san-pham', compact('category', 'color', 'size','brand'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $request->validate([
            'dongia' => 'required|numeric|min:1',
            'giamgia' => 'required|numeric|max:100',
            'tensanpham' => 'required|unique:sanpham,tensanpham',
            'loaisanpham' => 'required',
            'nhanhieu' => 'required',
            'mota' => 'required',

        ], [
            'giamgia.max' => 'Không được quá 100',
            'giamgia.required' => 'Không được để trống',
            'giamgia.numeric' => 'Phải là một số',
            'dongia.min' => 'Phải lớn hơn 0',
            'dongia.required' => 'Không được để trống',
            'loaisanpham.required' => 'Không được để trống',
            'nhanhieu.required' => 'Không được để trống',
            'mota.required' => 'Không được để trống',
            'tensanpham' => 'Không được để trống',
            'tensanpham.unique' => 'Tên sản phẩm đã tồn tại',

        ]);
        $product = new Product;
        $product->tensanpham = $request->input('tensanpham');
        $product->loaisp_id = $request->input('loaisanpham');
        $product->nh_id = $request->input('nhanhieu');
        $product->mota = $request->input('mota');
        $product->dongia = $request->input('dongia');
        $product->giamgia = $request->input('giamgia');
        $product->trangthai = '0';
        $product->save();

        foreach ($request->file('images') as $image) {
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
    public function show(Product $product)
    {
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
    public function update(UpdateProductRequest $request, Product $product)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
    }
}