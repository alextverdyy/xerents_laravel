@extends('layouts.app')

@section('content')
<div class="container containerLogin">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Búsqueda sin exito</div>
                <div class="panel-body">
                    <div class="notfoundPanel">
                        <h2 class="warningTitle">La búsqueda no encontró resultados.</h2>
                        <br><br>
                        <a href="/"><h4 class="notfoundReturn"><< Volver atrás</h4></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
