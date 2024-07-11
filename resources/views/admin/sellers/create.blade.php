@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="p-5 bg-light rounded">
                <h2 class="mb-4">Inserisci un nuovo venditore</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('sellers.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Nome del venditore -->
                    <div class="form-group mb-3">
                        <label for="name" class="text-primary">Nome</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <!-- Codice del prodotto -->
                    <div class="form-group mb-3">
                        <label for="address" class="text-danger">Via</label>
                        <input type="text" name="address" id="address" class="form-control" required>
                    </div>

                    
                    <div class="form-group mb-3">
                        <label for="zip_code" class="text-danger">cap</label>
                        <input type="text" name="zip_code" id="zip_code" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="town" class="text-danger">Località</label>
                        <input type="text" name="town" id="town" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="city" class="text-danger">Città</label>
                        <input type="text" name="city" id="city" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="state" class="text-danger">Stato</label>
                        <input type="text" name="state" id="state" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="telephone" class="text-danger">Telefono</label>
                        <input type="text" name="telephone" id="telephone" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="email" class="text-danger">Email</label>
                        <input type="text" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="website" class="text-danger">Sito internet</label>
                        <input type="text" name="website" id="website" class="form-control" required>
                    </div>
                 

                    <button type="submit" class="btn btn-primary">Salva</button>
                </form>
            </div>
        </div>
    </div>
@endsection


