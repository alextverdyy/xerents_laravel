@extends('layouts.app')

@section('content')

        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading"> <a href="/event/{{$event["@attributes"]["id"]}}">{{$event["title"]}}</a></div>

                            <div class="panel-body">
                                Hora de inicio: {{$event["start_time"]}}<br>
                                Lugar del evento: {{$event["venue_name"]}}<br>
                                Ciudad: {{$event["city"]}},{{$event["country"]}}<br>
                            </div>

                            <div class="panel-body">
                                OTROS DETALLES<br>
                                <br>
                                Descripcion: {{$event["description"]}}<br>
                                <a href="{{$event["url"]}}">Para mas informacion</a><br>
                            </div>
                    </div>
                </div>
            </div>
        </div>

@endsection