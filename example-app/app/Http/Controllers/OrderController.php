<?php

namespace App\Http\Controllers;

use App\Models\Product_detail;
use App\Models\Product;
use App\Models\Order;
use App\Models\Order_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function buy(Request $request)
    {
        dd($request->all());
        // Kiểm tra người dùng đã đăng nhập hay chưa
        if (!Auth::check()) {
            return redirect()->route('dang-nhap');
        }

        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();

        // Lấy thông tin sản phẩm từ request
        $productId = $request->input('product_id');
        $sizeId = $request->input('size_id'); // Đảm bảo lấy size_id từ request
        $colorId = $request->input('mau_id'); // Đảm bảo lấy mau_id từ request
        $quantity = $request->input('soluong');

        // Tìm sản phẩm trong cơ sở dữ liệu
        $product = Product::find($productId);
        if (!$product) {
            alert()->error('Lỗi', 'Không tìm thấy sản phẩm.');
            return redirect()->back();
        }

        // Tìm chi tiết sản phẩm dựa trên sản phẩm, màu sắc và kích thước
        $productDetail = Product_detail::where('sanpham_id', $productId)
            ->where('size_id', $sizeId)
            ->where('mau_id', $colorId)
            ->first();

        if (!$productDetail || $productDetail->soluong < $quantity) {
            alert()->error('Lỗi', 'Sản phẩm đã hết hàng hoặc không đủ số lượng.');
            return redirect()->back();
        }

        // Tạo đơn hàng mới
        $order = new Order();
        $order->ma_kh = $user->id;
        $order->ngay_lap_hoa_don = now();
        $order->ngay_nhan_hang = null; // Giả sử ngày nhận hàng để trống ban đầu
        $order->ttthanhtoan = 0; // Trạng thái thanh toán mặc định là 0
        $order->ttvanchuyen = 0; // Trạng thái vận chuyển mặc định là 0
        $order->trangthai = 1; // Trạng thái đơn hàng mặc định là 1 (ví dụ: đã xác nhận)
        $order->tong_tien = $product->dongia * $quantity; // Tính tổng tiền đơn hàng
        $order->save(); // Lưu đơn hàng vào cơ sở dữ liệu


        // Tạo chi tiết đơn hàng
        $orderDetail = new Order_detail();
        $orderDetail->ma_hd = $order->id; // ID của đơn hàng vừa tạo
        $orderDetail->sp_id = $productId; // ID của sản phẩm
        $orderDetail->chitietsp_id = $productDetail->id; // ID của chi tiết sản phẩm
        $orderDetail->soluong = $quantity; // Số lượng sản phẩm trong đơn hàng
        $orderDetail->giaohang = null; // Giả sử ngày giao hàng để trống ban đầu
        $orderDetail->thanhtien = $product->dongia * $quantity; // Tính thành tiền của chi tiết đơn hàng
        $orderDetail->diachi = null; // Địa chỉ giao hàng, có thể bổ sung thêm thông tin này
        $orderDetail->save(); // Lưu chi tiết đơn hàng vào cơ sở dữ liệu

        // Trừ số lượng sản phẩm trong kho
        $productDetail->soluong -= $quantity;
        $productDetail->save();


        // Thông báo thành công và chuyển hướng về trang chủ hoặc giỏ hàng
        alert()->success('Thành công', 'Đặt hàng thành công.');
        return redirect()->route('gio-hang');
    }
}