<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\CreateRequest;
use App\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('vendor')
            ->orderBy('name', 'asc')
            ->paginate(25);

        return view('products.index', compact('products'));
    }

    public function update(CreateRequest $request, Product $product)
    {
        $product->price = $request->input('price');
        $product->save();

        return $product;
    }
}
