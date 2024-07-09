<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Order;
use App\Models\Order_detail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Product_detail;
use Illuminate\Support\Facades\Log;

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

    public function profile()
    {
        return view('user.profile');
    }
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // Validate input
        $request->validate([
            'hovaten' => 'required|string|max:255',
            'sodienthoai' => 'required|string|max:20',
            'diachi' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gioitinh' => 'nullable|in:Nam,Nữ',
            'ngaysinh' => 'nullable|date',
        ]);

        // Update user data
        $user->hovaten = $request->hovaten;
        $user->sdt = $request->sodienthoai;
        $user->diachi = $request->diachi;
        $user->gioitinh = $request->gioitinh;
        $user->ngaysinh = $request->ngaysinh;

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::delete('public/' . $user->avatar);
            }
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        $user->save();

        Alert()->success('Thành công', 'Cập nhật tài khoản khách hàng thành công');
        return redirect()->back();
    }

    public function billUser()
    {
        $userId = Auth::user()->id;

        $orders = Order::where('ma_kh', $userId)->with('orderdetail', 'khachangorder', 'orderstatus')->get();
        return view('user.bill', compact('orders'));
    }
    public function billShow($id)
    {
        $order = Order_detail::with('product', 'order', 'order.orderstatus', 'productDetail.firstImage', 'productDetail.size')->where('ma_hd', $id)->get(); // Replace with your actual model and relationships

        foreach ($order as $item) {
            $firstImage = $item->productDetail->firstImage;
        }
        // dd($images);
        return view('user.bill-detail', compact('order'));
    }

    public function billUpdate(Request $request, $id)
    {
        // Find Order_detail by ma_hd
        $orderDetail = Order_detail::where('ma_hd', $id)->first();
        if (!$orderDetail) {
            return redirect()->route('admin.don-hang')->with('error', 'Không tìm thấy đơn hàng.');
        }


        // Find the Order associated with the Order_detail
        $order = Order::with('orderdetail')->find($orderDetail->ma_hd);

        // Determine the action based on the current status
        if ($order->trangthai == 1 && $order->giaohang == 0) {
            if ($order->ttvanchuyen = 1) {
                $order->ttvanchuyen = 0;
                $order->save();


                $product = Product::find($orderDetail->sp_id);
                Log::info($product);
                $product->soluong = $product->soluong + $orderDetail->soluong;
                $product->save();

                foreach ($order->orderdetail as $orderDetails) {
                    $productdetail = Product_detail::where('sanpham_id', $orderDetails->sp_id)
                        ->where('size_id', $orderDetails->size)
                        ->where('mau_id', $orderDetails->color)
                        ->first();
                    Log::info($productdetail);
                    $productdetail->soluong = $productdetail->soluong + $orderDetails->soluong;
                    $productdetail->save();
                }
            }
            // If current status is 1 (đang chờ xử lý), change status to 4 (hủy đơn)
            $order->trangthai = 4;
            $order->save();
        } elseif ($order->trangthai == 1 && $order->giaohang == 1) {
            if ($order->ttvanchuyen = 1) {
                $order->ttvanchuyen = 2;
                $order->save();

                //cập nhật lại số lượng khi huỷ
                $product = Product::find($orderDetail->sp_id);
                Log::info($product);
                $product->soluong = $product->soluong + $orderDetail->soluong;
                $product->save();
                // Cập nhật số lượng chi tiết sản phẩm
                foreach ($order->orderdetail as $orderDetails) {
                    $productdetail = Product_detail::where('sanpham_id', $orderDetails->sp_id)
                        ->where('size_id', $orderDetails->size)
                        ->where('mau_id', $orderDetails->color)
                        ->first();
                    Log::info($productdetail);
                    $productdetail->soluong = $productdetail->soluong + $orderDetails->soluong;
                    $productdetail->save();
                }
            }
            $order->trangthai = 4;
            $order->save();
        } elseif ($order->trangthai == 2) {
            // If current status is 2 (đã xác nhận), change status to 3 (đã nhận được hàng)
            $order->trangthai = 3;
            $order->ttvanchuyen = 1;
            $order->save();

            // Save the updated giaohang value in Order_detail
        }

        // Save the updated status in Order
        $order->save();

        // Redirect with success message
        return redirect()->route('billUser')->with('success', 'Cập nhật trạng thái đơn hàng thành công.');
    }
}