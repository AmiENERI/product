<?php

namespace App\Http\Controllers;

use App\Models\Producer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException; 
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\View;

class ProducerController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $producers = Producer::orderBy('id')->paginate(10);
        return view('admin.producers.index', compact('producers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $producers = Producer::all();
        return view('admin.producers.create', compact('producers'));
    }
    

        private function validateProducerData(Request $request)     {
        return $request->validate([
            'name' => 'required|string|max:255',
            'country_of_production' => 'required|string|max:255',               
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validare i dati
        $validateData = $this->validateProducerData($request);
        //creo un'istanza
        $producer = new Producer();
        //riempio i campi della tabella
        $producer->fill($validateData);

        $producer->save();
        return redirect()->route('producers.index');
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
        $producer = Producer::find($id);
        return view('admin.producers.edit', compact('producer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validare i dati
        $validateData = $this->validateProducerData($request);
        $producer = Producer::findOrFail($id);
        $producer->fill($validateData);

        $producer->save();
        return redirect()->route('producers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $producer = Producer::find($id);
        if (!$producer) {
            return redirect()->route('producers.index')->with('error', 'produttore non presente');
        }

        $producer->delete();

        return redirect()->route('producers.index')->with('success', 'produttore eliminato');
        
    }
}
