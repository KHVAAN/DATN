<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Product_detail;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Cart;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session; // Import Session

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $orders = Order::with('orderdetail')->get();
        return view('user.order', compact('orders'));
    }



}