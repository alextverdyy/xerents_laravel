@extends('layouts.app')

@section('content')

        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading"> <a href="/event/{{$event["@attributes"]["id"]}}">{{$event["title"]}}</a>
                            @foreach($event["categories"]["category"] as $category)
                                <span class="label label-info">{{$category["name"]}}</span>
                            @endforeach
                        </div>

                            <div class="panel-body">
                                <strong>Hora de inicio:</strong> {{$event["start_time"]}}<br>
                                <strong>Lugar del evento:</strong> {{$event["venue_name"]}}<br>
                                <strong>Ciudad:</strong> {{$event["city"]}},{{$event["country"]}}<br>
                                <strong>Mapa:</strong><br>
                                <img src="https://maps.googleapis.com/maps/api/staticmap?center={{$event["latitude"]}},{{$event["longitude"]}}&zoom=12&size=400x400&markers=color:blue%icon:%7Clabel:S%7C{{$event["latitude"]}},{{$event["longitude"]}}&key=AIzaSyA8pwDDJb4qzanENfLX9Xx5S0dn6YP8ino" alt="mapa"><br>
                            </div>

                            <div class="panel-body">
                                OTROS DETALLES<br>
                                <br>
                                <strong>{{$event["title"]}}</strong><br>
                                <strong>Descripcion:</strong> {{$event["description"]}}<br>
                                <strong>Enlace:</strong> <a href="{{$event["url"]}}">Para mas informacion</a><br>
                            </div>
                    </div>
                </div>
            </div>
        </div>

@endsection