<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            ->select('products.*', 'references.name as reference', 'categories.name as category', 'providers.first_name', 'providers.last_name')
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
    public function store(Request $request)
    {
        $rules = [
            'code' => 'required',
            'name' => 'required',
            'reference' => 'required',
            'category' => 'required',
            'provider' => 'required',
            'service' => 'required',
            'existence' => 'required|numeric',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'description' => 'required',
            'image' => 'required|image|max:500'
        ];

        $message = [
            'code.required' => 'El código es obligatorio.',

            'name.required' => 'El nombre es obligatorio.',

            'reference.required' => 'La referencia es obligatoria.',

            'category.required' => 'La categoría es obligatoria.',

            'provider.required' => 'El proveedor es obligatorio.',

            'service.required' => 'El servicio es obligatorio.',

            'existence.required' => 'La existencia es obligatoria.',
            'existence.numeric' => 'La existencia debe tener valores numéricos.',

            'price.required' => 'El precio de venta es obligatorio.',
            'price.numeric' => 'El precio de venta debe tener valores numéricos.',

            'discount.required' => 'El descuento es obligatorio.',
            'discount.numeric' => 'El descuento debe tener valores numéricos.',

            'description.required' => 'La descripción es obligatoria.',

            'image.required' => 'La imagen es obligatoria.',
            'image.image' => 'La imagen debe tener extensión PNG o JPG.',
            'image.max' => 'La imagen no debe tener más de 500 kilobytes.'
        ];

        $request->validate($rules, $message);

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

        return redirect()->route('products.index');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $products = Product::findOrFail($id);
        $products->state = 0;
        $products->update();

        return redirect()->route('products.index')->with('notification', 'El producto fue eliminado con éxito');
    }
}
