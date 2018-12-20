<div class="site-menubar">
    <div class="site-menubar-body">
        <div>
            <div>
                <ul class="site-menu" data-plugin="menu">
                    <li class="site-menu-category">Tablas</li>
                    <li class="site-menu-item">
                        <a href="{{ route('home') }}">
                            <i class="site-menu-icon fa-home" aria-hidden="true"></i>
                            <span class="site-menu-title">Inicio</span>
                        </a>
                    </li>
                    <li class="site-menu-item">
                        <a href="">
                            <i class="site-menu-icon fa-trophy" aria-hidden="true"></i>
                            <span class="site-menu-title">Torneos</span>
                        </a>
                    </li>
                    <li class="site-menu-item">
                        <a href="{{ route('admin.matches') }}">
                            <i class="site-menu-icon fa-calendar" aria-hidden="true"></i>
                            <span class="site-menu-title">Partidos</span>
                        </a>
                    </li>
                    <li class="site-menu-item has-sub">
                        <a href="{{ route('groups') }}">
                            <i class="site-menu-icon fa-user-o" aria-hidden="true"></i>
                            <span class="site-menu-title">Grupos</span>
                        </a>
                    </li>
                    <li class="site-menu-category">MasterLeague</li>
                    <li class="site-menu-item">
                        <a href="{{ route('forum') }}">
                            <i class="site-menu-icon fa-comments" aria-hidden="true"></i>
                            <span class="site-menu-title">Foro</span>
                        </a>
                    </li>
                </ul>
                <div class="site-menubar-section">
                    <h5>
                        Milestone
                        <span class="float-right">30%</span>
                    </h5>
                    <div class="progress progress-xs">
                        <div class="progress-bar active" style="width: 30%;" role="progressbar"></div>
                    </div>
                    <h5>
                        Release
                        <span class="float-right">60%</span>
                    </h5>
                    <div class="progress progress-xs">
                        <div class="progress-bar progress-bar-warning" style="width: 60%;" role="progressbar"></div>
                    </div>
                </div>      </div>
        </div>
    </div>

    <div class="site-menubar-footer">
        <a href="javascript: void(0);" class="fold-show" data-placement="top" data-toggle="tooltip"
           data-original-title="Settings">
            <span class="icon wb-settings" aria-hidden="true"></span>
        </a>
        <a href="javascript: void(0);" data-placement="top" data-toggle="tooltip" data-original-title="Lock">
            <span class="icon wb-eye-close" aria-hidden="true"></span>
        </a>
        <a href="{{ route('logout') }}" data-placement="top" data-toggle="tooltip" data-original-title="Logout">
            <span class="icon wb-power" aria-hidden="true"></span>
        </a>
    </div>
</div>