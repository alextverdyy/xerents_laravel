@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="col-md-12">
            <div class="col-md-12 imgHeader">
            </div>
        </div>

    <?php $number = 1;  ?>
    @foreach($events as $event)
            <?php
                if ($number % 3 == 0) {
                   ?><div class="row"><?php
                }
            ?>

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading"> <a href="/event/{{$event["@attributes"]["id"]}}">{{$event["title"]}}</a></div>

                        <div class="imgEvent"><img padding="0.5%" width="100%" height="100%" src="http://images.digopaul.com/wp-content/uploads/related_images/2015/09/08/placeholder_3.jpg" alt="{{$event["title"]}}" /></div>

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
                    <?php
                    if ($number % 3 == 0) {
                    ?></div><?php
                        }
                        ?>
            <?php $number++ ?>
            @endforeach

    </div>



@endsection