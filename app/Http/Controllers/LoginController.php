<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(Request $request)
    {
        $tt = User::where('email',$request->input('email'))->first();
        $ttt = $tt->trangthai ?? null;
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Không được để trống',
            'email.email' => 'Định dạng không hợp lệ',
            'password.required' => 'Không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
        ]);
        $taiKhoan = $request->only('email', 'password');
        if(Auth::attempt($taiKhoan)){
            $user = Auth::user();
            session(['id' => $user->id,
            'name' => $user->hovaten,
            'chucvu' => $user->phanquyen,
            'avatar'=>$user->avatar,
        ]);
            $name = $user->hovaten;
            $phanQuyen = $user->phanquyen;
            $chuyenDoi = intval($phanQuyen);
            if($chuyenDoi == 1 && $ttt == 0){
                alert()->success('Đăng nhập thành công', 'Chào mừng ' . $name . ' đến với trang quản trị');
                return \redirect()->route('trang-chu');
            }elseif ($chuyenDoi == 2 && $ttt == 0) {
                return \redirect()->route('index');
            }
        }else{

                alert()->error('Đăng nhập không thành công', 'Tài khoản hoặc mật khẩu không chính xác! ');
                return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function index()
    {
        return view('admin.trang-chu');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function register(Request $request)
    {
        $request->validate([
            'hovaten' => 'required|max:30',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:6',
            'sdt' => 'required|size:10',
            'diachi' => 'required|max:255',
        ], [
            'sdt.required' => 'Không được để trống',
            'sdt.size' => 'Số điện thoại phải đủ 10 số',
            'diachi.max' => 'Địa chỉ không quá 255 ký tự',
            'email.unique' => 'Email đã tồn tại',
            'diachi.required' => 'Không được để trống',
            'hovaten.required' => 'Không được để trống',
            'hovaten.max' => 'Họ và tên không quá 30 ký tự',
            'email.required' => 'Không được để trống',
            'email.email' => 'Định dạng không hợp lệ',
            'password.required' => 'Không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
        ]);

        $password = $request->input('password');
        $user = new User();
        $user->sdt = $request->input('sdt');
        $user->password = Hash::make($password);
        $user->hovaten = $request->input('hovaten');
        $user->email = $request->input('email');
        $user->diachi = $request->input('diachi');
        $user->save();

        alert()->success('Đăng ký thành công', 'Bạn đã đăng ký thành công tài khoản');
        return redirect()->back();
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}