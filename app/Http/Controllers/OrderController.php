<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            $orders = Order::latest()->get();
        } else {
            $orders = Order::where('customer_email', $user->email)
                           ->latest()
                           ->get();
        }

        return view('dashboard', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);

        // Optional: make sure customers can see only their orders
        if (auth()->user()->hasRole('customer') && $order->customer_email !== auth()->user()->email) {
            abort(403);
        }

        return view('orders.show', compact('order'));
    }
}
