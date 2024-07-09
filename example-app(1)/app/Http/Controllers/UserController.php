<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('phanquyen', 2);

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('hovaten', 'like', '%' . $search . '%')
                    ->orWhere('sdt', 'like', '%' . $search . '%')
                    ->orWhere('ngaysinh', 'like', '%' . $search . '%')
                    ->orWhere('diachi', 'like', '%' . $search . '%');
            });
        }

        $user = $query->paginate(10);
        return view('admin.quan-li-khach-hang', compact('user'));
    }

    public function show($id)
    {
        $user = User::where('id', $id)->first();
        return view('admin.chi-tiet-user', compact('user'));
    }
}