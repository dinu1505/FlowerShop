<?php

namespace App\Http\Controllers;
use App\Models\BouquetOrder;
use Illuminate\Http\Request;

class BouquetOrderController extends Controller
{
    public function placeBouquetOrder(Request $request)
{
    BouquetOrder::create([
        'product_name' => $request->product_name,
        'price' => $request->price,
        'quantity' => 1,
    ]);

    return back()->with('success', 'Bouquet added to order!');
}

public function cancelBouquetOrder(Request $request)
{
    BouquetOrder::where('product_name', $request->product_name)->latest()->first()?->delete();

    return back()->with('success', 'Bouquet removed from order!');
}
}
