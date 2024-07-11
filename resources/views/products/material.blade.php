@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Prodotti per materiale: {{ $material->name }}</h2>

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
                    <p class="card-text">{{ $product->description }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

   
</div>
@endsection
