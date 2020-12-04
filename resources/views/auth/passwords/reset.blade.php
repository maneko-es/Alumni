@extends('front.layout-signin')
@section('body_class','login-page')

@section('content')
<main class="login-main section-paddings">
    <div class="width-banner-text main-section">
        <h3 class="yellow">#ALUMNICCIC</h3>
        <h1 class="blue">Restableix la contrasenya</h1>
    </div>

    <div id="signin-form">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>{{ trans('messages.reset_password') }}</h3>
            </div>
            <div class="panel-body">
                <form method="POST" action="{{ route('password.update') }}" class="form-horizontal">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group">
                        <label for="email" class="control-label">{{ trans('messages.email') }}</label>

                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password" class="">{{ trans('messages.password') }}</label>

                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="">{{ trans('messages.password_confirmation') }}</label>

                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="button button-blue" style="font-size: 17px;line-height: 15px;width: 100%;">
                            {{ trans('messages.reset_password') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
