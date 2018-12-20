<nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">

    <div class="navbar-header">
        <button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided"
                data-toggle="menubar">
            <span class="sr-only">Toggle navigation</span>
            <span class="hamburger-bar"></span>
        </button>
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse"
                data-toggle="collapse">
            <i class="icon wb-more-horizontal" aria-hidden="true"></i>
        </button>
        <div class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu">
            <img class="navbar-brand-logo" src="{{ URL::to('img/logo.png') }}" title="La MasterLeague">
            <a style="color: white" href="{{ route('home') }}">
                <span class="navbar-brand-text hidden-xs-down"> La MasterLeague</span>
            </a>
        </div>
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-search"
                data-toggle="collapse">
            <span class="sr-only">Toggle Search</span>
            <i class="icon wb-search" aria-hidden="true"></i>
        </button>
    </div>

    <div class="navbar-container container-fluid">
        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
            <!-- Navbar Toolbar -->
            <ul class="nav navbar-toolbar">
                <li class="nav-item hidden-sm-down" id="toggleFullscreen">
                    <a class="nav-link icon icon-fullscreen" data-toggle="fullscreen" href="#" role="button">
                        <span class="sr-only">Toggle fullscreen</span>
                    </a>
                </li>
                <li class="nav-item hidden-float">
                    <a class="nav-link icon wb-search" data-toggle="collapse" href="#" data-target="#site-navbar-search"
                       role="button">
                        <span class="sr-only">Toggle Search</span>
                    </a>
                </li>
            </ul>
            <!-- End Navbar Toolbar -->

            <!-- Navbar Toolbar Right -->
            <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
                <li class="nav-item dropdown">
                    <a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false"
                       data-animation="scale-up" role="button">
                <span class="avatar avatar-online">
                  <img class="img-header" src="{{ URL::to('img/avatars') }}/{{ Auth::user()->avatar->img }}" alt="...">
                  <i></i>
                </span>
                    </a>
                    <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="{{ route('user.profile') }}" role="menuitem"><i class="icon wb-user" aria-hidden="true"></i> Perfil</a>
                        <a class="dropdown-item" href="{{ route('faqs') }}" role="menuitem"><i class="icon wb-help-circle" aria-hidden="true"></i> Ayuda</a>
                        <div class="dropdown-divider" role="presentation"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}" role="menuitem"><i class="icon wb-power" aria-hidden="true"></i> Logout</a>
                    </div>
                </li>
                <li class="nav-item dropdown" id="markasread" onclick="markNotificationAsRead()">
                    <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" title="Notificaciones"
                       aria-expanded="false" data-animation="scale-up" role="button">
                        <i class="icon wb-bell" aria-hidden="true"></i>
                        @if(count(auth()->user()->unreadNotifications) > 0)
                            <span class="badge badge-pill badge-danger up">{!! count(auth()->user()->unreadNotifications) !!}</span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-media" role="menu">
                        <div class="dropdown-menu-header">
                            <h5>NOTIFICACIONES</h5>
                            @if(count(auth()->user()->unreadNotifications) > 0)
                                <span class="badge badge-pill badge-danger up">Nuevas: {{ count(auth()->user()->unreadNotifications) }}</span>
                            @endif
                        </div>

                        <div class="list-group">
                            <div data-role="container">
                                <div data-role="content">
                                    @foreach(auth()->user()->unreadNotifications as $notification)
                                        @include('layouts.notifications.'.snake_case(class_basename($notification->type)))
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-menu-footer">
                            <a class="dropdown-menu-footer-btn" href="javascript:void(0)" role="button">
                                <i class="icon wb-eye" aria-hidden="true"></i>
                            </a>
                            <a class="dropdown-item" href="{{ route('user.notifications') }}" role="menuitem">
                                Ver más
                            </a>
                        </div>
                    </div>
                </li>
                <li class="nav-item" id="toggleChat">
                    <a class="nav-link" data-toggle="site-sidebar" href="javascript:void(0)" title="Chat"
                        data-url="{{ route('chat') }}">
                        <i class="icon wb-chat" aria-hidden="true"></i>
                    </a>
                </li>
            </ul>
            <!-- End Navbar Toolbar Right -->
        </div>
        <!-- End Navbar Collapse -->

        <!-- Site Navbar Seach -->
        <div class="collapse navbar-search-overlap" id="site-navbar-search">
            <form role="search">
                <div class="form-group">
                    <div class="input-search">
                        <i class="input-search-icon wb-search" aria-hidden="true"></i>
                        <input type="text" class="form-control" name="site-search" placeholder="Search...">
                        <button type="button" class="input-search-close icon wb-close" data-target="#site-navbar-search"
                                data-toggle="collapse" aria-label="Close"></button>
                    </div>
                </div>
            </form>
        </div>
        </div>
        <!-- End Site Navbar Seach -->
    </div>
</nav>

<script>
    function markNotificationAsRead() {
        var getUrl = "{!! url('') !!}";
        $.get(getUrl + '/markAsRead');
    }
</script>