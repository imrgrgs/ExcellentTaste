<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Excellent Taste</title>

        @include('layouts.components.imports')
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    </head>
    <body id="app" class="bg-light text-black-50">
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
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link pl-0" href="{{ url('/') }}"><i class="fas fa-home"></i>
                                            <span class="d-none d-md-inline">Site</span>
                                        </a>
                                    </li>
                                    @endrole
                                    <li class="nav-item {{ request()->is('profile') ? 'active' : '' }}">
                                        <a class="nav-link pl-0" href="{{ url('/profile') }}"><i class="fas fa-address-card"></i>
                                            <span class="d-none d-md-inline">Profiel</span>
                                        </a>
                                    </li>
                                    @auth
                                        <li class="nav-item {{ request()->is('reservations/create') ? 'active' : '' }}">
                                            <a class="nav-link pl-0" href="{{ url('reservations/create') }}"><i class="fas fa-calendar"></i>
                                                <span class="d-none d-md-inline">Reserveren</span>
                                            </a>
                                        </li>
                                        @role('employee|administrator')
                                        <li class="nav-item {{ request()->is('orders/create') ? 'active' : '' }}">
                                            <a class="nav-link pl-0" href="{{ url('orders/create') }}"><i class="fas fa-ticket-alt"></i>
                                                <span class="d-none d-md-inline">Bestellingen</span>
                                            </a>
                                        </li>
                                        <li class="nav-item disabled border-secondary border-bottom mt-4">
                                            <span class="nav-link pl-0 d-none d-md-inline">Beheer</span>
                                        </li>
                                        <li class="nav-item {{ request()->is('reservations') ? 'active' : '' }}">
                                            <a class="nav-link pl-0" href="{{ url('reservations/') }}"><i class="fas fa-archive"></i>
                                                <span class="d-none d-md-inline">Reserveringen</span>
                                            </a>
                                        </li>
                                        @endrole
                                        @role('administrator')
                                        <li class="nav-item {{ request()->is('users*') ? 'active' : '' }}">
                                            <a class="nav-link pl-0" href="{{ url('users/') }}"><i class="fas fa-users"></i>
                                                <span class="d-none d-md-inline">Gebruikers</span>
                                            </a>
                                        </li>
                                        <li class="nav-item {{ request()->is('products*') ? 'active' : '' }}">
                                            <a class="nav-link pl-0" href="{{ url('products/') }}"><i class="fas fa-barcode"></i>
                                                <span class="d-none d-md-inline">Producten</span>
                                            </a>
                                        </li>
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
        </div>
        @include('layouts.components.scripts')

        @include('layouts.components.notify')

        @yield('scripts')
    </body>
</html>
