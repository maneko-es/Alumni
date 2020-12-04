
<header>
  <?php
  $route = Route::currentRouteName();
  ?>

  <div id="desktop-nav">
    <div class="logo"><a href="{{ url('/') }}"><img src="{{ url('/images/logo.png') }}"></a></div>
    <div class="menu-options">
      <div class="menu-option"><a href="{{ route('alumni') }}">Alumni</a><div class="menu-option-bar @if($route == 'alumni') active @endif"></div></div>
      <div class="menu-option"><a href="{{ route('activitats') }}">Activitats</a><div class="menu-option-bar @if($route == 'activitats') active @endif"></div></div>
      <div class="menu-option"><a href="{{ route('avantatges') }}">Avantatges</a><div class="menu-option-bar @if($route == 'avantatges') active @endif"></div></div>
      <div class="menu-option"><a href="{{ route('contacte') }}">Contacte</a><div class="menu-option-bar @if($route == 'contacte') active @endif"></div></div>
      @if(!Auth::user())
        <a href="{{ url('login') }}"><button class="login-btn">LOGIN</button></a>
      @else
        <a href="{{ url('intranet') }}"><button class="login-btn">INTRANET</button></a>
      @endif
    </div>
  </div>

  <div id="mobile-nav">
    <div class="logo"><a href="{{ url('/') }}"><img src="{{ url('images/logo.png') }}"></a></div>
    <div class="menu-icon"><i class="fas fa-bars"></i></div>
  </div>
  <div id="mobile-menu">
    <div class="menu-option @if($route == 'alumni') mobile-active @endif"><a href="{{ url('/alumni') }}">Alumni</a></div>
    <div class="menu-option @if($route == 'activitats') mobile-active @endif"><a href="{{ url('/activitats') }}">Activitats</a></div>
    <div class="menu-option @if($route == 'avantatges') mobile-active @endif"><a href="{{ url('/avantatges') }}">Avantatges</a></div>
    <div class="menu-option @if($route == 'contacte') mobile-active @endif"><a href="{{ url('/contacte') }}">Contacte</a></div>
    <a href="{{ url('login') }}"><button class="login-btn">LOGIN</button></a>
  </div>
  <div class="under-bar"></div>
</header>
