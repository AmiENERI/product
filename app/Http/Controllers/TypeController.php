<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TypeController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::orderBy('id')->paginate(10);
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.types.create', compact('types'));
    }
    

        private function validateSellerData(Request $request)     {
        return $request->validate([
            'name' => 'required|string|max:255',          
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validare i dati
        $validateData = $this->validateTypeData($request);
        //creo un'istanza
        $type = new Type();
        //riempio i campi della tabella
        $type->fill($validateData);
        
        return redirect()->route('admin.types.index');
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
        // Trova il prodotto da modificare
        $type = Type::findOrFail($id);
        $types = Type::all();

        return view('admin.types.edit', compact('types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validare i dati
        $validateData = $this->validateTypeData($request);
        $type = Type::findOrFail($id);
        $type->fill($validateData);

        return redirect()->route('admin.types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
