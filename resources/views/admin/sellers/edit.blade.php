@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-sm">
                <div class="card-body p-5 bg-light rounded">
                    <h2 class="mb-4">Modifica Venditore</h2>
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('sellers.update', $seller->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Titolo del  -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $seller->name }}">
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Indirizzo</label>
                            <input type="text" name="address" id="address" class="form-control" value="{{ $seller->address }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="zip_code" class="text-danger">cap</label>
                            <input type="text" name="zip_code" id="zip_code" class="form-control" value="{{ $seller->zip_code }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="town" class="text-danger">Località</label>
                            <input type="text" name="town" id="town" class="form-control" value="{{ $seller->town }}" required>
                        </div> 
                        
                        <div class="form-group mb-3">
                            <label for="city" class="text-danger">Città</label>
                            <input type="text" name="city" id="city" class="form-control" value="{{ $seller->city }}" required>
                        </div> 

                        <div class="form-group mb-3">
                            <label for="state" class="text-danger">Paese</label>
                            <input type="text" name="state" id="state" class="form-control" value="{{ $seller->state }}" required>
                        </div> 

                        <div class="form-group mb-3">
                            <label for="telephone" class="text-danger">Telefono</label>
                            <input type="text" name="telephone" id="telephone" class="form-control" value="{{ $seller->telephone }}" required>
                        </div> 

                        <div class="form-group mb-3">
                            <label for="email" class="text-danger">Email</label>
                            <input type="text" name="email" id="email" class="form-control" value="{{ $seller->email }}" required>
                        </div> 

                        <div class="form-group mb-3">
                            <label for="website" class="text-danger">Sito Web</label>
                            <input type="text" name="website" id="website" class="form-control" value="{{ $seller->website }}" required>
                        </div> 

                        <button type="submit" class="btn btn-primary">Salva Modifiche</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

