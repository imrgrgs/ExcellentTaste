@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <form method="post" action="{{ url('/tables/exclude') }}" class="row">
            @csrf
            <div class="card w-100">
                <div class="card-header">
                    <button type="submit" class="btn btn-success float-right">Opslaan</button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="date" class="col-sm-2 col-form-label">Start</label>
                        <div class="col-sm-10 form-row">
                            <input type="text" name="start_date" class="form-control datepicker col-lg-4">
                            <input class="form-control col-lg-4 offset-md-2 time" type="text" name="start_time" id="start_time" value="10:00" data-default="10:00">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date" class="col-sm-2 col-form-label">Eind</label>
                        <div class="col-sm-10 form-row">
                            <input type="text" name="end_date" class="form-control datepicker col-lg-4">
                            <input class="form-control offset-md-2 col-lg-4 time" type="text" name="end_time" id="end_time" value="10:00" data-default="10:00">
                        </div>
                    </div>
                </div>
            </div>
            @foreach($groups as $key => $group)
                <div class="col-lg-6 mt-3 justify-content-center">
                    <div class="card h-100">
                        <div class="card-header">
                            Tafel van {{ $key }}
                        </div>
                        <div class="card-body">
                            @foreach($group as $table)
                                <div class="row">
                                    <label for="{{ $table->id }}" class="col-sm-2 col-form-label">{{ $table->id }}</label>
                                    <div class="col-sm-10 text-center">
                                        <input type="checkbox" name="{{ $table->id }}" class="switcheroo" />
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