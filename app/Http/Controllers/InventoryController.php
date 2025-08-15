<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Order;

class InventoryController extends Controller
{
    public function index()
    {
         // Fetch all inventory
        $inventory = Inventory::all();

        // Total items count
        $totalItems = $inventory->count();

        // Low stock count (stock less than 5)
        $lowStockCount = $inventory->where('stock', '<', 5)->count();
        
        $totalSales = DB::table('orders')->sum('total');
        
        // Pass variables to the view
        return view('dashboard', compact('inventory', 'totalItems', 'lowStockCount','totalSales'));
          
    }

    public function store(Request $request)
    {
        $request->validate([
            'product' => 'required|string|max:255',
            'stock'   => 'required|integer|min:0',
            'price'   => 'required|numeric|min:0',
        ]);

        Inventory::create($request->only(['product', 'stock', 'price']));
        return back()->with('success', 'Item added successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product' => 'required|string|max:255',
            'stock'   => 'required|integer|min:0',
            'price'   => 'required|numeric|min:0',
        ]);

        $item = Inventory::findOrFail($id);
        $item->update($request->only(['product', 'stock', 'price']));
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Inventory::destroy($id);
        return back()->with('success', 'Item deleted successfully!');
    }



}

