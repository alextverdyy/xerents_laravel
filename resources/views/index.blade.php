@extends('layouts.app')

@section('content')
    @foreach($events as $event)
        <?php
            $type = gettype($event["description"]);
            if ($type == "string") {
        ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"> <a href="/event/{{$event["@attributes"]["id"]}}">{{$event["title"]}}</a></div>

                    <div class="panel-body">
                        {{$event["description"]}}
                    </div>
                </div>
            </div>
        </div>
    </div>
        <?php
        }
        ?>
    @endforeach
@endsection