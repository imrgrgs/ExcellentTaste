<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Excellent Taste</title>

        @include('layouts.components.imports')
        <link href="{{ asset('css/mainwelcome.css') }}" rel="stylesheet">
    </head>
    <body class="bg-dark">
        <header>
            <nav class="navbar navbar-expand-md fixed-top">
                <a class="navbar-brand" href="{{ url('') }}">Excellent Taste</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ url('') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('menu') }}">Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/contact">Contact</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">

                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">Inloggen</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">Registreren</a></li>
                        @else
                            <li><a class="nav-link" href="{{ url('profile') }}">Portaal</a></li>
                            <li><a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">Logout</a></li>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endguest
                    </ul>
                </div>
            </nav>
        </header>
        @include('layouts.components.scripts')
        @yield('content')
        @include('layouts.components.notify')
        <script src="{{ asset('js/main.js') }}" defer></script>
    </body>
</html>
