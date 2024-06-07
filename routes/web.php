<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\ChungController;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SizeController;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/**
 * Đăng nhập
 */
Route::get('/login', function () {
    return view('login');
})->name('dang-nhap');

Route::post('/login', [LoginController::class, 'login'])->name('xu-li-dang-nhap');
Route::post('/register', [LoginController::class, 'register'])->name('xu-li-dang-ki');

/**
 * đăng xuất
 */
Route::post('/logout', function () {
    Auth::logout();
    session()->flush();
    return redirect()->route('login');
})->name('dang-xuat');

Route::get('/register', function () {
    return view('register');
});

Route::get('/', function () {
    return view('user.index');
})->name('home');

Route::get('/shop', function () {
    return view('user.shop');
});

Route::get('/detail', function () {
    return view('user.detail');
});

Route::get('/cart', function () {
    return view('user.cart');
});

Route::get('/checkout', function () {
    return view('user.checkout');
});

Route::get('/contact', function () {
    return view('user.contact');
});

Route::get('/intro', function () {
    return view('user.intro');
});

// Admin (9)
Route::get('/trang-chu', function () {
    return view('admin.trang-chu');
});

Route::get('/quan-li-nhan-vien', function () {
    return view('admin.quan-li-nhan-vien');
});

Route::get('/quan-li-khach-hang', function () {
    return view('admin.quan-li-khach-hang');
});

Route::get('/quan-li-don-hang', function () {
    return view('admin.quan-li-don-hang');
});

Route::get('/quan-li-san-pham', function () {
    return view('admin.quan-li-san-pham');
});


Route::get('/doanh-thu', function () {
    return view('admin.doanh-thu');
});


Route::get('/them-san-pham', function () {
    return view('admin.them-san-pham');
});

Route::get('/them-don-hang', function () {
    return view('admin.them-don-hang');
});

Route::get('/them-nhan-vien', function () {
    return view('admin.them-nhan-vien');
});

Route::get('/danh-sach-chung', function () {
    return view('admin.danh-sach-chung');
});

Route::get('/trang-chu', function () {
    return view('admin.trang-chu');
})->name('trang-chu');

Route::get('/danh-sach-san-pham', [ProductController::class, 'index'])->name('danh-sach-san-pham');
Route::get('/them-san-pham', [ProductController::class, 'create'])->name('them-san-pham');
Route::post('/them-san-pham', [ProductController::class, 'store'])->name('xu-li-them-san-pham');

Route::get('/danh-sach-chung', [ChungController::class, 'index'])->name('danh-sach-chung');
Route::post('/them-nhan-hieu', [ChungController::class, 'store1'])->name('them-nhan-hieu');
Route::post('/them-kich-thuoc', [ChungController::class, 'store2'])->name('them-kich-thuoc');