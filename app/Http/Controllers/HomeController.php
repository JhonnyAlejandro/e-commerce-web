<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class HomeController extends Controller
{
    public function home()
    {
        $products = Product::join('categories', 'products.category', '=', 'categories.id')
            ->join('references', 'products.reference', '=', 'references.id')
            ->select('products.*', 'categories.name as categoryName', 'categories.state', 'references.state')
            ->where('products.state', 1)
            ->where('categories.state', 1)
            ->where('references.state', 1)
            ->where('discount', '>' , 0)
            ->take(4)
            ->get();

        return view('home', compact('products'));
    }
}
