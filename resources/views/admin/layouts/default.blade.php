<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('maravel.title') }}</title>

    <!-- Styles -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="{{ url(elixir('css/admin.css')) }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ url('slick/slick.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ url('slick/slick-theme.css')}}"/>
    <script type="text/javascript" src="{{ url('js/jquery.min.js') }}" defer></script>
{{--     <script type="text/javascript" src="{{ url('js/bootstrap/bootstrap.min.js') }}"></script> --}}
    <script type="text/javascript" src="{{ url('slick/slick.min.js')}}" defer></script>
    <script type="text/javascript" src="{{ url('js/js-fix.js')}}" defer></script>
    @yield('styles')

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        .school_tag {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            margin-right: 7px;
            color: white;
        }
        @foreach(App\School::all() as $sch)
        .school_{{ $sch->id }} { background-color: {{ $sch->color }}; }
        @endforeach
        .school_gen { color: #5e5d5d; border: 1px solid gray; }
    </style>
</head>
<body>
    @include('admin.partials.navbar')

    @yield('content')

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'baseUrl' => url(''),
        ]); ?>
    </script>
    <script src="{{ url('vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ url(elixir('js/admin.js')) }}"></script>
    <script src="{{ url('js/js-fix.js')}}"></script>
    @stack('scripts')
</body>
</html>
