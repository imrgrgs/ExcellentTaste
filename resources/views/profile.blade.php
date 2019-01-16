
@extends ('layouts.app')

@section ('content')
    <div class="container col-md-3">
        <div class="form-group row">
            <label for="seat" class="col-sm-2 col-form-label">Naam</label>
            <div class="col-sm-10">
                <input type="text" name="seat" class="form-control-plaintext" readonly id="seat" value="{{$user->first_name}} {{$user->last_name}}">
            </div>
            <label for="seat" class="col-sm-2 col-form-label">Adres</label>
            <div class="col-sm-10">
                <input type="text" name="seat" class="form-control-plaintext" readonly id="seat" value="{{$user->address}}">
            </div>
            <label for="seat" class="col-sm-2 col-form-label">Postcode</label>
            <div class="col-sm-10">
                <input type="text" name="seat" class="form-control-plaintext" readonly id="seat" value="{{$user->postal}}">
            </div>
            <label for="seat" class="col-sm-2 col-form-label">Stad</label>
            <div class="col-sm-10">
                <input type="text" name="seat" class="form-control-plaintext" readonly id="seat" value="{{$user->city}}">
            </div>
            <label for="seat" class="col-sm-2 col-form-label">E-mail</label>
            <div class="col-sm-10">
                <input type="text" name="seat" class="form-control-plaintext" readonly id="seat" value="{{$user->email}}">
            </div>
            <label for="seat" class="col-sm-2 col-form-label">Mobiel</label>
            <div class="col-sm-10">
                <input type="text" name="seat" class="form-control-plaintext" readonly id="seat" value="{{$user->phone}}">
            </div>

            <button type="button" data-edit="false" class="btn btn-secondary" id="editform">Wijzigen</button>
        </div>
    </div>

    <script>
        $( "#editform" ).click(function() {
            if ($(this).attr('data-edit')==='false' ){
                $( 'input' ).removeClass( "form-control-plaintext" ).prop('readonly', false).addClass('form-control');
                $(this).attr('data-edit','true');
            } else{
                $( 'input' ).addClass( "form-control-plaintext" ).prop('readonly', true).removeClass('form-control');
                $(this).attr('data-edit','false');
            }
        });

    </script>
    @stop
