<!DOCTYPE html>
<html>

  <head>
    
    <script src="https://kit.fontawesome.com/a5354dd95c.js" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

    <link rel="stylesheet" type="text/css" href="{{ url('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/css-fix.css') }}">

    <style type="text/css">
        .school-color { color: {{ $school->color }} !important; }
        .school-background { background-color: {{ $school->color }} !important; }
    </style>

    <title>@yield('title') - CIC Alumni</title>
  </head>

  <body class="@yield('body_class')">
    @include('front.partials.header-intranet')
    @yield('content')
    @include('front.partials.footer')


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="{{ url('js/index.js') }}" defer></script>
    @yield('scripts')

  </body>
</html>



