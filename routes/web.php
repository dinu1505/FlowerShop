<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BouquetOrderController;
use App\Http\Controllers\CheckoutController;

Route::get('/', function () {
    return view('index');
})->name('index'); // Added name 'index'

Route::get('/flowers', function () {
    return view('flowers');
})->name('flowers');

Route::get('/arrangements', function () {
    return view('arrangements');
})->name('arrangements'); // Added name 'arrangements'

Route::get('/about', function () {
    return view('about');
})->name('about'); // Added name 'arrangements'

Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout'); // Added name 'arrangements'

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/order/add', [OrderController::class, 'add'])->name('order.add');
Route::post('/order/cancel', [OrderController::class, 'cancel'])->name('order.cancel');

Route::post('/order-bouquet', [BouquetOrderController::class, 'placeBouquetOrder'])->name('order.bouquet');
Route::post('/cancel-bouquet', [BouquetOrder::class, 'cancelBouquetOrder'])->name('cancel.bouquet');


Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/update-quantity/{id}', [CheckoutController::class, 'updateQuantity'])->name('checkout.updateQuantity');
Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('order.place');

require __DIR__.'/auth.php';
