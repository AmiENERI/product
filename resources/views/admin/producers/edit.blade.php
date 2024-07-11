@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-sm">
                <div class="card-body p-5 bg-light rounded">
                    <h2 class="mb-4">Modifica Produttore</h2>
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('producers.update', $producer->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Titolo del  -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $producer->name }}">
                        </div>

                        <div class="mb-3">
                            <label for="country_of_production" class="text-danger">Paese di produzione</label>
                            <input type="text" name="country_of_production" id="country_of_production" class="form-control" value="{{ $producer->country_of_production }}">
                        </div>
                    

                        <button type="submit" class="btn btn-primary">Salva Modifiche</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

