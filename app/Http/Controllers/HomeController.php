<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class HomeController extends Controller
{
    public function home()
    {
        $products = Product::join('categories', 'products.category', '=', 'categories.id')
            ->select('products.*', 'categories.name as categoryName')
            ->where('products.state', 1)
            ->take(4)
            ->get();

        return view('home', compact('products'));
    }
}
