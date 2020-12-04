
<header>
  <?php
    $curPageName = $_SERVER["REQUEST_URI"];
  ?>

  <div id="desktop-nav">
    <div class="logo"><a href="{{ url('/') }}"><img src="/images/logo.png"></a></div>
    <div class="menu-options">
      <div class="menu-option"><a href="{{ route('alumni') }}">Alumni</a><div class="menu-option-bar <?php if($curPageName == '/alumni'){ echo "active"; } ?>"></div></div>
      <div class="menu-option"><a href="{{ route('activitats') }}">Activitats</a><div class="menu-option-bar <?php if($curPageName == '/activitats'){ echo "active"; } ?>"></div></div>
      <div class="menu-option"><a href="{{ route('avantatges') }}">Avantatges</a><div class="menu-option-bar <?php if($curPageName == '/avantatges'){ echo "active"; } ?>"></div></div>
      <div class="menu-option"><a href="{{ route('contacte') }}">Contacte</a><div class="menu-option-bar <?php if($curPageName == '/contacte'){ echo "active"; } ?>"></div></div>
      <button class="login-btn">LOGIN</button>
    </div>
  </div>

  <div id="mobile-nav">
    <div class="logo"><a href="{{ url('/') }}"><img src="{{ url('images/logo.png') }}"></a></div>
    <div class="menu-icon"><i class="fas fa-bars"></i></div>
  </div>
  <div id="mobile-menu">
    <div class="menu-option <?php if($curPageName == '/alumni'){ echo "mobile-active"; } ?>"><a href="{{ url('/alumni') }}">Alumni</a></div>
    <div class="menu-option <?php if($curPageName == '/activitats'){ echo "mobile-active"; } ?>"><a href="{{ url('/activitats') }}">Activitats</a></div>
    <div class="menu-option <?php if($curPageName == '/avantatges'){ echo "mobile-active"; } ?>"><a href="{{ url('/avantatges') }}">Avantatges</a></div>
    <div class="menu-option <?php if($curPageName == '/contacte'){ echo "mobile-active"; } ?>"><a href="{{ url('/contacte') }}">Contacte</a></div>
    <button class="login-btn">LOGIN</button>
  </div>
  <div class="under-bar"></div>
</header>
