<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Product_detail;
use App\Models\Image;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        // $cartItems = $request->input('cart_items');

        // foreach ($cartItems as $itemId => $checked) {
        //     $cartItem = Cart::find($itemId);
        //     if ($cartItem) {
        //         $cartItem->checked = $checked == 'true'; // Convert 'true'/'false' string to boolean
        //         $cartItem->save();
        //     }
        // }

        $user = Auth::user();
        if ($user) {
            $giohang = Cart::with('productDetail')
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc') // Sắp xếp theo thứ tự giảm dần của thời gian thêm vào
                ->get();
            $tong = 0;

            foreach ($giohang as $item) {
                $tong += $item->dongia * $item->soluong;
            }

            // Retrieve images related to product details in the cart
            $images = Image::whereIn('sp_id', $giohang->pluck('productDetail.id'))->get();

            return view('user.cart', compact('giohang', 'tong', 'images'));
        } else {
            return redirect()->route('dang-nhap');
        }
    }

    public function add(Request $request)
    {
        // Kiểm tra người dùng đã đăng nhập hay chưa
        if (!Auth::check()) {
            return redirect()->route('dang-nhap');
        }

        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();

        // Lấy thông tin sản phẩm từ request
        $productId = $request->input('product_id');
        $sizeId = $request->input('size_id');
        $colorId = $request->input('mau_id');
        $quantity = $request->input('soluong');

        // Tìm sản phẩm trong cơ sở dữ liệu
        $product = Product::find($productId);
        if (!$product) {
            alert()->error('Lỗi', 'Không tìm thấy sản phẩm.');
            return redirect()->back();
        }

        // Tìm chi tiết sản phẩm dựa trên sản phẩm, màu sắc và kích thước
        $productDetail = Product_detail::where('sanpham_id', $productId)
            ->where('mau_id', $colorId)
            ->where('size_id', $sizeId)
            ->first();

        if (!$productDetail) {
            alert()->error('Lỗi', 'Không tìm thấy chi tiết sản phẩm với các thông tin đã chọn.');
            return redirect()->back();
        }

        // Tính giá cuối cùng của sản phẩm sau khi áp dụng giảm giá (nếu có)
        $discount = $product->giamgia;
        $price = $product->dongia;
        $discountAmount = ($price * $discount) / 100;
        $finalPrice = $price - $discountAmount;

        // Kiểm tra xem sản phẩm đã có trong giỏ hàng của người dùng hay chưa
        $cartItem = Cart::where('user_id', $user->id)
            ->where('product_detail_id', $productDetail->id)
            ->first();

        if ($cartItem) {
            // Nếu sản phẩm đã có trong giỏ hàng, cập nhật số lượng
            $cartItem->soluong += $quantity;
            $cartItem->save();
        } else {
            // Nếu sản phẩm chưa có trong giỏ hàng, thêm mới vào giỏ hàng
            $cart = new Cart();
            $cart->user_id = $user->id;
            $cart->product_id = $productId;
            $cart->product_detail_id = $productDetail->id;
            $cart->color_id = $colorId;
            $cart->size_id = $sizeId;
            $cart->soluong = $quantity;
            $cart->dongia = $finalPrice;
            $cart->save();
        }

        // Hiển thị thông báo thành công và redirect về trang trước
        alert()->success('Thành công', 'Sản phẩm đã được thêm vào giỏ hàng');
        return redirect()->back();
    }
    public function destroy($id)
    {
        // Tìm sản phẩm trong giỏ hàng theo ID
        $cart = Cart::findOrFail($id);
        $cart->delete();
        alert()->success('Thành công', 'Sản phẩm đã được xóa khỏi giỏ hàng');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $cartItem = Cart::find($id);
        if ($cartItem) {
            $cartItem->soluong = $request->input('soluong');
            $cartItem->save();

            return response()->json(['success' => true, 'total' => $cartItem->dongia * $cartItem->soluong]);
        }
        return response()->json(['success' => false, 'message' => 'Item not found'], 404);
    }

}