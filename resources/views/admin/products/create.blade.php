@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="p-5 bg-light rounded">
                <h2 class="mb-4">Inserisci un nuovo prodotto</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Nme del prodotto -->
                    <div class="form-group mb-3">
                        <label for="name" class="text-primary">Nome</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="materials" class="text-warning">Materiale</label>
                        <select name="materials[]" id="materials" class="form-control" multiple required>
                            @foreach($materials as $material)
                                <option value="{{ $material->id }}">{{ $material->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="colors" class="text-warning">Colore</label>
                        <select name="colors[]" id="colors" class="form-control" multiple required>
                            @foreach($colors as $color)
                                <option value="{{ $color->id }}">{{ $color->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Descrizione del prodotto -->
                    <div class="form-group mb-3">
                        <label for="description" class="text-muted">Descrizione</label>
                        <textarea name="description" id="description" class="form-control" required></textarea>
                    </div>

                    <!-- Tipi di prodotto -->
                    <div class="form-group mb-3">
                        <label class="text-success">Tipo</label>
                        <div class="row">
                            @foreach($types as $type)
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" name="types[]" id="type{{ $type->id }}" value="{{ $type->id }}" class="form-check-input">
                                        <label for="type{{ $type->id }}" class="form-check-label">{{ $type->name }}</label>
                                    </div>
                                </div>                                
                            @endforeach
                        </div>
                    </div>

                    <!-- Codice del prodotto -->
                    <div class="form-group mb-3">
                        <label for="code" class="text-danger">Codice</label>
                        <input type="text" name="code" id="code" class="form-control" required>
                    </div>

                    <!-- Produttore del prodotto -->
                    <div class="form-group mb-3">
                        <label for="producer" class="text-success">Produttore</label>
                        <select name="producer_id" id="producer" class="form-control" required>
                            @foreach($producers as $producer)
                                <option value="{{ $producer->id }}">{{ $producer->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Venditori del prodotto -->
                    <div class="form-group mb-3">
                        <label for="sellers" class="text-warning">Fornitore</label>
                        <select name="sellers[]" id="sellers" class="form-control" multiple required>
                            @foreach($sellers as $seller)
                                <option value="{{ $seller->id }}">{{ $seller->name }}</option>
                            @endforeach
                        </select>
                    </div>
  
                    <div class="form-group mb-3">
                        <label for="price" class="text-danger">Prezzo</label>
                        <input type="text" name="price" id="price" class="form-control" required>
                    </div>
                    
                    <!-- Immagine del poster -->
                    <div class="form-group mb-4">
                        <label for="photo" class="text-primary">Immagine del prodotto</label>
                        <input type="file" name="photo" id="photo" class="form-control-file">
                    </div>

                    <button type="submit" class="btn btn-primary">Salva</button>
                </form>
            </div>
        </div>
    </div>
@endsection
