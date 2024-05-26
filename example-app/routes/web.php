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


Route::get('/admin', function () {
    return view('admin.index');
});