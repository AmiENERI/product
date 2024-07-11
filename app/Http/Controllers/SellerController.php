<?php

namespace App\Http\Controllers;



use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sorting_options = [
            'name_asc' => ['name', 'asc'],
            'name_desc' => ['name', 'desc'],
        ];

        $default_sorting = ['name', 'asc'];
        $sort = $request->input('sort');

        $orderBy =  $sorting_options[$sort] ?? $default_sorting;
        $sellers = Seller::orderBy('name')->paginate(10);
        return view('admin.sellers.index', compact('sellers', 'sort'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sellers = Seller::all();
        return view('admin.sellers.create', compact('sellers'));
    }
    

        private function validateSellerData(Request $request)     {
        return $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'zip_code' => 'required|string|max:255',
            'town' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'website' => 'required|string|max:255',
                        
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validare i dati
        $validateData = $this->validateSellerData($request);
        //creo un'istanza
        $seller = new Seller();
        //riempio i campi della tabella
        $seller->fill($validateData);

        $seller->save();
        return redirect()->route('sellers.index');
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
        $seller = Seller::find($id);
        return view('admin.sellers.edit', compact('seller'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validare i dati
        $validateData = $this->validateSellerData($request);
        $seller = Seller::findOrFail($id);
        $seller->fill($validateData);

        $seller->save();
        return redirect()->route('sellers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $seller = Seller::find($id);
        if (!$seller) {
            return redirect()->route('sellers.index')->with('error', 'fornitore non presente');
        }

        $seller->delete();

        return redirect()->route('sellers.index')->with('success', 'fornitore eliminato');
        
    }
}
