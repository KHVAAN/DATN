<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function add(Request $request)
    {
        $userId = Auth::id();
        $productId = $request->input('product_id');

        $favorite = Wishlist::firstOrCreate([
            'user_id' => $userId,
            'product_id' => $productId,
        ]);
        Alert()->success('Thành công', 'Đã thêm sản phẩm vào danh sách yêu thích');
        return redirect()->back();
    }
}