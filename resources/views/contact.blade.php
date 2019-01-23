@extends('layouts.layout')

@section('content')
    <style>
        #map {
            width: 100%;
            height: 192px;
            background-color: grey;
        }
    </style>

    <div class="carousel-inner">
        <div class="carousel-item active" style="opacity: 0.3;">
            <img src="https://images.unsplash.com/photo-1499028344343-cd173ffc68a9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1500&q=80" alt="hamburger">
        </div>
    </div>
    <div class="container">
        <div class="row" style="margin-top: -663px;">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <i class="fas fa-clock fa-2x ml-md-4"></i><h5 class="card-title ml-2">Openingstijden</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Maandag: 10:00 - 23:00</li>
                            <li class="list-group-item">Dinsdag: 10:00 - 23:00</li>
                            <li class="list-group-item">Woensdag: 10:00 - 23:00</li>
                            <li class="list-group-item">Donderdag: 10:00 - 23:00</li>
                            <li class="list-group-item">Vrijdag: 10:00 - 23:00</li>
                            <li class="list-group-item">Zaterdag: 10:00 - 23:00</li>
                            <li class="list-group-item">Zondag: 10:00 - 23:00</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <i class="fas fa-map-marked-alt fa-2x ml-md-4"></i><h5 class="card-title ml-2">Bezoekadres</h5>
                        </div>
                        <hr>
                        <p class="card-text">
                            Grote Markt 12 <br/>
                            8011 LW Zwolle <br/>
                        <hr>
                        0591-272012 <br/>
                        info@excellenttaste.nl
                        </p>
                        <a href="mailto:info@excellenttaste.com" class="btn btn-dark">Mail ons</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="map" style="margin-top: 50px;"></div>
    <script>
        function initMap() {
            var uluru = {lat: 52.513685, lng: 6.0923079};
            var map = new google.maps.Map(document.getElementById('map'), {zoom: 13, center: uluru});
            var marker = new google.maps.Marker({position: uluru, map: map});
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDj8Bfw8XPv_lVX6I1kzelUSU2rL9WVejY&callback=initMap"
            async defer></script>
@stop
