<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function hompage()
    {
        $categories = Category::with("products")->get();
        $featured_products = Product::inRandomOrder()->limit(8)->get();
        $recent_products = Product::orderByDesc('id')->limit(8)->get();
        return view("index", compact("categories", "featured_products", "recent_products"));
    }
}
