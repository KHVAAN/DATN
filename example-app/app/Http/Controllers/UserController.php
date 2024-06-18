<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $user = User::where('phanquyen', 2)->get();
        return view('admin.quan-li-khach-hang', compact('user'));
    }

    public function show($id)
    {
        $user = User::where('id', $id)->first();
        return view('admin.chi-tiet-khach-hang', compact('user'));
    }
}