<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('phanquyen', 1);

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('hovaten', 'like', '%' . $search . '%')
                    ->orWhere('sdt', 'like', '%' . $search . '%')
                    ->orWhere('ngaysinh', 'like', '%' . $search . '%')
                    ->orWhere('diachi', 'like', '%' . $search . '%');
            });
        }

        $admin = $query->paginate(10); // Sử dụng paginate() thay vì get()

        return view('admin.quan-li-nhan-vien', compact('admin'));
    }


    public function home()
    {
        $users = User::where('phanquyen', '<>', 1) // Loại bỏ những người dùng có phân quyền là 1 (admin)
            ->latest() // Sắp xếp theo thời gian từ mới nhất đến cũ nhất
            ->take(5) // Giới hạn lấy chỉ 5 bản ghi
            ->get(); // Lấy dữ liệu
        $count_order = Order::All()->count();
        $count = User::where('phanquyen', '<>', 1)->count(); // Loại bỏ người dùng là admin
        $count_product = Product::All()->count();
        $product_stt = Product::where('soluong', '<', 5)->count(); // Đếm số lượng sản phẩm sắp hết hàng (ví dụ stock < 5)
        return view('admin.trang-chu', compact('users', 'count', 'count_product', 'product_stt', 'count_order'));
    }

    public function sale()
    {
        $count_order = Order::All()->count();
        $count_product = Product::All()->count();
        $product_stt = Product::where('soluong', '<', 1)->count(); // Đếm số lượng sản phẩm sắp hết hàng (ví dụ stock < 5)
        $out_of_stock_products = Product::where('soluong', '<', 1)->get(); // Lấy danh sách các sản phẩm hết hàng
        return view('admin.doanh-thu', compact('count_order', 'count_product', 'product_stt', 'out_of_stock_products'));
    }
    public function create()
    {
        $admin = User::where('trangthai', 0)->get();
        return view('admin.them-admin', compact('admin'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'sdt' => 'required|size:10',
            'hovaten' => 'required|max:30',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:6',
            'diachi' => 'required|max:255',
            'phanquyen' => 'required',
            'gioitinh' => 'required',
            'ngaysinh' => 'required|date',
        ], [
            'sdt.required' => 'Không được để trống',
            'sdt.size' => 'Số điện thoại phải đủ 10 số',
            'email.required' => 'Không được để trống',
            'email.unique' => 'email đã tồn tại',
            'email.email' => 'Định dạng không hợp lệ',
            'hovaten.required' => 'Không được để trống',
            'hovaten.max' => 'Mật khẩu không quá 30 ký tự',
            'password.required' => 'Không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'diachi.max' => 'Địa chỉ không quá 255 ký tự',
            'diachi.required' => 'Không được để trống',
            'phanquyen.required' => 'Không được để trống',
            'gioitinh.required' => 'Không được để trống',
            'ngaysinh.required' => 'Không được để trống',
            'ngaysinh.date' => 'Ngày sinh không hợp lệ',
        ]);

        $user = new User;
        $user->sdt = $request->input('sdt');
        $user->password = Hash::make($request->input('password'));
        $user->hovaten = $request->input('hovaten');
        $user->email = $request->input('email');
        $user->diachi = $request->input('diachi');
        $user->phanquyen = $request->input('phanquyen');
        $user->gioitinh = $request->input('gioitinh');
        $user->ngaysinh = $request->input('ngaysinh');
        $user->save();
        Alert()->success('Thành công', 'Thêm quản trị viên thành công.');
        return \redirect()->back();
    }

    public function show($id)
    {
        $user = User::where('id', $id)->first();
        return view('admin.chi-tiet-admin', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.chinh-sua-tai-khoan', [
            'item' => $user,
            'type' => 'quản trị viên',
            'nameField' => 'hovaten',
            'sdt' => 'sdt',
            'email' => 'email',
            'diachi' => 'diachi',
            'phanquyen' => 'phanquyen',
            'gioitinh' => 'gioitinh',
            'ngaysinh' => 'ngaysinh',
            'updateRoute' => route('cap-nhat-admin', ['id' => $user->id])
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'sdt' => 'required|size:10',
            'hovaten' => 'required|max:30',
            'email' => 'required|email|unique:user,email,' . $id,
            'password' => 'nullable|min:6',
            'diachi' => 'required|max:255',
            'phanquyen' => 'required|in:1,2', // Chỉ chấp nhận giá trị 1 hoặc 2
            'gioitinh' => 'required',
            'ngaysinh' => 'required|date',
        ], [
            'sdt.required' => 'Không được để trống',
            'sdt.size' => 'Số điện thoại phải đủ 10 số',
            'email.required' => 'Không được để trống',
            'email.unique' => 'Email đã tồn tại',
            'email.email' => 'Định dạng email không hợp lệ',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'diachi.required' => 'Không được để trống',
            'diachi.max' => 'Địa chỉ không quá 255 ký tự',
            'phanquyen.required' => 'Không được để trống',
            'phanquyen.in' => 'Phân quyền không hợp lệ',
            'gioitinh.required' => 'Không được để trống',
            'ngaysinh.required' => 'Không được để trống',
            'ngaysinh.date' => 'Ngày sinh không hợp lệ',
        ]);

        try {
            $user = User::findOrFail($id);
            $user->hovaten = $request->input('hovaten') ?? $user->hovaten;
            $user->sdt = $request->input('sdt') ?? $user->sdt;
            $user->diachi = $request->input('diachi') ?? $user->diachi;
            $user->phanquyen = $request->input('phanquyen') ?? $user->phanquyen;
            $user->email = $request->input('email') ?? $user->email;
            $user->gioitinh = $request->input('gioitinh') ?? $user->gioitinh;
            $user->ngaysinh = $request->input('ngaysinh') ?? $user->ngaysinh;

            // Cập nhật mật khẩu nếu được cung cấp
            if ($request->has('password')) {
                $user->password = Hash::make($request->input('password'));
            }

            $user->save();

            Alert()->success('Thành công', 'Cập nhật tài khoản quản trị viên thành công.');
        } catch (\Exception $e) {
            Alert()->error('Lỗi', 'Có lỗi xảy ra trong quá trình cập nhật. Vui lòng thử lại sau.');
        }

        return redirect()->back();
    }


    public function destroy(Request $request, $id)
    {
        $admin = User::findOrFail($id);
        $admin->delete();
        alert()->success('Thành công', 'Xóa tài khoản thành công');
        return redirect()->back();
    }

    public function user()
    {
        $users = User::latest()->take(5)->get(); // Lấy danh sách 5 người dùng mới nhất

        return view('admin.trang-chu', compact('users')); // Trả về view 'home' với dữ liệu người dùng
    }
}
