<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

require __DIR__.'/auth.php';
