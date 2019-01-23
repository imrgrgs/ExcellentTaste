@extends('layouts.app')

@section('content')
<script src="{{ asset('js/order.js') }}" defer></script>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Reservering</label>
                    <select class="form-control select">
                    @foreach($reservations as $reservation)
                        <option>{{$reservation->number}}</option>
                    @endforeach
                </select>
              </div>
        </div>
        <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Device</label>
                    <select class="form-control select">
                    @foreach($devices as $device)
                        <option>{{$device}}</option>
                    @endforeach
                </select>
              </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        {{ csrf_field() }}
        <div class="col-lg-6">
            <div class="card">
                <form method="POST" action="/orders/create" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header px-4">Bestelling</div>
                    <div class="card-body order" id="orders"></div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-success" id="save-but">Opslaan</button>
                        </div>
                    </div>
                </form> 
            </div>
        </div>
        {{-- right side --}}
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header px-4">Producten</div>
                @foreach($products as $product)
                    <div class="card-body border-bot products" id="{{$product->id}}"><span>{{$product->name}}</span>
                        <a data-target="{{$product->id}}"><i class="fas fa-plus-square fa-2x pull-right"></i></a>
                    </div>
                @endforeach
            </div>
        </div>      
    </div>
</div>
@endsection
