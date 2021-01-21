@extends('front.layout-signin')
@section('body_class','login-page')

@section('content')
<main class="login-main section-paddings">
    <div class="container">        
        <div class="width-banner-text main-section">
            <h3 class="yellow">#ALUMNICCIC</h3>
            <h1 class="blue">Restableix la contrasenya</h1>
        </div>

        <div id="signin-form">

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group">

                    <input id="email" placeholder="Email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <input type="submit" class="yellow" value="ENVIAR">
            </form>
        </div>
    </div>
</main>
@endsection
