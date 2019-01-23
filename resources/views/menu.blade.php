@extends ('layouts.app')

@section ('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card col-md-12">
                <div class="card-body">
                    <h3 class="card-title">Menukaart</h3>
                    @foreach($categories as $category)
                        <h5 class="card-title mt-4">{{$category->name}}</h5>
                        <hr>
                        <div class="row">
                            @foreach($category->products as $product)
                                <div class="card col-md-3" style="width: 18rem;">
                                    <img class="card-img-top" src="http://lorempixel.com/400/200/food/{{$product->id}}" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$product->name}}</h5>
                                        <p class="card-text">{{$product->description}}</p>
                                        <p class="card-text"><b>Prijs: €{{$product->price}}</b></p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop
