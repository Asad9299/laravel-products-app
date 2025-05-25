<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    # Manage Products Module
    Route::resource('products', ProductController::class);    

    # Manage Users ( Admin Only )
    # Users Listing
    Route::get('/users', [UserController::class, 'index'])->name('users');
    
    # Delete a User
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});

Route::middleware('auth')->group(function () { 
    # Products Listing
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    
    # Product Details
    Route::get('/product/{product}', [ProductController::class, 'show'])->name('products.show');
});


require __DIR__.'/auth.php';
