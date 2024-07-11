<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Color;
use App\Models\Seller;
use App\Models\Producer;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //$products = Product::orderBy('id')->paginate(10);

        $sorting_options = [
            'name_asc' => ['name', 'asc'],
            'name_desc' => ['name', 'desc'],
            'producer_asc' => ['name', 'asc'],
            'producer_desc' => ['name', 'desc'],
            'code_asc' => ['code', 'asc'],
            'code_desc' => ['code', 'desc'],
        ];

        $default_sorting = ['name', 'asc'];
        $sort = $request->input('sort');

        $orderBy =  $sorting_options[$sort] ?? $default_sorting;
        // dd($orderBy);
        //nel model la relazione si chiama director        
        $products = Product::with('producer')->leftJoin('producers', 'products.producer_id', '=', 'producers.id')->orderBy($orderBy[0], $orderBy[1])->select('products.*', 'producers.name as producer_name')->paginate(10);

        return view('admin.products.index', compact('products', 'sort'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        // Recupera tutti i registi disponibili
        $producers = Producer::all();
        // Recupera tutti gli attori disponibili
        $sellers = Seller::all();
        // Passa i dati alla vista create
        $colors = Color::all();
        $materials = Material::all();
        return view('admin.products.create', compact('types', 'producers', 'sellers', 'colors', 'materials'));
    }

    private function validateProductData(Request $request)     {
        return $request->validate([
            'name' => 'required|string|max:255',            
            'producer_id' => 'required|exists:producers,id',
            'sellers' => 'required|array',            
            'sellers.*' => 'exists:sellers,id',
            'code' => 'required|string|max:255',
            'colors' => 'required|array',
            'colors.*' => 'exists:colors,id',           
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'types' => 'required|array',            
            'types.*' => 'exists:types,id',
            'price' => 'required|string|max:255',
            'materials' => 'required|array',
            'materials.*' => 'exists:materials,id',
                   
        ]);   
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validare i dati
        $validateData = $this->validateProductData($request);
        //creo un'istanza
        $product = new Product();
        //riempio i campi della tabella
        $product->fill($validateData);

        //gestiamo l'immagine
        if($request->hasFile('photo')){
            $fileName = time() . '_' .$request->file('photo')->getClientOriginalName();
            //carica l'immagine dentro la cartella photo
            $photoPath = $request->file('photo')->storeAs('photos', $fileName, 'public');
            //salva il percorso solo del nome del file nel campo del db
            $product->photo = $fileName;
        }

        if($product->save()){
            $product->sellers()->attach($validateData['sellers']);
            $product->types()->attach($validateData['types']);
            $product->colors()->attach($validateData['colors']);
            $product->materials()->attach($validateData['materials']);
        }
    
        return redirect()->route('products.index')->with('success', 'Nuovo prodotto inserito');
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
        $product = Product::findOrFail($id);
        // Ottieni tutti i generi disponibili
        $types = Type::all();
        // Ottieni tutti i registi disponibili
        $producers = Producer::all();
        // Ottieni tutti gli attori disponibili
        $sellers = Seller::all();
        // Passa i dati alla vista di modifica
        $colors = Color::all();
        $materials = Material::all();
        return view('admin.products.edit', compact('product', 'types', 'producers', 'sellers', 'colors', 'materials'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validare i dati
        $validateData = $this->validateProductData($request);
        $product = Product::findOrFail($id);
        $product->fill($validateData);

        if($request->hasFile('photo')){
        $fileName = time() . '_' .$request->file('photo')->getClientOriginalName();
        //carica l'immagine dentro la cartella storage/posters
        $photoPath = $request->file('photo')->storeAs('photos', $fileName, 'public');
        //salva il percorso nel campo del db
        $product->photo = $photoPath;
        }

        if($product->save()){
            $product->sellers()->sync($validateData['sellers']);
            $product->types()->sync($validateData['types']);
            $product->colors()->sync($validateData['colors']);
            $product->materials()->sync($validateData['materials']);
        }

        return redirect()->route('products.index')->with('success', 'Prodotto modificato con successo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('products.index')->with('error', 'prodotto non presente');
        }

        //  eliminiamo dallo storage l'immagine per non appensatire le cartelle in rete
        $photoPath = '/photos' . $product->photo;
        Storage::delete($photoPath);

        $product->delete();

        return redirect()->route('products.index')->with('success', 'prodotto eliminato');
        
    }
}
