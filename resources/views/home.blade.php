@extends('layouts.app')

@section('content')
<div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <canvas id="reservation-chart" data-content="{{ implode(',',$reservations) }}"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
