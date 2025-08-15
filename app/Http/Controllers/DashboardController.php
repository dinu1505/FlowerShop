<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Models\Inventory;

class DashboardController extends Controller
{
public function index()
{
    $user = auth()->user();

    if ($user->hasRole('admin')) {
        $orders = Order::latest()->get();
        $ordersCount = $orders->count();

        // Admin stats
        $inventory     = Inventory::all();
        $totalItems    = $inventory->count();
        $lowStockCount = $inventory->where('stock', '<', 5)->count();
        $totalSales    = DB::table('orders')->sum('total');

        return view('dashboard', compact(
            'orders', 'ordersCount', 'inventory', 'totalItems', 'lowStockCount', 'totalSales'
        ))->with([
            'isAdmin'    => true,
            'isCustomer' => false
        ]);
    }

    elseif ($user->hasRole('customer')) {
        $orders = Order::where('customer_email', $user->email)->latest()->get();
        $ordersCount = $orders->count();

  $trendingProducts = DB::table('orders')
    ->select('product_id', 'name', DB::raw('SUM(qty) as total_sold'), DB::raw('MAX(price) as price'))
    ->groupBy('product_id', 'name')
    ->orderByDesc('total_sold')
    ->take(5)
    ->get();

    return view('dashboard', compact('orders', 'ordersCount','trendingProducts'))->with([
            'isAdmin'    => false,
            'isCustomer' => true
        ]);
    }

    else {
        return view('dashboard')->with([
            'isAdmin'    => false,
            'isCustomer' => false,
            'orders'     => collect(),
            'ordersCount'=> 0
        ]);
    }
}
}
