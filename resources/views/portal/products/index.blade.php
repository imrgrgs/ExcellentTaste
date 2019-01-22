@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header px-4">Producten <span class="pull-right"><a href="/products/create"><i class="fas fa-plus-circle fa-2x"></i></a></span></div>

            <div class="card-body">
                <form method="POST" onsubmit="ConfirmDelete()" action="/products/delete/" enctype="multipart/form-data">
                    {{ csrf_field('DELETE') }}
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Naam</th>
                            <th>Beschrijving</th>
                            <th>Prijs</th>
                        </tr>
                        </thead>
                        <tbody>
                        	@foreach($products as $product)
                            		<tr>
                            			<td>
                            				<a href="/products/{{ $product->id }}/edit">{{$product->id}}</a>
                            			</td>
                            			<td>{{$product->name}}</td>
                            			<td>{{$product->description}}</td>
                            			<td>{{$product->price}}</td>
                                        <td>
                                            <button type="submit" name="id" class="btn btn-danger" value="{{ $product->id }}">Delete
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