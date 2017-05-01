@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
    @foreach($events as $event)
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading"> <a href="/event/{{$event["@attributes"]["id"]}}">{{$event["title"]}}</a></div>

                    <div class="panel-body more ">

                        <?php
                        if (is_string($event["description"])){
                            echo $event["description"];
                        }else{
                            echo "NO CONTIENE DESCRIPCION";
                        }
                        ?>

                    </div>
                </div>
            </div>
            @endforeach
    </div>
    </div>



@endsection