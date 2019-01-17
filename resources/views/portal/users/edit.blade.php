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
                            <label for="inputName" class="col-sm-2 col-form-label">Naam</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputName" name="name" value="{{ $user->first_name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Tussenvoegsel</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputName" name="name" value="{{ $user->middle_name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Achternaam</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputName" name="name" value="{{ $user->last_name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputName" name="email" value="{{ $user->email }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputName" name="name" value="{{ $user->address }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Postcode</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputName" name="name" value="{{ $user->postal }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Plaats</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputName" name="name" value="{{ $user->city }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Telefoon</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputName" name="name" value="{{ $user->phone }}">
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
                    		<div class="col-sm-12">
                    			<button type="submit" class="btn btn-danger">blokkeer</button>
                    		</div>
                    	</div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection