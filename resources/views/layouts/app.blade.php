<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Excellent Taste</title>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script type="text/javascript" src="js/pnotify.custom.min.js"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link href="{{ asset('css/carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.standalone.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.6.0/css/bootstrap-slider.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.css" rel="stylesheet" type="text/css">
    <link href="css/pnotify.custom.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="https://raw.githubusercontent.com/daneden/animate.css/master/animate.css" media="all" rel="stylesheet" type="text/css" />


    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

</head>
    <body id="app" class="bg-light">
        <div class="container-fluid">
            <div class="row">
                <aside class="col-12 col-md-2 p-0 bg-dark fixed-top">
                    <nav class="navbar navbar-expand navbar-dark bg-red flex-md-column border-right border-secondary flex-row align-items-start py-2">
                        <div class="collapse navbar-collapse align-items-start">
                            <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between">
                                <li class="nav-item" id="company-name">
                                    <a class="nav-link pl-0 text-nowrap" href="#">
                                        <img src="{{ url('img/logo.png') }}" class="img-fluid w-25"><span class="font-weight-bold">Excellent Taste</span>
                                    </a>
                                </li>
                                @role('administrator')
                                    <li class="nav-item {{ request()->is('home') ? 'active' : '' }}">
                                        <a class="nav-link pl-0" href="{{ url('/home') }}"><i class="fas fa-home"></i>
                                            <span class="d-none d-md-inline">Home</span>
                                        </a>
                                    </li>
                                @endrole
                                <li class="nav-item {{ request()->is('profile') ? 'active' : '' }}">
                                    <a class="nav-link pl-0" href="{{ url('/profile') }}"><i class="fas fa-address-card"></i>
                                        <span class="d-none d-md-inline">Profiel</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link pl-0" href="#"><i class="fa fa-book fa-fw"></i>
                                        <span class="d-none d-md-inline">Menu</span>
                                    </a>
                                </li>
                                @auth
                                    <li class="nav-item {{ request()->is('reservations/create') ? 'active' : '' }}">
                                        <a class="nav-link pl-0" href="{{ url('reservations/create') }}"><i class="fas fa-ticket-alt"></i>
                                            <span class="d-none d-md-inline">Reserveren</span>
                                        </a>
                                    </li>
                                    @role('administrator')
                                        <li class="nav-item {{ request()->is('tables/exclude') ? 'active' : '' }}">
                                            <a class="nav-link pl-0" href="{{ url('tables/exclude') }}"><i class="fas fa-ban"></i>
                                                <span class="d-none d-md-inline">Tafels uitsluiten</span>
                                            </a>
                                        </li>
                                    @endrole
                                    <li class="nav-item">
                                        <a class="nav-link pl-0" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();"><i class="fas fa-power-off"></i>
                                            <span class="d-none d-md-inline">Uitloggen</span>
                                        </a>
                                    </li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                @endauth
                            </ul>
                        </div>
                    </nav>
                </aside>
                <main class="col offset-md-2 py-2">
                    @yield('content')
                </main>
            </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.nl.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.6.0/bootstrap-slider.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <script src="{{ url('js/switchery.js') }}"></script>
        <script src="{{ url('js/custom.js') }}"></script>
        @yield('scripts')
        @include('layouts.components.notify')
    </body>
</html>
