@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card w-100">
                <div class="card-header">
                    <h3>Maak een reservering</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ url('reservations/create') }}" id="reservate">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="tables" class="col-sm-2 col-form-label">Tables</label>
                            <div class="col-sm-10">
                                <select class="select form-control" name="tables[]" id="tables" multiple="multiple">
                                    @foreach($table_groups as $key => $table_group)
                                        <optgroup label="Tafel van {{ $key }}">
                                            @foreach($table_group as $table)
                                                <option data-content="{{ $table->seat_count }}" value="{{ $table->id }}">{{ $table->id }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="seat" class="col-sm-2 col-form-label">Stoelen <small>(max. 8)</small></label>
                            <div class="col-sm-10">
                                <input type="text" name="seat" class="form-control-plaintext" readonly id="seat">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date" class="col-sm-2 col-form-label">Datum</label>
                            <div class="col-sm-10">
                                <input type="text" name="date" class="form-control datepicker">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Time</label>
                            <div class="col-sm-10 form-row">
                                <input class="form-control col-lg-4 time" type="text" name="start_time" id="start_time" value="10:00" data-default="10:00">
                                <span class="col-lg-4 text-center">-</span>
                                <input class="time form-control col-lg-4" data-default="23:00" type="text" name="end_time" id="end_time" value="23:00">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customer" class="col-sm-2 col-form-label">Gasten</label>
                            <div class="col-sm-10">
                                <select id="customer" class="select form-control" name="customer">
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->number }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success float-right" form="reservate">Reserveer</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $('#tables').on('change', function () {
            let chairs = 0;
            $('#seat').removeClass('text-danger');

            $(this).find(':selected').each(function () {
                chairs = chairs + parseInt($(this).attr('data-content'));
            });

            if (chairs > 8) {
                $('#seat').addClass('text-danger')
            }
            $('#seat').val(chairs)
        });

        $('.time').focusout(function (e) {
            let time = $(this).val().split(':');
            if (time[0] > 22 || time[0] < 9 || time[1] > 61 || !$(this).val().includes(':')) {
                $(this).val($(this).attr('data-default'));
            }
        });

        $('.datepicker').datepicker({
            format: "dd/mm/yyyy",
            startDate: "15-01-2019",
            clearBtn: true,
            language: "nl",
            todayHighlight: true
        });
        $('.select').select2();
    </script>
@stop