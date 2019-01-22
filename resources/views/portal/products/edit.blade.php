@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header px-4">Product wijzigen <span><a href="/users"><i class="la la-backward la-2x pull-right"></i></a></span></div>

                <div class="card-body">
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
                                <input type="text" class="form-control" name="price" value="{{ $product->price }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success">Opslaan</button>
                            </div>
                        </div>	
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection