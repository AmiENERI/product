<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Producer;
use App\Models\Color;
use App\Models\Material;
use App\Models\Type;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException; 
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\View;
    

class HomeController extends Controller
{
    protected $types;
    

    public function __construct()
    {
        $this->types = Type::all();
       
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::inRandomOrder()->paginate(8); //in ordine random
        return view('welcome', ['products' => $products, 'types' => $this->types]);      
  
    }

    

     /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //per visualizzare un singolo film
    }

    public function search(Request $request)
    {
        // dd($request);
        $search = $request->search;
        // dd($search);
        //filtrare i dati per questo campo di ricerca
        $products = Product::where('name','like','%'.$search .'%')->get();
        return view('products.search', ['products' => $products, 'types' => $this->types]);
    }

    public function type($type)
    {
        try {
            $type = Type::where('name', $type)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            abort(404);
        }

        $products = $type->products()->get(); // Utilizza get() per recuperare tutti i film associati al genere

        // dd($films); // Controlla i risultati prima di passarli alla vista
        return view('products.type', ['products' => $products, 'type' => $type, 'types' => $this->types]);
    }

  
    public function color($color)
    {
        try {
            $color = Color::where('name', $color)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            abort(404);
        }

        $products = $color->products()->get(); // Utilizza get() per recuperare tutti i film associati al genere

        // dd($films); // Controlla i risultati prima di passarli alla vista
        return view('products.color', ['products' => $products, 'color' => $color, 'colors' => $this->colors]);
    }

    public function material($material)
    {
        try {
            $material = Material::where('name', $material)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            abort(404);
        }

        $products = $material->products()->get(); // Utilizza get() per recuperare tutti i film associati al genere

        // dd($films); // Controlla i risultati prima di passarli alla vista
        return view('products.material', ['products' => $products, 'material' => $material, 'materials' => $this->materials]);
    }

    public function contatti(Request $request)
    {
        return view('contact', ['types' => $this->types]);
    }

  

    public function about(Request $request)
    {
        return view('about', ['types' => $this->types]);
    }
}

