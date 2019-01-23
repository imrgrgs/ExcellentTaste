@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <form method="post" action="{{ url('/tables/exclude') }}" class="row">
            @csrf
            <div class="card w-100">
                <div class="card-body">
                    <h3 class="card-title">Sluit tafels uit</h3>
                    <div class="form-group row">
                        <label for="date" class="col-sm-2 col-form-label">Start</label>
                        <div class="col-sm-10 form-row">
                            <input type="text" name="start_date" id="start_date" class="form-control datepicker col-lg-4" value="{{ \Carbon\Carbon::now()->format('d-m-Y') }}">
                            <input class="form-control col-lg-4 offset-md-2 time" type="text" name="start_time" id="start_time" value="10:00" data-default="10:00">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date" class="col-sm-2 col-form-label">Eind</label>
                        <div class="col-sm-10 form-row">
                            <input type="text" name="end_date" id="end_date" class="form-control datepicker col-lg-4" value="{{ \Carbon\Carbon::now()->format('d-m-Y') }}">
                            <input class="form-control offset-md-2 col-lg-4 time" type="text" name="end_time" id="end_time" value="10:00" data-default="10:00">
                        </div>
                    </div>
                    <hr>
                    <div>
                        <a href="{{ url('tables/excluded-tables') }}" id="excludes-table" data-options="" data-toggle="modal" class="btn btn-secondary">Tabel</a>
                        <button type="submit" class="btn btn-success float-right">Opslaan</button>
                    </div>
                </div>
            </div>
            @foreach($groups as $key => $group)
                <div class="col-lg-4 mt-3 justify-content-center">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Tafel van {{ $key }}</h5>
                            @foreach($group as $table)
                                <div class="row">
                                    <label for="{{ $table->id }}" class="col-sm-4 col-form-label">{{ $table->id }}</label>
                                    <div class="col-sm-6 text-center" id="{{ $table->id }}">
                                        <input type="checkbox" name="{{ $table->id }}" class="switcheroo"/>
                                    </div>
                                    <div class="col-sm-8">
                                        <span id="times"></span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </form>
    </div>
@stop

@section('scripts')
    <script>
        $('#end_time,#start_time,#start_date,#end_date').on('change', function () {
            getSwitchedTables();
        });
        $('#start_date, #end_date').on('change', function () {
            console.log('test');
            $('#excludes-table').attr('data-options','start='+ $('#start_date').val() +'&end='+ $('#end_date').val())
        });
        getSwitchedTables();
        $('#excludes-table').attr('data-options','start='+ $('#start_date').val() +'&end='+ $('#end_date').val())
    </script>
@endsection