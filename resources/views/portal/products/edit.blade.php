@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Product wijzigen</h3>
                    <hr>
                    <form method="POST" action="/products/{{ $product->id }}/update" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Naam</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputDescription" class="col-sm-2 col-form-label">Beschrijving</label>
                            <div class="col-sm-10"> 
                                <textarea class="form-control" rows="5" name="description">{{ $product->description }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPrice" class="col-sm-2 col-form-label">Prijs</label>
                            <div class="col-sm-10"> 
                                <input type="text" class="form-control" name="price" value="{{ number_format($product->price, 2, ',', '.') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <a class="btn btn-secondary" href="{{ url('/products') }}">Annuleren</a>
                                <button type="submit" class="btn btn-success">Opslaan</button>
                            </div>
                        </div>	
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection