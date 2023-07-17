<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Product;

class StoreController extends Controller
{
    public function store()
    {
        $products = Product::where('state', 1)->get();

        return view('store', compact('products'));
    }

    public function productOverview($name)
    {
        $product = Product::whereRaw("LOWER(REPLACE(name, ' ', '-')) = ?", Str::slug(Str::lower($name)))->firstOrFail();

        return view('product-overview', compact('product'));
    }
}
