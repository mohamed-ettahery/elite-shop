<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderDetail;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('category_id')->paginate(9);
        return view("shop", compact("products"));
    }

    public function addToCart(Request $request)
    {
        if (!session()->has('user')) {
            return response()->json(['message' => 'login'], 404);
        }
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        // Retrieve the product from the database
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $check = Cart::where(["user_id" => session()->get('user'), "product_id" => $productId])->first();
        // return response()->json(['message' => $productId], 200);
        // // Add the product to the cart

        if (!$check) {
            Cart::create([
                'user_id' => session()->get('user'),
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);

            return response()->json(['message' => 'success'], 200);
        } else {
            return response()->json(['message' => 'exist'], 404);
        }
    }
    public function viewCart()
    {
        if (!session()->has('user')) {
            return redirect()->route("login.index");
        }
        $user = User::find(session()->get('user'));
        $cartItems = $user->cartItems()->with('product')->get();
        // return $cartItems;
        return view("cart", compact("cartItems"));
    }
    public function deleteCartProduct(Request $request)
    {
        $productId = $request->input('product_id');
        $item = Cart::where(["user_id" => session()->get('user'), "product_id" => $productId])->first();
        if ($item->delete()) {
            return response()->json(['message' => 'success'], 200);
        } else {
            return response()->json(['message' => 'error'], 404);
        }
    }
    public function sendOrder()
    {
        $order = Order::create([
            'user_id' => session()->get("user"),
            'status' => 'en cours',
        ]);
        $lastInsertedOrderId = $order->id;

        $items = Cart::where("user_id", session()->get('user'))->get();

        foreach ($items as $item) {
            OrderDetail::create([
                "order_id" => $lastInsertedOrderId,
                "product_id" => $item->product_id,
                "quantity" => $item->quantity,
            ]);
        }
        Cart::where("user_id", session()->get('user'))->delete();
        return response()->json(['message' => 'success'], 200);
    }
    public function viewOrders()
    {
        if (!session()->has('user')) {
            return response()->json(['message' => 'login'], 404);
        }
        $orders = Order::where("user_id", session()->get('user'))->get();
        // $orderDetails = OrderDetail::with('product')->get();
        return view("orders", compact("orders"));
    }
    public function getOrderDetails($order)
    {
        $orderDetails = OrderDetail::where("order_id", $order)->with('product')->get();
        return response()->json(['message' => 'success', 'details' => $orderDetails], 200);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view("details", compact("product"));
    }
    public function showCategory($category)
    {
        $products = Product::where('category_id', $category)->paginate(9);
        return view("shop", compact("products"));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
