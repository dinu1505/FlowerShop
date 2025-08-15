<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function show()
    {
        $cartItems = DB::table('cart')->get();
        return view('checkout', compact('cartItems'));
    }

public function placeOrder(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email',
        'address' => 'required|string',
    ]);

    session([
        'customer_name' => $validated['name'],
        'customer_email' => $validated['email'],
        'customer_address' => $validated['address'],
        'cart_total' => $request->input('total'),
    ]);

    return redirect()->route('payment.page');
}

    public function paymentPage()
    {
        return view('payment');
    }

public function processPayment(Request $request)
{
    $cartItems = Cart::all();

    foreach ($cartItems as $item) {
        Order::create([
            'name' => $item->name,
            'qty' => $item->qty,
            'price' => $item->price,
            'total' => $item->qty * $item->price,
            'customer_name' => session('customer_name'),
            'customer_email' => session('customer_email'),
            'customer_address' => session('customer_address'),
        ]);
    }

    Cart::truncate(); // Clear cart
    Session::forget(['customer_name', 'customer_email', 'customer_address', 'cart_total']); // Clear session

    return redirect()->route('payment.success');
}
    public function paymentSuccess()
    {
        return view('success');
    }
}
