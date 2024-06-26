<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Public Routes

Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"])->name("login");

Route::get("/products", [ProductController::class, "index"])->name("products.index");
Route::get("/products/{id}", [ProductController::class, "show"])->name("products.show");

// Protected Routes

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
    Route::post('/cart/{id}', [CartController::class, 'append_product'])->name('cart.append');
    Route::delete('/cart/{id}', [CartController::class, 'destroy_product'])->name('cart.destroy');
});
