@extends('layouts.app')

@section('content')
<div class="container containerLogin" style="padding-top:5.3%;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registrarse</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} group">
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control input" name="name" value="{{ old('name') }}" required autofocus>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label class="label">Nombre</label>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} group">
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control input" name="email" value="{{ old('email') }}" required>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label class="label">Correo Electronico</label>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} group">

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control input" name="password" required>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label class="label">Contraseña</label>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group group">

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control input" name="password_confirmation" required>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label class="label">Confirmar contraseña</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-5">
                                <button type="submit" class="btn btn-default">
                                    Registrarse
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
