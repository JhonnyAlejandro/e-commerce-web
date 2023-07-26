<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ReferenceFormRequest;

use App\Models\Reference;

class ReferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $references = Reference::where('state', 1)->get();

        return view('modules.references.index', compact('references'));
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
    public function store(ReferenceFormRequest $request)
    {
        $references = new Reference;
        $references->name = $request->name;
        $references->state = 1;
        $references->save();

        return redirect()->route('references.index')->with('notification', 'La referencia fue agregada exitosamente');
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
    public function update(ReferenceFormRequest $request, string $id)
    {
        $references = Reference::findOrFail($id);
        $references->name = $request->name;
        $references->update();

        return redirect()->route('references.index')->with('notification', 'La referencia fue editada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $references = Reference::findOrFail($id);
        $references->state = 0;
        $references->update();

        return redirect()->route('references.index')->with('notification', 'La referencia fue eliminada exitosamente');
    }
}
