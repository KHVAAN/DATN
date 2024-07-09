<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Product;
use App\Models\Product_detail;
use App\Models\Image;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('user.checkout');
    }
    public function create(Request $request)
    {
        if (Auth::check()) {
            // Lấy thông tin từ request
            $productId = $request->input('product_id');
            $sizeId = $request->input('size_id');
            $colorId = $request->input('mau_id');
            $quantity = $request->input('soluong');

            // Tìm thông tin chi tiết sản phẩm từ cơ sở dữ liệu
            $productDetail = Product_detail::where('sanpham_id', $productId)
                ->where('size_id', $sizeId)
                ->where('mau_id', $colorId)
                ->first();

            // Kiểm tra nếu không tìm thấy chi tiết sản phẩm, chuyển hướng về lại trang trước với thông báo lỗi
            if (!$productDetail) {
                return redirect()->back()->withErrors(['product' => 'Không tìm thấy chi tiết sản phẩm']);
            }

            // Tính toán giá đã giảm của sản phẩm
            $discountPercent = $productDetail->product->giamgia;
            $price = $productDetail->product->dongia;

            if ($discountPercent > 0) {
                $discountedPrice = $price - ($price * $discountPercent / 100);
            } else {
                $discountedPrice = $price; // Giá gốc nếu không có giảm giá
            }

            // Lấy thông tin hình ảnh của sản phẩm
            $images = Image::where('sp_id', $productDetail->sanpham_id)->get();
            $subtotal = $discountedPrice * $quantity; // Sử dụng giá đã giảm để tính tổng tiền

            // Tính toán phí vận chuyển
            $phigiaohang = 19000;
            if ($subtotal >= 299999) {
                $phigiaohang = 0;
            }

            // Tính toán tổng tiền và các chi phí liên quan (phí vận chuyển, ...)
            $total = $subtotal + $phigiaohang;

            // Lấy thông tin giao hàng từ người dùng đang đăng nhập
            $user = Auth::user(); // Lấy thông tin người dùng đang đăng nhập
            if ($user) {
                $deliveryInfo = [
                    'tenkhachhang' => $user->hovaten,
                    'sodienthoai' => $user->sdt,
                    'diachi' => $user->diachi,
                ];
            } else {
                $deliveryInfo = null; // Nếu không có người dùng đăng nhập
            }

            // Trả về view 'user.checkout' với các dữ liệu tính toán được
            return view('user.checkout', compact('subtotal', 'total', 'phigiaohang', 'productDetail', 'quantity', 'images', 'discountedPrice', 'deliveryInfo'));
        } else {
            return redirect()->route('dang-nhap'); // Nếu không đăng nhập, chuyển hướng đến trang đăng nhập
        }
    }

    public function payment(Request $request)
    {
        // Lấy thông tin người dùng đang đăng nhập
        $user = Auth::user();

        // Lấy thông tin sản phẩm từ request
        $productId = $request->input('product_id');
        $sizeId = $request->input('size_id');
        $colorId = $request->input('color_id');
        $quantity = $request->input('soluong'); // Sửa lại tên trường dữ liệu nếu cần thiết

        // Tìm chi tiết sản phẩm từ cơ sở dữ liệu
        $productDetail = Product_detail::where('sanpham_id', $productId)
            ->where('size_id', $sizeId)
            ->where('mau_id', $colorId)
            ->first();

        // Kiểm tra nếu không tìm thấy chi tiết sản phẩm
        if (!$productDetail) {
            return redirect()->back()->withErrors(['product' => 'Không tìm thấy chi tiết sản phẩm']);
        }

        // Tính toán giá đã giảm của sản phẩm
        $discountPercent = $productDetail->product->giamgia;
        $price = $productDetail->product->dongia;
        $discountedPrice = $discountPercent > 0 ? $price - ($price * $discountPercent / 100) : $price;

        // Tính toán tổng tiền hàng
        $subtotal = $discountedPrice * $quantity;

        // Tính toán phí vận chuyển
        $phigiaohang = 19000;
        if ($subtotal >= 299999) {
            $phigiaohang = 0;
        }

        // Tổng thanh toán
        $total = $subtotal + $phigiaohang;

        // Xử lý phương thức thanh toán được chọn
        $paymentMethod = $request->input('payment_method');

        if (!$paymentMethod) {
            return redirect()->back()->withErrors(['payment_method' => 'Vui lòng chọn phương thức thanh toán']);
        }

        // Xử lý theo phương thức thanh toán đã chọn
        if ($paymentMethod == 'momo') {
            // Xử lý cho Momo
        } elseif ($paymentMethod == 'vnpay') {
            // Xử lý cho Vnpay
        } elseif ($paymentMethod == 'cod') {
            // Tạo đơn hàng mới
            $order = new Order();
            $order->ma_kh = $user->id;
            $order->ngay_lap_hoa_don = now();
            $order->ngay_nhan_hang = now()->addDays(3); // Giả sử ngày nhận hàng sau 3 ngày
            $order->ttthanhtoan = 0; // Giả sử 0 là i "Chưa thanh toán"
            $order->ttvanchuyen = 0;// Giả sử 0 là  "Chưa vận chuyển"
            $order->trangthai = 0; // // Giả sử 0 là mã của trạng thái "Chưa xác nhận"
            $order->save();

            // Lưu chi tiết đơn hàng
            $orderDetail = new Order_detail();
            $orderDetail->ma_hd = $order->id;
            $orderDetail->sp_id = $productId;
            $orderDetail->mau_id = $colorId;
            $orderDetail->size_id = $sizeId;
            $orderDetail->soluong = $quantity;
            $orderDetail->giaohang = 'COD';
            $orderDetail->thanhtien = $total; // Tổng tiền hàng + phí vận chuyển
            $orderDetail->diachi = $user->diachi;
            $orderDetail->save();

            // Chuyển hướng người dùng sau khi đặt hàng thành công
            alert()->success('Thành công', 'Đặt hàng thành công');
            return redirect()->route('user.order');
        } else {
            return redirect()->back()->withErrors(['payment_method' => 'Phương thức thanh toán không hợp lệ']);
        }
    }


    //     public function show()
    //     {
    //         if (Auth::check()) {
    //             $user = Auth::user();
    //             $donhang = hoadonban::where('ma_kh', $user->id)->with('cthdb')->get();
    //             return view('user.don-hang', compact('donhang'));
    //         } else {
    //             return redirect()->route('dang-nhap');
    //         }
    //     }

    //     public function huyHang(string $id)
    //     {
    //         $hoadonban = hoadonban::find($id);
    //         $CTHDB = CTHDB::where('ma_hd', $hoadonban->id)->first();
    //         $sp = ChiTietSanPham::where('id', $CTHDB->chitietsp_id)->first();
    //         $sp->update(['soluong' => $CTHDB->soluong + $sp->soluong]);
    //         $hoadonban->update(['ttvanchuyen' => 3, 'updated_at' => Carbon::now()]);

    //         return redirect()->back();
    //     }

    //     public function nhanHang(string $id)
    //     {
    //         $hoadonban = hoadonban::find($id);
    //         $hoadonban->update(['ttvanchuyen' => 2, 'updated_at' => Carbon::now()]);

    //         return redirect()->back();
    //     }

    //     public function hoanTra(string $id)
    //     {
    //         $hoadonban = hoadonban::find($id);
    //         $CTHDB = CTHDB::where('ma_hd', $hoadonban->id)->first();
    //         $sp = ChiTietSanPham::where('id', $CTHDB->chitietsp_id)->first();
    //         $sp->update(['soluong' => $CTHDB->soluong + $sp->soluong]);

    //         $hoadonban->update(['ttvanchuyen' => 4, 'updated_at' => Carbon::now()]);
    //         return redirect()->back();
    //     }

    //     public function diaChiIndex()
    //     {
    //         if (Auth::check()) {
    //             $user = Auth::user();
    //             $diachi = diachi::where('user_id', $user->id)->get();
    //             return view('user.dia-chi', compact('diachi'));
    //         } else {
    //             return view('login');
    //         }
    //     }
}