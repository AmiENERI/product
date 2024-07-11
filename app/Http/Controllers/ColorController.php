<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
      * Display a listing of the resource. 
      */
     public function index()
     {
         $colors = Color::orderBy('id')->paginate(10);
         return view('admin.colors.index', compact('colors'));
     }
 
     /**
      * Show the form for creating a new resource.
      */
     public function create()
     {
         $colors = Color::all();
         return view('admin.colors.create', compact('colors'));
     }
     
 
         private function validateColorData(Request $request)     {
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
         $validateData = $this->validateColorData($request);
         //creo un'istanza
         $color = new Color();
         //riempio i campi della tabella
         $color->fill($validateData);
         
         return redirect()->route('admin.colors.index');
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
         $color = Color::findOrFail($id);
         $colors = Color::all();
 
         return view('admin.colors.edit', compact('colors'));
     }
 
     /**
      * Update the specified resource in storage.
      */
     public function update(Request $request, string $id)
     {
         //validare i dati
         $validateData = $this->validateColorData($request);
         $color = Color::findOrFail($id);
         $color->fill($validateData);
 
         return redirect()->route('admin.colors.index');
     }
 
     /**
      * Remove the specified resource from storage.
      */
     public function destroy(string $id)
     {
         //
     }
 }