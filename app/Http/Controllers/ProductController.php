<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\ProductFormRequest;

use App\Models\Product;
use App\Models\Reference;
use App\Models\Category;
use App\Models\Provider;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::join('references', 'products.reference', '=', 'references.id')
            ->join('categories', 'products.category', '=', 'categories.id')
            ->join('providers', 'products.provider', '=', 'providers.id')
            ->select('products.*', 'references.name as referenceName', 'categories.name as categoryName', 'providers.first_name', 'providers.last_name')
            ->where('products.state', 1)
            ->get();

        $references = Reference::where('state', 1)->get();

        $categories = Category::where('state', 1)->get();

        $providers = Provider::where('state', 1)->get();

        return view('modules.products.index', compact('products', 'references', 'categories', 'providers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductFormRequest $request)
    {
        $image = Storage::url($request->file('image')->store('public/images'));

        $products = new Product;
        $products->code = $request->code;
        $products->name = $request->name;
        $products->reference = $request->reference;
        $products->category = $request->category;
        $products->provider = $request->provider;
        $products->service = $request->service;
        $products->existence = $request->existence;
        $products->price = $request->price;
        $products->discount = $request->discount;
        $products->description = $request->description;
        $products->image = $image;
        $products->state = 1;
        $products->save();

        return redirect()->route('products.index')->with('notification', 'El producto fue agregado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductFormRequest $request, string $id)
    {
        dd('update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $products = Product::findOrFail($id);
        $products->state = 0;
        $products->update();

        return redirect()->route('products.index')->with('notification', 'El producto fue eliminado exitosamente');
    }
}
