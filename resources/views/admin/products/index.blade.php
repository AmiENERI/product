<!-- resources/views/admin/products/index.blade.php -->
 
@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <h2>Tutti i prodotti</h2>
        <div class="text-right mb-3">
            <a href="{{ route('products.create') }}" class="btn btn-success">Aggiungi Prodotto</a>
        </div>
        {{-- Messaggi di errore e successo --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nome
                        <a href="{{route('products.index',['sort' => $sort === 'name_asc' ? 'name_desc' : 'name_asc' ] ) }}">
                                <i class="fa-solid fa-arrow-{{$sort === 'name_asc' ? 'down' : 'up'}}"></i>
                            </a>
                        </th>
                        <th>Immagine</th>
                        <th>Produttore
                        <a href="{{ route('products.index', ['sort' => $sort === 'producer_asc' ? 'producer_desc' : 'producer_asc']) }}">
                                <i class="fa-solid fa-arrow-{{ $sort === 'producer_asc' ? 'down' : 'up' }}"></i>
                            </a>  
                        </th>
                        <th>Venditore</th>
                        <th>Tipo</th>
                        <th>Codice
                        <a href="{{route('products.index',['sort' => $sort === 'code_asc' ? 'code_desc' : 'code_asc' ] ) }}">
                                <i class="fa-solid fa-arrow-{{$sort === 'code_asc' ? 'down' : 'up'}}"></i>
                            </a>
                        </th>
                        <th>Colore</th>
                        <th>Materiale</th>
                        <th>Descrizione</th>
                        <th>Prezzo</th>
                        <th>Modifiche</th>    
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                         <td>
                            @if (filter_var($product->photo, FILTER_VALIDATE_URL))
                            <img src="{{ $product->photo }}" alt="{{ $product->name }}" class="img-thumbnail"
                                style="max-width: 200px;">
                            @elseif($product->photo === null)
                            @else
                            <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}"
                                class="img-thumbnail" style="max-width: 200px;">
                            @endif
                        </td>
                        <td>{{ $product->producer->name }}</td>
                        <td>@foreach($product->sellers as $seller)
                            {{ $seller->name }}
                            @endforeach</td>
                        {{-- @dd($product->sellers) --}}
                        <td>
                        {{-- @dd($product->types) --}}
                        @foreach($product->types as $type)
                            {{ $type->name }}
                        @endforeach
                        </td>
                        <td>{{ $product->code }}</td>
                        <td>
                        {{-- @dd($product->colors) --}}
                        @foreach($product->colors as $color)
                            {{ $color->name }}
                        @endforeach
                        </td>
                        <td>
                        {{-- @dd($product->materials) --}}
                        @foreach($product->materials as $material)
                            {{ $material->name }}
                        @endforeach
                        </td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm">Modifica</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Sei sicuro di voler eliminare questo prodotto?')">Elimina</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="pagination-container">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                {{-- Link alla pagina precedente --}}
                @if ($products->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">&laquo;</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $products->appends(['sort' => $sort])->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                @endif
                
                {{-- Link alle pagine --}}
                @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                    <li class="page-item {{ $page == $products->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $products->appends(['sort' => $sort])->url($page) }}">{{ $page }}</a>
                    </li>
                @endforeach
                
                {{-- Link alla pagina successiva --}}
                @if ($products->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $products->appends(['sort' => $sort])->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link">&raquo;</span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</div>
@endsection