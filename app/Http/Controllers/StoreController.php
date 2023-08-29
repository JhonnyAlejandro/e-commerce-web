<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\Product;
use App\Models\Category;
use App\Models\Review;
use App\Models\Favorite;

class StoreController extends Controller
{
    public function store()
    {
        $products = Product::join('categories', 'products.category', '=', 'categories.id')
            ->join('references', 'products.reference', '=', 'references.id')
            ->select('products.*', 'categories.name as categoryName', 'categories.state', 'references.state')
            ->where('products.state', 1)
            ->where('categories.state', 1)
            ->where('references.state', 1)
            ->take(4)
            ->get();

        $categories = Category::where('state', 1)->get();

        return view('store', compact('products', 'categories'));
    }

    public function productOverview(Request $request, string $name)
    {
        $product = Product::whereRaw("LOWER(REPLACE(name, ' ', '-')) = ?", Str::slug(Str::lower($name)))->firstOrFail();

        Carbon::setLocale('es');

        $reviews = $product->reviews()->join('users', 'reviews.user', '=', 'users.id')
            ->select('reviews.*', 'users.first_name as firstName')
            ->where('reviews.state', 1)
            ->orderByDesc('rating')
            ->get();

        if ($request->isMethod('post')) {
            $reviews = new Review;
            $reviews->rating = $request->rating;
            $reviews->comment = $request->comment;
            $reviews->user = auth()->id();
            $reviews->product = $product->id;
            $reviews->state = 1;
            $reviews->save();

            return redirect()->back();
        }

        return view('product-overview', compact('product', 'reviews'));
    }

    public function favorites(Request $request, string $product)
    {
        $favorites = Favorite::where('user', auth()->id())
            ->where('product', $product)
            ->first();

        if ($favorites) {
            $favorites->delete();

            return redirect()->back()->with('notification', 'El producto fue eliminado de la lista de favoritos');
        } else {
            $favorites = new Favorite();
            $favorites->user = auth()->id();
            $favorites->product = $product;
            $favorites->state = 1;
            $favorites->save();

            return redirect()->back()->with('notification', 'El producto fue agregado a la lista de favoritos');
        }
    }
}
