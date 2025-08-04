<?php

namespace App\Http\Controllers;

use App\Models\Flower;
use App\Models\Order;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $flowers = Flower::whereIn('id', array_keys($cart))->get();
        
        return view('cart', compact('flowers', 'cart'));
    }
    
    public function addToCart(Request $request, $flowerId)
    {
        $flower = Flower::findOrFail($flowerId);
        $cart = session()->get('cart', []);
        
        if(isset($cart[$flowerId])) {
            $cart[$flowerId]['quantity']++;
        } else {
            $cart[$flowerId] = [
                'quantity' => 1,
                'price' => $flower->sale_price ?? $flower->price
            ];
        }
        
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Flower added to cart!');
    }
    
    public function checkout()
    {
        // Handle checkout logic
    }
}