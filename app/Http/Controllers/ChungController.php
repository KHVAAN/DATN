<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Brand;
use App\Models\Size;


class ChungController extends Controller
{
    public function index()
    {
        $brand = Brand::all();
        $size = Size::all();

        return view('admin.danh-sach-chung', compact('brand','size'));
    }

    public function store1(Request $request)
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

    public function store2(Request $request)
    {
        //dd($request->all()); // Thêm dòng này để kiểm tra giá trị request

        $request->validate([
            'tensize' => 'required|max:30|unique:size,tensize',
            'trangthai' => 'required|in:0,1',
        ], [
            'trangthai.required' => 'Không được để trống',
            'trangthai.in' => 'Giá trị trạng thái không hợp lệ',
            'tensize.max' => 'Không quá 30 ký tự',
            'tensize.unique' => 'Size sản phẩm đã tồn tại',
            'tensize.required' => 'Không được để trống',
        ]);
        $size = new Size;
        $size->tensize = $request->input('tensize');
        $size->trangthai = $request->input('trangthai');
        $size->save();
        Alert()->success('Thành công', 'Kích thước đã được thêm thành công');
        return \redirect()->back();
    }
}