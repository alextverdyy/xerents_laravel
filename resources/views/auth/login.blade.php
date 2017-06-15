@extends('layouts.app')

@section('content')
    <br><br>
<div class="container containerLogin">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Conectarse</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} group">
                            <!--<label for="email" class="col-md-4 control-label">Correo Electronico</label>-->

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control input" name="email" value="{{ old('email') }}" required autofocus>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label class="label">Correo Electronico</label>
                                <!--<input id="email" type="email" class="form-control input" name="email" value="{{ old('email') }}" required autofocus>-->
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

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordarme
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-default">
                                    Conectarse
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Recuperar Contraseña
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br>
</div>
@endsection
