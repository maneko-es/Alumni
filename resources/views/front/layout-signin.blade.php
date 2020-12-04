<!DOCTYPE html>
<html>

  <head>
    <link rel="stylesheet" type="text/css" href="{{ url('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/css-fix.css') }}">
    <script src="https://kit.fontawesome.com/a5354dd95c.js" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>

    <title>@yield('title') - CIC Alumni</title>
  </head>

  <body class="@yield('body_class')">
    @include('front.partials.header')
    @yield('content')
    @include('front.partials.footer')


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="slick/slick.min.js"></script>
    <script src="{{ url('js/app.js') }}" defer></script>
    @yield('scripts')

  </body>
</html>
