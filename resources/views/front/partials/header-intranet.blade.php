<div class="top-bar school-background"></div>
<?php
$route = Route::currentRouteName();
?>
<header class="container">
    <div id="header-intranet">
        <div class="desktop-nav-intranet">
            <div class="logo"><a href="{{ route('dashboard') }}"><img src="{{ getMedia($school) }}"></a></div>

            <div class="menu-options menu-intranet">
                <div class="menu-option @if($route == 'gallery') active @endif">
                    <a href="{{ route('gallery') }}">Galeria</a>
                </div>
                <div class="menu-option @if($route == 'promotion') active @endif">
                    <a href="{{ route('promotion') }}">Promoció</a>
                </div>
                <div class="menu-option @if($route == 'perks') active @endif">
                    <a href="{{ route('perks') }}">Avantatges</a>
                </div>
                <div class="menu-option">
                    <a href="{{ $config->borsa_url }}">Borsa treball</a>
                    <div class="menu-option-bar-intranet "></div>
                </div>

                <div class="personal-menu">
                    <h2>HOLA</h2>
                    <?php $notifications = $user->notifications()->where('promotion_id',$promotion->id)->wherePivot('seen',0); ?>
                    @if($notifications->count() > 0)
                    <div class="notifications school-background">
                        <div class="number">{{ $notifications->count() }}</div>
                        <style type="text/css">.notification-messages:after{border-color: {{ $school->color }};}</style>
                        <div class="notification-messages" style="border-color: {{ $school->color }};  color: {{ $school->color }};">
                            @foreach($notifications->get() as $notification)
                                @switch($notification->type)
                                    @case('gallery')
                                    @if($notification->gallery != null)
                                    <a href="{{ route('gallery-single',['slug'=>$notification->gallery->slug]) }}" class="school-color">
                                        <div class="message">
                                            <div class="title">Nou Àlbum </div>
                                            <div class="body"> S'ha afegit a la teva galeria alumni l'àlbum "{{ $notification->gallery->title }}" </div>
                                        </div>
                                    </a>
                                    @endif
                                    @break

                                    @case('mate')
                                    <a href="{{ route('promotion') }}" class="school-color">
                                        <div class="message">
                                            <div class="title">Nou Alumni </div>
                                            <div class="body"> S'ha afegit a la teva promoció alumni a {{ $notification->user->name }} </div>
                                        </div>
                                    </a>
                                    @break
                                    @case('tag')
                                    @if($notification->picture != null)
                                    <a href="{{ route('picture-single',['slug'=>$notification->picture->gallery->slug,'id'=>$notification->picture_id]) }}" class="school-color">
                                        <div class="message">
                                            <div class="title">Nova Etiqueta</div>
                                            <div class="body">T'han etiquetat a una fotografia</div>
                                        </div>
                                    </a>
                                    @endif
                                    @break
                                @endswitch
                            @endforeach
                        </div>
                    </div>

                    <form id="markAsRead" action="{{ route('mark-as-read') }}" method="post">{{ csrf_field() }}<input type="hidden" name="promotion_id" value="{{ $promotion->id }}"></form>
                    @endif

                    <div class="my-profile">
                        <div class="my-avatar">
                            <div class="user-thumbnail user-miniature" @if($user->img) style="background-image: url('{{ url('profile/thumbnail/'.$user->img) }}')" @endif></div>
                        </div>

                        <div class="menu-dropdown">
                            <i class="fas fa-chevron-down"></i>
                            <select name="" id="" onchange="location = this.value;">
                                <option class="header-name" value="" disabled selected>{{ $user->name }}</option>
                                <option value="{{ route('profile') }}">Editar perfil</option>
                                <option value="{{ url('logout') }}">Sortir</option>
                            </select>

                            @foreach($promotions as $promo)
                            <form action="{{ route('change-promotion') }}" method="post">
                                {{ csrf_field() }}
                                <div class="header-school">
                                    <input type="hidden" value="{{ $promo->id }}" name="promotion_id">
                                    <input type="submit" value="{{ $promo->school()->first()->title }} - {{ $promo->title }}">
                                </div>
                            </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="mobile-nav-intranet">
        <div class="menu-icon"><i class="fas fa-bars"></i></div>

        <div class="right">
            @if($notifications->count() > 0)
            <div class="notifications school-background">
                <div class="number">{{ $notifications->count() }}</div>

                <div class="notification-messages" style="border-color: {{ $school->color }};  color: {{ $school->color }};">
                    @foreach($notifications->get() as $notification)
                        @switch($notification->type)
                            @case('gallery')
                            <a href="{{ route('gallery-single',['slug'=>$notification->gallery->slug]) }}" class="school-color">
                                <div class="message">
                                    <div class="title">Nou Àlbum </div>
                                    <div class="body"> S'ha afegit a la teva galeria alumni l'àlbum "{{ $notification->gallery->title }}" </div>
                                </div>
                            </a>
                            @break

                            @case('mate')
                            <a href="{{ route('promotion') }}" class="school-color">
                                <div class="message">
                                    <div class="title">Nou Alumni </div>
                                    <div class="body"> S'ha afegit a la teva promoció alumni a {{ $notification->user->name }} </div>
                                </div>
                            </a>
                            @break
                            @case('tag')
                            <a href="{{ route('picture-single',['slug'=>$notification->picture->gallery->slug,'id'=>$notification->picture_id]) }}" class="school-color">
                                <div class="message">
                                    <div class="title">Nova Etiqueta</div>
                                    <div class="body">T'han etiquetat a una fotografia</div>
                                </div>
                            </a>
                            @break
                        @endswitch
                    @endforeach
                </div>
            </div>
            @endif

            <div class="my-avatar">
                <div class="user-thumbnail user-miniature" @if($user->img) style="background-image: url('{{ url('profile/thumbnail/'.$user->img) }}')" @endif></div>
            </div>

            <div class="menu-dropdown">
                <i class="fas fa-chevron-down"></i>
                <select name="" id="" onchange="location = this.value;">
                    <option class="header-name" value="" disabled selected>{{ $user->name }}</option>
                    <option value="{{ url('/profile') }}">Editar perfil</option>
                    <option value="">Sortir</option>
                </select>
                @foreach($promotions as $promo)
                <form action="{{ route('change-promotion') }}" method="post">
                    {{ csrf_field() }}
                    <div class="header-school">
                        <input type="hidden" value="{{ $promo->id }}" name="promotion_id">
                        <input type="submit" value="{{ $promo->school()->first()->title }} - {{ $promo->title }}">
                    </div>
                </form>
                @endforeach
            </div>
        </div>
    </div>

    <div id="mobile-menu">
        <div class="menu-option">
            <a @if($route == 'gallery') class="mobile-active" @endif href="{{ route('gallery') }}">Galeria</a>
            <div class="menu-option-bar-intranet "></div>
        </div>
        <div class="menu-option">
            <a href="{{ route('promotion') }}">Promoció</a>
            <div class="menu-option-bar-intranet @if($route == 'promotion') mobile-active @endif"></div>
        </div>
        <div class="menu-option">
            <a href="{{ route('perks') }}">Avantatges</a>
            <div class="menu-option-bar-intranet @if($route == 'perks') mobile-active @endif"></div>
        </div>
        <div class="menu-option">
            <a href="{{ $config->borsa_url }}">Borsa treball</a>
            <div class="menu-option-bar-intranet @if($route == '') mobile-active @endif"></div>
        </div>
        <a href="{{ url('logout') }}"><button class="login-btn">LOG OUT</button></a>
    </div>
</header>
