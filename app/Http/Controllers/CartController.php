<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\SavedItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function viewCart()
{
    $cartItems = DB::table('cart')->get();
    return view('cart', compact('cartItems'));
}

    public function addToCart(Request $request)
    {
        DB::table('cart')->insert([
            'item_type' => $request->item_type,
            'item_id' => $request->item_id,
            'name' => $request->name,
            'qty' => $request->qty,
            'price' => $request->price,
            'image' => $request->image,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Item added to cart!');
    }

    public function removeFromCart($id)
{
    DB::table('cart')->where('id', $id)->delete();
    return redirect()->back()->with('success', 'Item removed from cart.');
}

public function checkout()
{
    $cartItems = DB::table('cart')->get();

    if ($cartItems->isEmpty()) {
        return redirect()->route('cart.view')->with('success', 'Your cart is already empty!');
    }

    foreach ($cartItems as $item) {
        DB::table('orders')->insert([
            'name' => $item->name,
            'image' => $item->image,
            'qty' => $item->qty,
            'price' => $item->price,
            'total' => $item->qty * $item->price,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    // Clear the cart
    DB::table('cart')->truncate();

    return redirect()->route('cart.view')->with('success', '✅ Order placed successfully!');
}

public function showCheckout()
{
    $cartItems = DB::table('cart')->get(); // or where user_id = ...
    return view('checkout', compact('cartItems'));
}

public function placeOrder()
{
    $cartItems = DB::table('cart')->get();

    foreach ($cartItems as $item) {
        DB::table('orders')->insert([
            'name' => $item->name,
            'qty' => $item->qty,
            'price' => $item->price,
            'total' => $item->qty * $item->price,
            'created_at' => now(),
        ]);
    }

    DB::table('cart')->truncate(); // clear cart
    return redirect()->route('checkout.show')->with('success', 'Order placed successfully!');
}

}
