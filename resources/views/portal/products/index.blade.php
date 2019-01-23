@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="card w-100 mt-5">
                <div class="card-body">
                    <div class="row"><h3 class=" card-title col-lg-6">Producten</h3><span class="col-lg-6 text-right"><a href="/products/create"><i class="fas fa-plus-circle fa-2x"></i></a></span></div>
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