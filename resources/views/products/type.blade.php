@extends('layouts.app')

@section('content')
<div class="container">
    

    <div class="row">
        @foreach ($products as $product)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card">
                @if (filter_var($product->photo, FILTER_VALIDATE_URL))
                <img src="{{ $product->photo }}" class="card-img-top" alt="{{ $product->name }}">
                @elseif($product->photo === null)
                <img src="https://cdn.pixabay.com/photo/2023/08/11/16/50/water-8183918_1280.jpg" class="card-img-top"
                    alt="{{ $product->name }}">
                @else
                <img src="{{ asset('storage/' . $product->photo) }}" class="card-img-top" alt="{{ $product->name }}">
                @endif
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
                    
                    <p class="card-text"><strong>Descrizione:</strong> {{ $product->description }} </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

   
</div>
@endsection
