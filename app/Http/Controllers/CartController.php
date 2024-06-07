<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{

    /**
     * Display the specified resource.
     */
    public function show()
    {
        auth()->user()->cart->products;
        return auth()->user()->cart;
    }

    public function append_product(string $id)
    {
        $product = Product::findOrFail($id);
        auth()->user()->cart->products()->save($product);
        auth()->user()->cart->products;
        return auth()->user()->cart;
    }

    public function destroy_product(string $id)
    {
        auth()->user()->cart->products()->find($id)->delete($id);
        auth()->user()->cart->products;
        return auth()->user()->cart;
    }
}
