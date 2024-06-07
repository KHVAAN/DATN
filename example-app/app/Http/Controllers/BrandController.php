<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brand = Brand::all();
        return view('admin.danh-sach-chung', compact('brand'));
    }

    public function store(Request $request)
    {
        //dd($request->all()); // Thêm dòng này để kiểm tra giá trị request
        
        $request->validate([
            'tennhanhieu' => 'required|max:30|unique:brand,tennhanhieu',
            'trangthai' => 'required|in:0,1',
        ], [
            'trangthai.required' => 'Không được để trống',
            'trangthai.in' => 'Giá trị trạng thái không hợp lệ',
            'tennhanhieu.unique' => 'Tên nhãn hiệu sản phẩm đã tồn tại',
            'tennhanhieu.max' => 'Không quá 30 ký tự',
            'tennhanhieu.required' => 'Không được để trống',
        ]);

        $brand = new Brand;
        $brand->tennhanhieu = $request->input('tennhanhieu');
        $brand->trangthai = $request->input('trangthai');
        $brand->save();

        Alert()->success('Thành công', 'Nhãn hiệu đã được thêm thành công');
        return redirect()->back();
    }
}