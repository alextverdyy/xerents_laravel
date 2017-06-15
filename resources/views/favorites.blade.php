@extends('layouts.app')

@section('content')

    <div class="container">
        <h2 class="titleDashboard">Tus Eventos Favoritos:</h2>
        <br /><br />
        <?php $number = 1;  ?>
        @foreach($events as $event)
            <?php
            if ($number % 3 == 0) {
            ?><div class="row" style="margin-bottom:5%;"><?php
                }
                ?>
                <div class="col-md-12" >
                    <div class="panel panel-default">
                        <div class="panel-heading"> <a href="/event/{{$event["@attributes"]["id"]}}" id="favorite">{{$event["title"]}}</a></div>

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
        <h2 class="titleDashboard">&nbsp;</h2>


    </div>



@endsection