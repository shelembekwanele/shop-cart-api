<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
}
