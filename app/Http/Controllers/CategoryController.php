<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CategoryFormRequest;

use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where('state', 1)->get();

        return view('modules.categories.index', compact('categories'));
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
    public function store(CategoryFormRequest $request)
    {
        $categories = new Category;
        $categories->name = $request->name;
        $categories->state = 1;
        $categories->save();

        return redirect()->route('categories.index')->with('notification', 'La categoría fue agregada exitosamente');
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
    public function update(CategoryFormRequest $request, string $id)
    {
        $categories = Category::findOrFail($id);
        $categories->name = $request->name;
        $categories->update();

        return redirect()->route('categories.index')->with('notification', 'La categoría fue editada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categories = Category::findOrFail($id);
        $categories->state = 0;
        $categories->update();

        return redirect()->route('categories.index')->with('notification', 'La categoría fue eliminada exitosamente');
    }
}
