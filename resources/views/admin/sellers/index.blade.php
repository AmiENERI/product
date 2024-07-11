<!-- resources/views/admin/sellers/index.blade.php -->
 
@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">
        <h2>Tutti i fornitori</h2>
        <div class="text-right mb-3">
            <a href="{{ route('sellers.create') }}" class="btn btn-success">Aggiungi Fornitore</a>
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
                        <th>Nome<a href="{{route('sellers.index',['sort' => $sort === 'name_asc' ? 'name_desc' : 'name_asc' ] ) }}">
                                <i class="fa-solid fa-arrow-{{$sort === 'name_asc' ? 'down' : 'up'}}"></i>
                            </a></th>
                        <th>Indirizzo</th>
                        <th>Cap</th>
                        <th>Località</th>
                        <th>Città</th>
                        <th>Stato</th>
                        <th>Telefono</th>
                        <th>Email</th>   
                        <th>Sito Web</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sellers as $seller)
                    <tr>
                        <td>{{ $seller->name }}</td>
                        <td>{{ $seller->address }}</td>
                        <td>{{ $seller->zip_code }}</td>
                        <td>{{ $seller->town }}</td>
                        <td>{{ $seller->city }}</td>
                        <td>{{ $seller->state }}</td>
                        <td>{{ $seller->telephone }}</td>
                        <td>{{ $seller->email }}</td>
                        <td>{{ $seller->website }}</td>
                        
                        <td>
                            <a href="{{ route('sellers.edit', $seller->id) }}" class="btn btn-primary btn-sm">Modifica</a>
                            <form action="{{ route('sellers.destroy', $seller->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Sei sicuro di voler eliminare questo fornitore?')">Elimina</button>
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
                @if ($sellers->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">&laquo;</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $sellers->appends(['sort' => $sort])->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                @endif
                
                {{-- Link alle pagine --}}
                @foreach ($sellers->getUrlRange(1, $sellers->lastPage()) as $page => $url)
                    <li class="page-item {{ $page == $sellers->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $sellers->appends(['sort' => $sort])->url($page) }}">{{ $page }}</a>
                    </li>
                @endforeach
                
                {{-- Link alla pagina successiva --}}
                @if ($sellers->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $sellers->appends(['sort' => $sort])->nextPageUrl() }}" aria-label="Next">
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


         