<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $user = User::where('phanquyen', 1)->get();
        return view('admin.quan-li-nhan-vien', compact('user'));
    }

    public function create()
    {
        $admin = User::where('trangthai', 0)->get();
        return view('admin.them-admin', compact('admin'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'sdt' => 'required|size:10',
            'hovaten' => 'required|max:30',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:6',
            'diachi' => 'required|max:255',
            'phanquyen' => 'required',
            'gioitinh' => 'required',
            'ngaysinh' => 'required|date',
        ], [
            'sdt.required' => 'Không được để trống',
            'sdt.size' => 'Số điện thoại phải đủ 10 số',
            'email.required' => 'Không được để trống',
            'email.unique' => 'email đã tồn tại',
            'email.email' => 'Định dạng không hợp lệ',
            'hovaten.required' => 'Không được để trống',
            'hovaten.max' => 'Mật khẩu không quá 30 ký tự',
            'password.required' => 'Không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'diachi.max' => 'Địa chỉ không quá 255 ký tự',
            'diachi.required' => 'Không được để trống',
            'phanquyen.required' => 'Không được để trống',
            'gioitinh.required' => 'Không được để trống',
            'ngaysinh.required' => 'Không được để trống',
            'ngaysinh.date' => 'Ngày sinh không hợp lệ',
        ]);

        $user = new User;
        $user->sdt = $request->input('sdt');
        $user->password = Hash::make($request->input('password'));
        $user->hovaten = $request->input('hovaten');
        $user->email = $request->input('email');
        $user->diachi = $request->input('diachi');
        $user->phanquyen = $request->input('phanquyen');
        $user->gioitinh = $request->input('gioitinh');
        $user->ngaysinh = $request->input('ngaysinh');
        $user->save();
        Alert()->success('Thành công', 'Thêm quản trị viên thành công.');
        return \redirect()->back();
    }

    public function show($id)
    {
        $user = User::where('id', $id)->first();
        return view('admin.chi-tiet-admin', compact('user'));
    }
}