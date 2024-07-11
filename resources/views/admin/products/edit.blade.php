@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-sm">
                <div class="card-body p-5 bg-light rounded">
                    <h2 class="mb-4">Modifica Prodotto</h2>
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    
                    <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                            <!-- Nome del prodotto -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}">
                            </div>

                            <!-- Tipi di prodotto -->

                            <div class="mb-3">
                                <label for="materials" class="form-label">Materiale</label>
                                <select name="materials[]" id="materials" class="form-control" multiple required>
                                    @foreach($materials as $material)
                                        <option value="{{ $material->id }}" {{ in_array($material->id, $product->materials->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $material->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Colore</label>
                                <div class="row">
                                    @foreach($colors as $color)
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input type="checkbox" name="colors[]" id="color{{ $color->id }}" value="{{ $color->id }}" class="form-check-input" {{ in_array($color->id, $product->colors->pluck('id')->toArray()) ? 'checked' : '' }}>
                                                <label for="color{{ $color->id }}" class="form-check-label">{{ $color->name }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        <!-- Descrizione del prodotto -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Descrizione</label>
                            <textarea name="description" id="description" class="form-control" required>{{ $product->description }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="types" class="form-label">Tipo</label>
                            <select name="types[]" id="types" class="form-control" multiple required>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}" {{ in_array($type->id, $product->types->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
 
                        <!-- Codice del prodotto -->
                        <div class="mb-3">
                            <label for="code" class="form-label">Codice</label>
                            <input type="text" name="code" id="code" class="form-control" value="{{ $product->code }}" required>
                        </div>

                        <!-- Produttori del prodotto -->
                        <div class="mb-3">
                            <label for="producer" class="form-label">Produttore</label>
                            <select name="producer_id" id="producer" class="form-control" required>
                                @foreach($producers as $producer)
                                    <option value="{{ $producer->id }}" {{ $product->producer_id == $producer->id ? 'selected' : '' }}>{{ $producer->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Venditori del prodotto -->
                        <div class="mb-3">
                            <label for="sellers" class="form-label">Fornitore</label>
                            <select name="sellers[]" id="sellers" class="form-control" multiple required>
                                @foreach($sellers as $seller)
                                    <option value="{{ $seller->id }}" {{ in_array($seller->id, $product->sellers->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $seller->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="price" class="text-danger">Prezzo</label>
                            <input type="text" name="price" id="price" class="form-control" value="{{ $product->price }}" required>
                        </div>

                        <!-- Immagine del poster -->
                        <div class="mb-3">
                            <label for="photo" class="form-label">Immagine del prodotto</label>
                            <input type="file" name="photo" id="photo" class="form-control-file">
                            <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}" class="img-thumbnail mt-2" style="max-width: 200px;">
                        </div>

                        <button type="submit" class="btn btn-primary">Salva Modifiche</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
