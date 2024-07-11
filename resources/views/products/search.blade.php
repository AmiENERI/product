@extends('layouts.app')

@section('content')
<div class="container">
    {{-- @dd($products) --}}
    <h2>Risultati di ricerca</h2>
    <div class="row">
        @if($products->isEmpty())
         <h2>Non ci sono risultati</h2>
        @else
       @foreach($products as $product)
       <div class="col-md-4">
            <div class="card">
                <div class="film-poster overflow-hidden">
                    @if (filter_var($product->photo, FILTER_VALIDATE_URL))
                        <img src="{{ $product->photo }}" alt="Foto del prodotto" class="img-fluid">
                    @else
                        <img src="{{ asset('storage/' . $product->photo) }}" alt="Foto del prodotto" class="img-fluid">
                    @endif
                </div>
                <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text"><strong>Codice:</strong> {{ $product->code }}</p>
                    <p class="card-text"><strong>Produttore:</strong> {{ $product->producer->name }}</p>
                    <p class="card-text"><strong>Made in:</strong> {{ $product->producer->country_of_production }}</p>
                    <p class="card-text"><strong>Materiali:</strong>
                    @foreach($product->materials as $material)
                    {{ $material->name }} 
                    @unless($loop->last), @endunless
                    @endforeach
                  </p>
                    <p class="card-text"><strong>Colori:</strong>
                    @foreach($product->colors as $color)
                    {{ $color->name }} 
                    @unless($loop->last), @endunless
                    @endforeach
                  </p>
                  <p class="card-text"><strong>Prezzo: € </strong> {{ $product->price }}</p>
                  <p class="card-text"><strong>Descrizione: </strong> {{ $product->description }}</p>
                </div>
            </div>
       </div>
       @endforeach
       @endif
    </div>
</div>

@endsection
