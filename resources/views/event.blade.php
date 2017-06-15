@include('alert::bootstrap')
@extends('layouts.app')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@section('content')

        <div class="container">
            <div class="alert"></div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading"> <a href="/event/{{$event["@attributes"]["id"]}}">{{$event["title"]}}</a>
                            @if(in_array("categories",$event))
                            @foreach($event["categories"]["category"] as $category)
                                    <span class="label label-info">{{$category["name"]}}</span>
                            @endforeach
                            @else
                                <span style="float:right;" class="label label-info">No tiene categorias</span>
                            @endif

                        </div>
                        <a class="btnFavorite favorite" onmouseover="$(this).css('color','yellow')" onmouseout="$(this).css('color','black')"><span class="glyphicon glyphicon-star"></span> Añadir a favoritos</a>

                        <div class="panel-body">
                                <div class="panelEventDetailLeft"><br><br><br><br>
                                <strong class="labelEventDescription">Hora de inicio:</strong><br> {{$event["start_time"]}}<br>
                                <strong class="labelEventDescription">Lugar del evento:</strong><br> {{$event["venue_name"]}}<br>
                                <strong class="labelEventDescription">Ciudad:</strong><br> {{$event["city"]}},{{$event["country"]}}<br><br><hr />
                            </div>
                        <div class="panelEventDetailRight">
                            <br><strong class="labelEventDescription">Mapa:</strong><br>
                            <div class="map"><img width="400px" src="https://maps.googleapis.com/maps/api/staticmap?center={{$event["latitude"]}},{{$event["longitude"]}}&zoom=12&size=400x400&zoom=22&markers=color:blue%icon:%7Clabel:%7C{{$event["latitude"]}},{{$event["longitude"]}}&key=AIzaSyA8pwDDJb4qzanENfLX9Xx5S0dn6YP8ino" alt="mapa"></div><br>
                         </div>


                    </div>
                        <br><br>
                        <div class="panelEventDetailBottom">
                            <br>
                            <strong class="labelEventDescription">OTROS DETALLES</strong><br>
                            <strong>{{$event["title"]}}</strong><br><br>
                            <?php
                            if (is_string($event["description"])){
                                echo "<strong class='labelEventDescription'>Descripcion:</strong><br><p class='more'>{{$event["description"]}}</p><br>";
                            }else{
                                echo "<strong class='labelEventDescription'>Descripcion:</strong><br> No tiene descripcion <br>";
                            }
                            ?>
                            <br>
                            <strong>Enlace:</strong> <a href="{{$event["url"]}}">Pinche aquí para más información</a>
                            <p>&nbsp;</p>
                        </div>
                        <a style="margin:1%;" href="http://127.0.0.1:8000"><< Volver atrás</a>
                    </div>
                </div>
            </div>
        </div>
                <script>
                        $(document).ready(function() {
                                $.get("/event/user/favorite/{{$event["@attributes"]["id"]}}", function (data, status) {
                                        if (data == "conectado"){
                                                $(".favorite").css('color','grey');
                                            }else if(data == "true") {
                                                $(".favorite").css('color','yellow');
                                            }
                                    });
                                $(".favorite").click(function () {

                                            $.get("/event/favorite/{{$event["@attributes"]["id"]}}", function (data, status) {
                                                    if (data == "conectado"){
                                                            $('.alert').append('<div class="alert alert-warning"> El usuario no se encuentra conectado </div>');
                                                        }else if(data == "correcto") {
                                                            $('.alert').append('<div class="alert alert-success">¡Oferta agregada correctamente!</div>');
                                                        }else{
                                                            $('.alert').append('<div class="alert alert-warning">La oferta no se ha podido agregar a favoritos</div>');
                                                        }
                                               });
                                    });
                            });
                    </script>
@endsection

