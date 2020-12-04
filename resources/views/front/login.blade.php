@extends('front.layout-signin')
@section('body_class','login-page')
@section('title', 'Entrar')

@section('content')

<main class="login-main section-paddings">
  <div class="container">

    <div class="width-banner-text main-section">
        <h3 class="yellow">#ALUMNICCIC</h3>
        <h1 class="blue">Accedeix a Alumni</h1>
    </div>

    <div id="signin-form">
        {!! Form::open([
            'url' => '/login',
            'method' => 'post',
            'role' => 'form',
            'class' => 'form'
        ]) !!}
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'email','placeholder' => 'Usuari']) !!}
                @if ($errors->has('email'))
                    <span class="help-block">
                        {{ $errors->first('email') }}
                    </span>
                @endif
            </div>
            <div class="form-group">
                {!! Form::password('password', ['class' => 'form-control', 'id' => 'password','placeholder' => 'Contrasenya']) !!}
            </div>
            <div class="form-group">
                <a id="forgot_password" href="{{ url('/password/reset') }}">Has oblidat la contrasenya?</a>
            </div>
            <div class="form-group">
                <input type="submit" class="yellow" value="ENVIAR">
            </div>

        {!! Form::close() !!}
    </div>
  </div>
</main>
@endsection

