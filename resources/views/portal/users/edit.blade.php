@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header px-4">Gebruiker wijzigen <span><a href="/users"><i class="la la-backward la-2x pull-right"></i></a></span></div>

                <div class="card-body">
                    <form method="POST" action="/users/{{ $user->id }}/update" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <label for="inputFirstName" class="col-sm-2 col-form-label">Naam</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputFirstName" name="inputFirstName" value="{{ $user->first_name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputMiddleName" class="col-sm-2 col-form-label">Tussenvoegsel</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputMiddleName" name="inputMiddleName" value="{{ $user->middle_name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputLastName" class="col-sm-2 col-form-label">Achternaam</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputLastName" name="inputLastName" value="{{ $user->last_name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputEmail" name="inputEmail" value="{{ $user->email }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputAddress" name="inputAddress" value="{{ $user->address }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPostal" class="col-sm-2 col-form-label">Postcode</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputPostal" name="inputPostal" value="{{ $user->postal }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputCity" class="col-sm-2 col-form-label">Plaats</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputCity" name="inputCity" value="{{ $user->city }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPhone" class="col-sm-2 col-form-label">Telefoon</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputPhone" name="inputPhone" value="{{ $user->phone }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success">Opslaan</button>
                            </div>
                        </div>	
                    </form>
                    <form method="POST" action="/users/{{ $user->id }}/block" enctype="multipart/form-data">
                    	{{ csrf_field() }}
                    	<div class="form-group row">
                            @if($user->active)
                        		<div class="col-sm-12">
                        			<button type="submit" class="btn btn-danger">blokkeer</button>
                        		</div>
                            @else
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-danger">Activeer</button>
                                </div>
                            @endif
                    	</div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection