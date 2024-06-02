<?php

use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
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

Route::get('/login', function () {
    return view('login');
});


Route::get('/register', function () {
    return view('register');
});

Route::get('/', function () {
    return view('user.index');
});

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
Route::get('/bang-dieu-khien', function () {
    return view('admin.bang-dieu-khien');
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

Route::get('/them-tien-luong', function () {
    return view('admin.them-tien-luong');
});