<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class HomeController extends Controller
{
    public function home()
    {
        $products = Product::take(4)->get();

        return view('home', compact('products'));
    }
}
