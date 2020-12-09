<!DOCTYPE html>
<html>

  <head>
    <link rel="stylesheet" type="text/css" href="{{ url('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/css-fix.css') }}">
    <script src="https://kit.fontawesome.com/a5354dd95c.js" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - CIC Alumni</title>
  </head>

  <body class="@yield('body_class')">
    @include('front.partials.header')
    @yield('content')
    @include('front.partials.footer')


    <script type="text/javascript" src="{{ url('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/bootstrap/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="slick/slick.min.js"></script>
    <script type="text/javascript" src='js/app.js' defer></script>
    <script type="text/javascript" src="js/custom.js" defer></script>

    <!-- Cookie Consent by https://www.FreePrivacyPolicy.com -->
    <script type="text/javascript" src="//www.freeprivacypolicy.com/public/cookie-consent/3.1.0/cookie-consent.js"></script>
    <script type="text/javascript">
      document.addEventListener('DOMContentLoaded', function () {
      cookieconsent.run({"notice_banner_type":"interstitial","consent_type":"express","palette":"light","language":"ca_es","website_name":"CIC Alumni","cookies_policy_url":"https://alumni.iccic.edu/cookies"});
      });

    </script>
<!--
    <noscript>Cookie Consent by <a href="https://www.FreePrivacyPolicy.com/free-cookie-consent/" rel="nofollow noopener">FreePrivacyPolicy.com</a></noscript> -->
    <!-- End Cookie Consent -->

    @yield('scripts')


  </body>
</html>
