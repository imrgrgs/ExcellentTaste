@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header px-4">Gebruikers <span><a href="/users/create"><i class="la la-plus-circle la-2x pull-right"></i></a></span></div>

            <div class="card-body">
                <form method="POST" onsubmit="ConfirmDelete()" action="/user/delete" enctype="multipart/form-data">
                    {{ csrf_field('DELETE') }}
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Klantnummer</th>
                            <th>Naam</th>
                            <th>Achternaam</th>
                            <th>Plaats</th>
                            <th>Telefoon</th>
                        </tr>
                        </thead>
                        <tbody>
                        	@foreach($users as $user)
                        		<tr>
                        			<td>
                        				<a href="/users/{{ $user->id }}/edit">{{$user->id}}</a>
                        			</td>
                        			<td>{{$user->number}}</td>
                        			<td>{{$user->first_name}}</td>
                        			<td>{{$user->middle_name}} {{$user->last_name}}</td>
                        			<td>{{$user->city}}</td>
                        			<td>{{$user->phone}}</td>
                                    <td>
                                        <button type="submit" name="btn" class="btn btn-danger" value="{{ $user->id }}">
                                            <i class="la la-close"></i>Delete
                                        </button>
                                    </td>
                        		</tr>
                        	@endforeach
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection