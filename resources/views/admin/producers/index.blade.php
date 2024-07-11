<!-- resources/views/admin/producers/index.blade.php -->
 
@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">
        <h2>Tutti i venditori</h2>
        <div class="text-right mb-3">
            <a href="{{ route('producers.create') }}" class="btn btn-success">Aggiungi Produttore</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Paese di produzione</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($producers as $producer)
                    <tr>
                        <td>{{ $producer->name }}</td>
                        <td>{{ $producer->country_of_production }}</td>
                        <td>
                            <a href="{{ route('producers.edit', $producer->id) }}" class="btn btn-primary btn-sm">Modifica</a>
                            <form action="{{ route('producers.destroy', $producer->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Sei sicuro di voler eliminare questo produttore?')">Elimina</button>
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
                @if ($producers->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">&laquo;</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $producers->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                @endif
                
                {{-- Link alle pagine --}}
                @foreach ($producers->getUrlRange(1, $producers->lastPage()) as $page => $url)
                    <li class="page-item {{ $page == $producers->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
                
                {{-- Link alla pagina successiva --}}
                @if ($producers->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $producers->nextPageUrl() }}" aria-label="Next">
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


         