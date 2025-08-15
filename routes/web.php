<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FlowerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ArrangementController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('index');
})->name('index'); // Added name 'index'

Route::get('/flowers', [FlowerController::class, 'index'])->name('flowers');

Route::get('/flowers/edit', [FlowerController::class, 'editMode'])->name('flowers.editMode');
Route::post('/flowers', [FlowerController::class, 'store'])->name('flowers.store');
Route::post('/flowers/{id}/update', [FlowerController::class, 'update'])->name('flowers.update');
Route::delete('/flowers/{id}', [FlowerController::class, 'destroy'])->name('flowers.destroy');

Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

Route::get('/arrangements', [ArrangementController::class, 'index'])->name('arrangements');

// Admin overview: list all arrangements for editing
Route::get('/arrangements/edit', [ArrangementController::class, 'editMode'])
    ->name('arrangements.editMode');

// Add new arrangement
Route::post('/arrangements', [ArrangementController::class, 'store'])
    ->name('arrangements.store');

// Update an existing arrangement
Route::post('/arrangements/{id}/update', [ArrangementController::class, 'update'])
    ->name('arrangements.update');

// Delete an arrangement
Route::delete('/arrangements/{id}', [ArrangementController::class, 'destroy'])
    ->name('arrangements.destroy');

// Shows cart items
Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');

// Step 1: Click "Place Order" → Goes here
Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.place');

// Step 2: Payment form
Route::get('/payment', [CheckoutController::class, 'paymentPage'])->name('payment.page');

// Step 3: Submit payment
Route::post('/payment/process', [CheckoutController::class, 'processPayment'])->name('payment.process');

// Step 4: Payment success page
Route::get('/payment/success', [CheckoutController::class, 'paymentSuccess'])->name('payment.success');

Route::get('/about', function () {
    return view('about');
})->name('about'); // Added name 'arrangements'

Route::get('/dashboard', [DashboardController::class, 'index'])
     ->middleware('auth')
     ->name('dashboard');

Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
Route::post('/inventory', [InventoryController::class, 'store'])->name('inventory.store');
Route::put('/inventory/{id}', [InventoryController::class, 'update'])->name('inventory.update');
Route::delete('/inventory/{id}', [InventoryController::class, 'destroy'])->name('inventory.destroy');

Route::get('/orders/{id}', [OrderController::class, 'show'])
     ->middleware('auth')
     ->name('orders.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
