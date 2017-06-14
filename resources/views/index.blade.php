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
                <div id="<?php print($number);?>" class="panel panel-default">
                    <div class="panel-heading"> <a href="/event/{{$event["@attributes"]["id"]}}">{{$event["title"]}}</a></div>

                        <div class="imgEvent"><img padding="0.5%" width="100%" height="100%" src="http://images.digopaul.com/wp-content/uploads/related_images/2015/09/08/placeholder_3.jpg" alt="{{$event["title"]}}" /></div>

                    <div class="panel-body more ">

                        <?php
                        if (is_string($event["description"])){
                            echo strip_tags($event["description"]);
                        }else{
                            echo "No se qué.";
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

<script>
    window.onload = function colorPanels()
    {
        /* BACKGROUND COLOR RANDOM CHANGE */
        var colorClasses = ["color1", "color2", "color3", "color4", "color5", "color6", "color7", "color8", "color9"];
        //var testNumbers = [3, 1, 5, 0, 4, 2];
        var numbers = [0, 1, 2, 3, 4, 5];
        //var number = randomNumbers(numbers);
        var events = document.getElementsByClassName("panel");
        //var nEvents = events.length;
        //var numbers = getNumbers(nEvents);
        var number = randomNumbers(numbers);
        var index;
        var currentEvent;
        for (index = 0; index < events.length; index++)
        {
            currentEvent = events[index];
            currentEvent.className = "panel panel-default "+colorClasses[number[index]];
        }
    }
/* END BACKGROUND COLOR RANDOM CHANGE */


/* RANDOM SORT NUMBERS */
    function randomNumbers(numbers)
    {
        for(var j, x, i = numbers.length; i; j = parseInt(Math.random() * i), x = numbers[--i], numbers[i] = numbers[j], numbers[j] = x);
        return numbers;
    }
/* END RANDOM SORT NUMBERS*/

/* LOAD NUMBERS TO ARRAY */
    /*
    function getNumbers(NumberOfEvents)
    {
        var arrayNumbers = [];
        for(var x = 0; x<NumberOfEvents; x++)
        {
            arrayNumbers[x]=x;
        }
    }
    */
/* END LOAD NUMBERS TO ARRAY */
</script>

@endsection