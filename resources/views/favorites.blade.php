@extends('layouts.app')

@section('content')

    <div class="container">
        <?php $number = 1;  ?>
        @foreach($events as $event)
            <?php
            if ($number % 3 == 0) {
            ?><div class="row"><?php
                }
                ?>

                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> <a href="/event/{{$event["@attributes"]["id"]}}">{{$event["title"]}}</a></div>

                        <div class="panel-body more ">

                            <?php
                            if (is_string($event["description"])){
                                echo strip_tags($event["description"]);
                            }else{
                                echo "NO CONTIENE DESCRIPCION";
                            }
                            ?>

                        </div>
                    </div>
                </div>
                <?php
                if ($number % 3 == 0) {
                ?></div><?php
            }
            ?>
            <?php $number++ ?>
        @endforeach

    </div>



@endsection