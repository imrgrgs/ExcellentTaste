@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card w-100 mt-5">
                <div class="card-body">
                    <h3 class="card-title">Maak een reservering</h3>
                    <form method="post" action="{{ url('reservations/create') }}" id="reservate">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="date" class="col-sm-2 col-form-label">Datum</label>
                            <div class="col-sm-10">
                                <input type="text" id="date" name="date" class="form-control datepicker" value="{{ \Carbon\Carbon::now()->format('d-m-Y') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Tijd</label>
                            <div class="col-sm-10 form-row">
                                <input class="form-control col-lg-4 time" type="text" name="start_time" id="start_time" value="10:00" data-default="10:00">
                                <span class="col-lg-4 text-center">-</span>
                                @role('administrator')
                                    <input class="time form-control col-lg-4" data-default="23:00" type="text" name="end_time" id="end_time" value="23:00">
                                @endrole
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tables" class="col-sm-2 col-form-label">Tafels</label>
                            <div class="col-sm-10">
                                <select class="select form-control" name="tables[]" id="tables" multiple="multiple">
                                    @foreach($table_groups as $key => $table_group)
                                        <optgroup label="Tafel van {{ $key }}">
                                            @foreach($table_group as $table)
                                                <option data-content="{{ $table->seat_count }}" id="table_{{ $table->id }}" value="{{ $table->id }}">{{ $table->id }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="seat" class="col-sm-2 col-form-label">Stoelen
                                <small>(max. 8)</small>
                            </label>
                            <div class="col-sm-10">
                                <input type="text" name="seat" class="form-control-plaintext" readonly id="seat">
                            </div>
                        </div>
                        @role('administrator')
                        <div class="form-group row">
                            <label for="customer" class="col-sm-2 col-form-label">Gasten</label>
                            <div class="col-sm-10">
                                <select id="customer" class="select form-control" name="customer_id">
                                    <option>Kies een optie..</option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endrole
                        <div class="form-group row">
                            <label for="diet" class="col-sm-2 col-form-label">Dieet wensen</label>
                            <div class="col-sm-10">
                                <textarea id="diet" name="diet" class="form-control" placeholder="dieetwens, andere dieetwens"></textarea>
                            </div>
                        </div>
                    </form>
                    <div>
                        <button class="btn btn-success float-right" form="reservate">Reserveer</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card w-100 mt-5">
                <div class="card-body">
                    <h3 class="card-title">Excellent Taste Plattegrond</h3>
                    <div class="text-center">
                        <img src="/img/plattegrond.png">
                    </div>
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
        $('#start_time,#date').on('change', function () {
            getExcludedTables();
        });
        getExcludedTables();
    </script>
@stop
