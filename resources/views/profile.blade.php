@extends ('layouts.app')

@section ('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Mijn gegevens</h5>
                        <form method="post" action="/profile" class="col-md-12">
                            @csrf
                            <div class="form-group row">
                                <label for="seat" class="col-sm-4 col-form-label">Voornaam</label>
                                <div class="col-sm-8">
                                    <input type="text" name="first_name" class="form-control-plaintext" readonly id="seat" value="{{$user->first_name}}"/>
                                </div>
                                <label for="seat" class="col-sm-4 col-form-label">Tussenvoegsel</label>
                                <div class="col-sm-8">
                                    <input type="text" name="middle_name" class="form-control-plaintext" readonly id="seat" value="{{$user->middle_name}}"/>
                                </div>
                                <label for="seat" class="col-sm-4 col-form-label">Achternaam</label>
                                <div class="col-sm-8">
                                    <input type="text" name="last_name" class="form-control-plaintext" readonly id="seat" value="{{$user->last_name}}"/>
                                </div>
                                <label for="seat" class="col-sm-4 col-form-label">Adres</label>
                                <div class="col-sm-8">
                                    <input type="text" name="address" class="form-control-plaintext" readonly id="seat" value="{{$user->address}}"/>
                                </div>
                                <label for="seat" class="col-sm-4 col-form-label">Postcode</label>
                                <div class="col-sm-8">
                                    <input type="text" name="postal" class="form-control-plaintext" readonly id="seat" value="{{$user->postal}}"/>
                                </div>
                                <label for="seat" class="col-sm-4 col-form-label">Stad</label>
                                <div class="col-sm-8">
                                    <input type="text" name="city" class="form-control-plaintext" readonly id="seat" value="{{$user->city}}"/>
                                </div>
                                <label for="seat" class="col-sm-4 col-form-label">E-mail</label>
                                <div class="col-sm-8">
                                    <input type="text" name="email" class="form-control-plaintext" readonly id="seat" value="{{$user->email}}"/>
                                </div>
                                <label for="seat" class="col-sm-4 col-form-label">Mobiel</label>
                                <div class="col-sm-8">
                                    <input type="text" name="phone" class="form-control-plaintext" readonly id="seat" value="{{$user->phone}}"/>
                                </div>
                                <label for="seat" class="col-sm-4 col-form-label">Klantnr.</label>
                                <div class="col-sm-8">
                                    <label type="text" name="number" class="form-control-plaintext" readonly id="seat">{{$user->number}}</label>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" data-edit="false" class="btn btn-secondary" id="editform">Wijzigen</button>
                                    <button type="submit" class="btn btn-success" id="submit">Opslaan</button>
                                </div>
                                <div class="col-md-3">
                                    <a href="/profile/delete" class="btn btn-danger" onclick="return confirm('Weet u zeker dat u uw account wilt verwijderen?');" id="">Verwijderen</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Wachtwoord wijzigen</h5>
                        <form method="post" action="/profile/password" class="col-md-12">
                            @csrf
                            <div class="row">
                                <label for="seat" class="col-sm-6 col-form-label">Nieuw wachtwoord</label>
                                <div class="col-sm-6">
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <label for="seat" class="col-sm-6 col-form-label">Bevestig wachtwoord</label>
                                <div class="col-sm-6">
                                    <input type="password" name="password_confirmation" class="form-control">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <button type="submit" class="btn btn-success">Opslaan</button>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <div class="g-recaptcha"
                                            data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <p id="passwordHelpBlock" class="form-text text-muted">
                                        Een toegestaan wachtwoord heeft minimaal: </br>
                                        - 8 karakters </br>
                                        - hoofdletter </br>
                                        - kleineletter </br>
                                        - speciaal teken </br>
                                        - cijfer </br>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title">Mijn reserveringen</h5>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <td>
                                    Datum
                                </td>
                                <td>
                                    Tijd
                                </td>
                                <td>
                                    Tafelnummer
                                </td>
                                <td>
                                    Aantal Stoelen
                                </td>
                                <td>
                                    Dieet Wensen
                                </td>
                                <td>
                                    Reserveringsnr.
                                </td>
                                <td>
                                    Nota downloaden
                                </td>
                                <td>
                                    &nbsp;
                                </td>
                            </tr>
                           </thead>
                           @foreach($user->reservations as $reservation)
                           <tr>
                               <td>
                                   {{$reservation->date_string}}
                               </td>
                               <td>
                                   {{$reservation->tables->first()->start_time}} - {{$reservation->tables->first()->end_time}}
                               </td>
                               <td>
                                   {{$reservation->tables->first()->id}}
                               </td>
                               <td>
                                   {{$reservation->tables->first()->seat_count}}
                               </td>
                               <td>
                                   <span class="d-inline-block text-truncate" style="max-width: 150px;">
                                       <span data-toggle="tooltip" data-placement="bottom" title="{{$reservation->diet}}"> {{$reservation->diet}}</span>
                                   </span>
                               </td>
                               <td>
                                   {{$reservation->number}}
                               </td>
                               <td>
                                   <a href="/reservations/{{$reservation->number}}/download-nota">{{$reservation->number}}.pdf</a>
                               </td>
                               <td>
                                   <a href="/profile/{{$reservation->id}}/delete" class="btn btn-danger" onclick="return confirm('Weet u zeker dat u uw reservering wilt verwijderen?');" id="">Verwijderen</a>
                               </td>
                           </tr>
                            @endforeach
                       </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script type="text/javascript">
        $('#submit').hide()
        $("#editform").click(function () {
            if ($(this).attr('data-edit') === 'false') {
                $('input').removeClass("form-control-plaintext").prop('readonly', false).addClass('form-control');
                $(this).attr('data-edit', 'true');
                $('#submit').toggle()
                $('#editform').toggle()
            }
        });
        $("#submit").click(function () {
            {
                $('input').addClass("form-control-plaintext").prop('readonly', true).removeClass('form-control');
                $("#editform").attr('data-edit', 'false');
                $('#submit').toggle()
                $('#editform').toggle()
            }
        });
        $('[data-toggle="tooltip"]').tooltip();
    </script>
@stop
