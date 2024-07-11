<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // public function add(Request $request)
    // {
    //     $productId = $request->input('product_id');

    //     // Kiểm tra xem sản phẩm đã có trong danh sách yêu thích của người dùng chưa
    //     $wishlistItem = Wishlist::where('user_id', Auth::id())
    //         ->where('product_id', $productId)
    //         ->first();

    //     if ($wishlistItem) {
    //         alert()->success('Chú ý', 'Sản phẩm đã có trong danh sách yêu thích.');
    //         return \redirect()->back();
    //     }

    //     // Nếu chưa có, thêm vào danh sách yêu thích
    //     $wishlist = new Wishlist();
    //     $wishlist->user_id = Auth::id();
    //     $wishlist->product_id = $productId;
    //     $wishlist->save();

    //     alert()->success('Thành công', 'Đã thêm vào danh sách yêu thích.');
    //     return \redirect()->back();
    // }
    public function add(Request $request)
    {
        $productId = $request->input('product_id');

        // Check if the product is already in the user's wishlist
        $wishlistItem = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if ($wishlistItem) {
            alert()->success('Chú ý', 'Sản phẩm đã có trong danh sách yêu thích.');
            return \redirect()->back();
        }

        // Add the product to the wishlist
        $wishlist = new Wishlist();
        $wishlist->user_id = Auth::id();
        $wishlist->product_id = $productId;
        $wishlist->save();

        alert()->success('Thành công', 'Đã thêm vào danh sách yêu thích.');
        return \redirect()->back();
    }
}
