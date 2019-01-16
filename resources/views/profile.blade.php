
@extends ('layouts.app')

@section ('content')
    <div class="container col-md-3 list">
        <form method="post" action="/profile">
            @csrf
            <div class="form-group row">
                <label for="seat" class="col-sm-3 col-form-label">Voornaam</label>
                <div class="col-sm-9">
                    <input type="text" name="first_name" class="form-control-plaintext" readonly id="seat" value="{{$user->first_name}}">
                </div>
                <label for="seat" class="col-sm-3 col-form-label">Tussenvoegsel</label>
                <div class="col-sm-9">
                    <input type="text" name="middle_name" class="form-control-plaintext" readonly id="seat" value="{{$user->middle_name}}">
                </div>
                <label for="seat" class="col-sm-3 col-form-label">Achternaam</label>
                <div class="col-sm-9">
                    <input type="text" name="last_name" class="form-control-plaintext" readonly id="seat" value="{{$user->last_name}}">
                </div>
                <label for="seat" class="col-sm-3 col-form-label">Adres</label>
                <div class="col-sm-9">
                    <input type="text" name="address" class="form-control-plaintext" readonly id="seat" value="{{$user->address}}">
                </div>
                <label for="seat" class="col-sm-3 col-form-label">Postcode</label>
                <div class="col-sm-9">
                    <input type="text" name="postal" class="form-control-plaintext" readonly id="seat" value="{{$user->postal}}">
                </div>
                <label for="seat" class="col-sm-3 col-form-label">Stad</label>
                <div class="col-sm-9">
                    <input type="text" name="city" class="form-control-plaintext" readonly id="seat" value="{{$user->city}}">
                </div>
                <label for="seat" class="col-sm-3 col-form-label">E-mail</label>
                <div class="col-sm-9">
                    <input type="text" name="email" class="form-control-plaintext" readonly id="seat" value="{{$user->email}}">
                </div>
                <label for="seat" class="col-sm-3 col-form-label">Mobiel</label>
                <div class="col-sm-9">
                    <input type="text" name="phone" class="form-control-plaintext" readonly id="seat" value="{{$user->phone}}">
                </div>
                <label for="seat" class="col-sm-3 col-form-label">Klantnr.</label>
                <div class="col-sm-9">
                    <label type="text" name="number" class="form-control-plaintext" readonly id="seat" >{{$user->number}}</label>
                </div>

                <button type="button" data-edit="false" class="btn btn-secondary" id="editform">Wijzigen</button>
                <button type="submit" class="btn btn-success" id="submit">Opslaan</button>
            </div>
        </form>
    </div>

    <script type="text/javascript">
        $('#submit').hide()
        $( "#editform" ).click(function() {
            if ($(this).attr('data-edit')==='false' )
            {
                $( 'input' ).removeClass( "form-control-plaintext" ).prop('readonly', false).addClass('form-control');
                $(this).attr('data-edit','true');
                $('#submit').toggle()
                $('#editform').toggle()
            }
        });
            $( "#submit" ).click(function(){
            {
                $( 'input' ).addClass( "form-control-plaintext" ).prop('readonly', true).removeClass('form-control');
                $( "#editform" ).attr('data-edit','false');
                $('#submit').toggle()
                $('#editform').toggle()
                new PNotify({
                    title: 'Opgeslagen',
                    text: 'Uw wijzigingen zijn opgeslagen',
                    type: 'success',
                    hide: false
                });
            }
        });
    </script>
    @stop
