<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Size;

class SizeController extends Controller
{
    public function index()
    {
        $size = Size::all();
        return view('admin.danh-sach-chung', compact('size'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'tensize' => 'required|max:30|unique:size,tensize',
            'trangthai' => 'required',
        ], [
            'trangthai.required' => 'Không được để trống',
            'tensize.max' => 'Không quá 30 ký tự',
            'tensize.unique' => 'Size sản phẩm đã tồn tại',
            'tensize.required' => 'Không được để trống',
        ]);
        $size = new Size;
        $size->tensize = $request->input('tensize');
        $size->trangthai = $request->input('trangthai');
        $size->save();
        Alert()->success('Thành công', 'Thêm kích thước mới thành công.');
        return \redirect()->back();
    }
}