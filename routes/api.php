<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Public Routes

Route::get("/register", [AuthController::class, "register"]);
Route::get("/login", [AuthController::class, "login"])->name("login");

Route::get("/products", [ProductController::class, "index"])->name("products.index");
Route::get("/products/{id}", [ProductController::class, "show"])->name("products.show");

// Protected Routes

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::get('/cart', function () {
        auth()->user()->cart->user;
        return auth()->user()->cart;
    })->name('users.cart');
});
