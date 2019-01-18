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
                                    <input type="text" name="first_name" class="form-control-plaintext" readonly
                                           id="seat" value="{{$user->first_name}}">
                                </div>
                                <label for="seat" class="col-sm-4 col-form-label">Tussenvoegsel</label>
                                <div class="col-sm-8">
                                    <input type="text" name="middle_name" class="form-control-plaintext" readonly
                                           id="seat" value="{{$user->middle_name}}">
                                </div>
                                <label for="seat" class="col-sm-4 col-form-label">Achternaam</label>
                                <div class="col-sm-8">
                                    <input type="text" name="last_name" class="form-control-plaintext" readonly
                                           id="seat" value="{{$user->last_name}}">
                                </div>
                                <label for="seat" class="col-sm-4 col-form-label">Adres</label>
                                <div class="col-sm-8">
                                    <input type="text" name="address" class="form-control-plaintext" readonly id="seat"
                                           value="{{$user->address}}">
                                </div>
                                <label for="seat" class="col-sm-4 col-form-label">Postcode</label>
                                <div class="col-sm-8">
                                    <input type="text" name="postal" class="form-control-plaintext" readonly id="seat"
                                           value="{{$user->postal}}">
                                </div>
                                <label for="seat" class="col-sm-4 col-form-label">Stad</label>
                                <div class="col-sm-8">
                                    <input type="text" name="city" class="form-control-plaintext" readonly id="seat"
                                           value="{{$user->city}}">
                                </div>
                                <label for="seat" class="col-sm-4 col-form-label">E-mail</label>
                                <div class="col-sm-8">
                                    <input type="text" name="email" class="form-control-plaintext" readonly id="seat"
                                           value="{{$user->email}}">
                                </div>
                                <label for="seat" class="col-sm-4 col-form-label">Mobiel</label>
                                <div class="col-sm-8">
                                    <input type="text" name="phone" class="form-control-plaintext" readonly id="seat"
                                           value="{{$user->phone}}">
                                </div>
                                <label for="seat" class="col-sm-4 col-form-label">Klantnr.</label>
                                <div class="col-sm-8">
                                    <label type="text" name="number" class="form-control-plaintext" readonly
                                           id="seat">{{$user->number}}</label>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" data-edit="false" class="btn btn-secondary" id="editform">
                                        Wijzigen
                                    </button>
                                    <button type="submit" class="btn btn-success" id="submit">Opslaan</button>
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
                                    <input type="password" name="password" required class="form-control">
                                </div>
                                <label for="seat" class="col-sm-6 col-form-label">Bevestig wachtwoord</label>
                                <div class="col-sm-6">
                                    <input type="password" name="password_confirmation" required class="form-control">
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

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
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
            </script>
@stop
