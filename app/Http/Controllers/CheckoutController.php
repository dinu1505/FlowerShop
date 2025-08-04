<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BouquetOrder;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // 1. Show checkout page
    public function index()
    {
        $items = BouquetOrder::all(); // Or filter by user if needed
        $total = $items->sum(function($item) {
            return $item->price * $item->quantity;
        });

        return view('checkout', compact('items', 'total'));
    }

    // 2. Update quantity
    public function updateQuantity(Request $request, $id)
    {
        $orderItem = BouquetOrder::findOrFail($id);
        $orderItem->quantity = $request->quantity;
        $orderItem->save();

        return response()->json(['success' => true]);
    }

    // 3. Simulate payment and store order
    public function placeOrder(Request $request)
    {
        // Validate user info
        $validated = $request->validate([
            'customer_name' => 'required|string|max:100',
            'phone' => 'required|numeric|digits_between:10,12',
            'address' => 'required|string|max:255',
        ]);

        // Simulated payment logic — here you pretend it's successful
        $items = BouquetOrder::all();
        $total = $items->sum(function($item) {
            return $item->price * $item->quantity;
        });

        // Save to orders table
        foreach ($items as $item) {
            Order::create([
                'customer_name' => $request->customer_name,
                'phone' => $request->phone,
                'address' => $request->address,
                'flower_name' => $item->flower_name,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'total_price' => $item->price * $item->quantity,
                'user_id' => Auth::check() ? Auth::id() : null,
            ]);
        }

        // Clear cart after placing order
        BouquetOrder::truncate();

        return redirect()->route('checkout')->with('success', 'Order placed successfully!');
    }
}

