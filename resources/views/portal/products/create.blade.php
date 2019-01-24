@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Product toevoegen</h3>
                    <hr>
                    <form method="POST" action="/products/create" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Naam</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Naam" name="name">
                            </div>
                            @if($errors->has('name'))
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="inputDescription" class="col-sm-2 col-form-label">Beschrijving</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="5" name="description" placeholder="Description"></textarea>
                            </div>
                            @if($errors->has('name'))
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="inputPrice" class="col-sm-2 col-form-label">Prijs</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Prijs" name="price">
                            </div>
                            @if($errors->has('name'))
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="category_id" class="col-sm-2 col-form-label">Categorie</label>
                            <div class="col-sm-10">
                                <select class="select form-control" name="category_id">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <a class="btn btn-secondary" href="{{ url('/products') }}">Annuleren</a>
                                <button type="submit" class="btn btn-success pull-right">Opslaan</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection