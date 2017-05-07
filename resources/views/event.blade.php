@extends('layouts.app')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@section('content')

        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading"> <a href="/event/{{$event["@attributes"]["id"]}}">{{$event["title"]}}</a>
                            @if(in_array("categories",$event))
                            @foreach($event["categories"]["category"] as $category)
                                    <span class="label label-info">{{$category["name"]}}</span>
                            @endforeach
                            @else
                                <span class="label label-info">No tiene categorias</span>
                            @endif

                        </div>
                        <!-- TODO: Add ajax interaction -->
                        <a href="/event/favorite/{{$event["@attributes"]["id"]}}" class="btn btn-default" onmouseover="$(this).css('color','yellow')" onmouseout="$(this).css('color','black')"><span class="glyphicon glyphicon-star"></span> Añadir a favoritos</a>
                            <div class="panel-body">
                                <strong>Hora de inicio:</strong> {{$event["start_time"]}}<br>
                                <strong>Lugar del evento:</strong> {{$event["venue_name"]}}<br>
                                <strong>Ciudad:</strong> {{$event["city"]}},{{$event["country"]}}<br>
                                <strong>Mapa:</strong><br>
                                <img width="400px" src="https://maps.googleapis.com/maps/api/staticmap?center={{$event["latitude"]}},{{$event["longitude"]}}&zoom=12&size=400x400&zoom=22&markers=color:blue%icon:%7Clabel:%7C{{$event["latitude"]}},{{$event["longitude"]}}&key=AIzaSyA8pwDDJb4qzanENfLX9Xx5S0dn6YP8ino" alt="mapa"><br>
                            </div>
                        <div class="panel-body">
                                OTROS DETALLES<br>
                                <br>
                                <strong>{{$event["title"]}}</strong><br>
                                <?php
                                if (is_string($event["description"])){
                                    echo "<strong>Descripcion:</strong> <p class='more'>{{$event["description"]}}</p>";
                                }else{
                                    echo "<strong>Descripcion:</strong> No tiene descripcion";
                                }
                                ?>
                                <br>
                                <strong>Enlace:</strong> <a href="{{$event["url"]}}">Para mas informacion</a><br>
                            </div>
                    </div>
                </div>
            </div>
        </div>

@endsection

