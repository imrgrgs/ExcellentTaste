@extends ('layouts.layout')

@section ('content')
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="w-100 h-100" style="background: url('{{ url('img/close-up.jpg') }}') bottom; background-size: cover" alt="food"></div>
            <div class="container">
                <div class="carousel-caption text-left">
                </div>
            </div>
        </div>
    </div>
    <div class="container text-black-50 mb-5">
        <div class="row" style="margin-top: -100px;">
            <div class="card col-md-12">
                <div class="card-body">
                    <h3 class="card-title">Menukaart</h3>
                    @foreach($categories as $category)
                        <h5 class="card-title mt-4">{{$category->name}}</h5>
                        <hr>
                        <div class="row justify-content-center">
                            @foreach($category->products as $product)
                                <div class="card col-md-3 m-4">
                                    <img class="card-img-top" src="http://lorempixel.com/286/180/food/{{$product->id}}" alt="Card image cap">
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
