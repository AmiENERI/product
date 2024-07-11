@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach ($products as $product)
        <div class="col-md-3 mb-4">
            <div class="card-deck mt-4 h-100 ">
                <div class="film-poster overflow-hidden text-center">
                    @if (filter_var($product->photo, FILTER_VALIDATE_URL))
                        <img src="{{ $product->photo }}" alt="{{ $product->name }}" class="img-thumbnail"
                                style="max-width: 200px;">
                            @elseif($product->photo === null)
                    @else
                        <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}" class="img-thumbnail" style="max-width: 200px;">
                    @endif
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text"><strong>Prezzo: € </strong> {{ $product->price }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- Paginazione -->
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
                        <a class="page-link" href="{{ $products->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                @endif
                
                {{-- Link alle pagine --}}
                @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                    <li class="page-item {{ $page == $products->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
                
                {{-- Link alla pagina successiva --}}
                @if ($products->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $products->nextPageUrl() }}" aria-label="Next">
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
    
    {{-- Mostra i risultati --}}
    <div class="text-center">
        <p>
            {{ __('pagination.showing_results', [
                'first' => $products->firstItem(),
                'last' => $products->lastItem(),
                'total' => $products->total(),
            ]) }}
        </p>
    </div>
    
    
</div>
@endsection
