<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Product;
use App\Models\Category;

class StoreController extends Controller
{
    public function store()
    {
        $products = Product::join('categories', 'products.category', '=', 'categories.id')
            ->select('products.*', 'categories.name as categoryName')
            ->where('products.state', 1)
            ->get();

        $categories = Category::where('state', 1)->get();

        return view('store', compact('products', 'categories'));
    }

    public function productOverview(string $name)
    {
        $product = Product::whereRaw("LOWER(REPLACE(name, ' ', '-')) = ?", Str::slug(Str::lower($name)))->firstOrFail();

        return view('product-overview', compact('product'));
    }
}
