@extends('layouts.modal')

@section('title')
    Uitgesloten tafels tussen {{ $start->format('d-m-Y') }} - {{ $end->format('d-m-Y') }}
@stop

@section('content')
    @foreach($tables as $table)
        Tafel nummer: {{ $table->id }}
        <hr>
        <ul>
            @foreach($table->excluded as $exclude)
                <li>{{ $exclude->carbon_start->format('H:m') }} - {{ $exclude->carbon_end->format('H:m') }}</li>
            @endforeach
        </ul>
    @endforeach
@stop