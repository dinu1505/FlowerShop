<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;   // Your Order model
use Illuminate\Support\Facades\Auth;



class OrderController extends Controller
{
   
public function add(Request $request)
{
    $request->validate([
        'product_name' => 'required|string',
        'price' => 'required|numeric',
    ]);

    $order = Order::create([
        'user_id' => Auth::check() ? Auth::id() : null,
        'product_name' => $request->product_name,
        'price' => $request->price,
        'quantity' => 1,
    ]);

    return back()->with('success', 'Product added to order.');
}

public function cancel(Request $request)
{
    $request->validate([
        'product_name' => 'required|string',
    ]);

    $query = Order::where('product_name', $request->product_name);
    if (Auth::check()) {
        $query->where('user_id', Auth::id());
    } else {
        $query->whereNull('user_id');
    }
    $query->delete();

    return back()->with('success', 'Product removed from order.');
}

}
