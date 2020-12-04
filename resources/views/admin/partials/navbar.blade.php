@if (!Auth::guest())
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('admin') }}">
                    {{ config('maravel.title') }}
                </a>
            </div>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <ul class="nav navbar-nav">
                    
                    <li>
                        <a href="{{ url('admin/page') }}" class="{{ setActiveNavbarLink('admin/page*') }}"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;Pàgines</a>
                    </li>

                    <li class="dropdown">
                        <a class="dropdown-toggle {{ setActiveNavbarLink('admin/media*') }}" type="button" id="dropdownMedias" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;Usuaris
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMedias">
                            <li>
                                <a href="{{ url('admin/registry') }}" class="{{ setActiveNavbarLink('admin/registry*') }}">Registres</a>
                            </li>
                            <li>
                                <a href="{{ url('admin/user') }}" class="{{ setActiveNavbarLink('admin/user*') }}">Alumnes</a>
                            </li>
                        </ul>
                    </li>
     

                    <li>
                        <a href="{{ url('admin/activity') }}" class="{{ setActiveNavbarLink('admin/activity*') }}"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;Activitats</a>
                    </li>

                    <li>
                        <a href="{{ url('admin/perk') }}" class="{{ setActiveNavbarLink('admin/perk*') }}"><i class="fa fa-star" aria-hidden="true"></i>&nbsp;&nbsp;Avantatges</a>
                    </li>

                    <li class="dropdown">
                        <a class="dropdown-toggle {{ setActiveNavbarLink('admin/media*') }}" type="button" id="dropdownMedias" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="fa fa-graduation-cap" aria-hidden="true"></i>&nbsp;&nbsp;Escoles
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMedias">
                            <li>
                                <a href="{{ url('admin/school') }}" class="{{ setActiveNavbarLink('admin/school*') }}">Escoles</a>
                            </li>
                            <li>
                                <a href="{{ url('admin/promotion') }}" class="{{ setActiveNavbarLink('admin/promotion*') }}">Promocions</a>
                            </li>
                            <li>
                                <a href="{{ url('admin/gallery') }}" class="{{ setActiveNavbarLink('admin/gallery*') }}">{{ trans('messages.galleries') }}</a>
                            </li>
                        </ul>
                    </li>

                    

                    

                    

                   <?php /* <li class="dropdown">
                        <a class="dropdown-toggle {{ setActiveNavbarLink(['admin/course*','admin/course*']) }}" type="button" id="dropdownCourses" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Cursos
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownPages">
                            <li>
                                <a href="{{ url('admin/course') }}" class="{{ setActiveNavbarLink('admin/course*') }}">Cursos</a>
                            </li>
                        </ul>
                    </li>*/ ?>

                </ul>

                

                <ul class="nav navbar-nav navbar-right">
                    <?php /*<li class="dropdown">
                        <a class="dropdown-toggle {{ setActiveNavbarLink('admin/media*') }}" type="button" id="dropdownMedias" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="fa fa-picture-o" aria-hidden="true"></i>&nbsp;&nbsp;{{ trans('messages.medias') }}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMedias">
                            <li>
                                <a href="{{ url('admin/media-original') }}">{{ trans('messages.media_originals') }}</a>
                            </li>
                            <li>
                                <a href="{{ url('admin/media-extension') }}">{{ trans('messages.media_extensions') }}</a>
                            </li>
                        </ul>
                    </li>*/ ?>
                    
                    <li>
                        <a href="{{ url('admin/configuration/1/edit?locale=ca') }}" class="{{ setActiveNavbarLink('admin/configuration*') }}"><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;&nbsp;Configuració</a>
                    </li>
                    
                    <li>
                        <a href="{{ url('admin/category') }}" class="{{ setActiveNavbarLink('admin/category*') }}"><i class="fa fa-sitemap" aria-hidden="true"></i>&nbsp;&nbsp;Categories</a>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('admin/logout') }}"><i class="fa fa-btn fa-sign-out"></i>{{ trans('messages.logout') }}</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@endif
