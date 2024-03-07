<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with("user")->orderByDesc("created_at")->get();
        return view("admin.orders.index", compact("orders"));
    }
    public function ConfirmOrder($order)
    {
        $order = Order::where('id', $order)->first();
        $order->update(["status" => "confirmé"]);
        return redirect()->route("orders.index")->with('success', "La commande est bien confirmé.");
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
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order = Order::find($order)->first();
        $order->update(["status" => "supprimé"]);
        return redirect()->route("orders.index")->with('success', "La commande est bien supprimé.");
    }
}
