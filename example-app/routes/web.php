<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChungController;
use App\Http\Controllers\ColorController;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SizeController;
use App\Models\Brand;
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

Route::get('/quan-li-san-pham', [ProductController::class, 'index_ad'])->name('quan-li-san-pham');
// Hiển thị trang quản lí sản phẩm

Route::get('/them-san-pham', [ProductController::class, 'create'])->name('them-san-pham');
// Hiển thị form thêm sản phẩm

Route::post('/them-san-pham', [ProductController::class, 'store'])->name('xu-li-them-san-pham');
// Xử lí thông tin thêm sản phẩm từ form

Route::get('/chi-tiet-san-pham/{id}', [ProductController::class, 'show'])->name('chi-tiet-san-pham');
// Hiển thị chi tiết sản phẩm dựa trên ID

Route::get('/danh-sach-chung', [ChungController::class, 'index'])->name('danh-sach-chung');
// Hiển thị danh sách các thông tin chung (nhãn hiệu, kích thước, màu sắc, loại)

Route::post('/them-nhan-hieu', [ChungController::class, 'store1'])->name('them-nhan-hieu');
Route::get('/chinh-sua-nhan-hieu/{id}', [BrandController::class, 'edit'])->name('chinh-sua-nhan-hieu');
Route::post('/cap-nhat-nhan-hieu/{id}', [BrandController::class, 'update'])->name('cap-nhat-nhan-hieu');
Route::delete('/xoa-nhan-hieu/{id}', [BrandController::class, 'destroy'])->name('xoa-nhan-hieu');

Route::post('/them-kich-thuoc', [ChungController::class, 'store2'])->name('them-kich-thuoc');
Route::get('/chinh-sua-kich-thuoc/{id}', [SizeController::class, 'edit'])->name('chinh-sua-kich-thuoc');
Route::post('/cap-nhat-kich-thuoc/{id}', [SizeController::class, 'update'])->name('cap-nhat-kich-thuoc');
Route::delete('/xoa-kich-thuoc/{id}', [SizeController::class, 'destroy'])->name('xoa-kich-thuoc-hieu');

Route::post('/them-mau-sac', [ChungController::class, 'store3'])->name('them-mau-sac');
Route::get('/chinh-sua-mau-sac/{id}', [ColorController::class, 'edit'])->name('chinh-sua-mau-sac');
Route::post('/cap-nhat-mau-sac/{id}', [ColorController::class, 'update'])->name('cap-nhat-mau-sac');
Route::delete('/xoa-mau-sac/{id}', [ColorController::class, 'destroy'])->name('xoa-mau-sac');

Route::post('/them-loai', [ChungController::class, 'store4'])->name('them-loai');
Route::get('/chinh-sua-loai/{id}', [CategoryController::class, 'edit'])->name('chinh-sua-loai');
Route::post('/cap-nhat-loai/{id}', [CategoryController::class, 'update'])->name('cap-nhat-loai');
Route::delete('/xoa-loai/{id}', [CategoryController::class, 'destroy'])->name('xoa-loai');


Route::get('/quan-li-nhan-vien', [AdminController::class, 'index'])->name('quan-li-nhan-vien');
// Hiển thị trang quản lí nhân viên

Route::get('/them-admin', [AdminController::class, 'create'])->name('them-admin');
// Hiển thị form thêm nhân viên quản trị

Route::post('/them-admin', [AdminController::class, 'store'])->name('xu-li-them-admin');
// Xử lí thông tin thêm nhân viên quản trị từ form