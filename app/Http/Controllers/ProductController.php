<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function products(Request $request)
    {
        $products = Product::paginate(10);

        return response()->json($products, 200);
    }

    public function add_product(Request $request)
    {
        $product = Product::create($request->all());
        return response()->json($product, 200);
    }

    public function get_product(Request $request)
    {
        $product = Product::find($request->id);

        return response()->json($product, 200);
    }

    public function delete_product(Request $request)
    {
        $product = Product::find($request->id);
        $product->delete();
        return response()->json($product, 200);
    }
}
