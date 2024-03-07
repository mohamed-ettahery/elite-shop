<?php

namespace App\Http\Controllers\admin;

use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderDetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::with("user")->orderByDesc("created_at")->limit(5)->get();
        return view("admin.dashboard", compact("orders"));
    }
}
