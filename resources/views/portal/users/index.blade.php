@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="card w-100 mt-5">
            <div class="card-body">
                <h3 class="card-title">Gebruikers</h3>
                <form method="POST" onsubmit="ConfirmDelete()" action="/users/delete/" enctype="multipart/form-data">
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
                            <th></th>
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
                                            <button type="submit" name="id" class="btn btn-danger" value="{{ $user->id }}">
                                                <i class="la la-close"></i>Delete
                                            </button>
                                        </td>
                            		</tr>
                        	@endforeach
                        </tbody>
                    </table>
                </form>
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>

@endsection