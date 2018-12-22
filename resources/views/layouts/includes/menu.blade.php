<div class="site-menubar">
    <div class="site-menubar-body">
        <div>
            <div>
                <ul class="site-menu" data-plugin="menu">
                    <li class="site-menu-category">General</li>
                    <li class="site-menu-item">
                        <a href="{{ route('home') }}">
                            <i class="site-menu-icon fa fa-home" aria-hidden="true"></i>
                            <span class="site-menu-title">Camarín</span>
                        </a>
                    </li>
                    <li class="site-menu-item has-sub">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon fa fa-trophy" aria-hidden="true"></i>
                            <span class="site-menu-title">Torneos</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            @foreach($tournaments->where('active', true) as $tournament)
                                <li class="site-menu-item">
                                    <a class="animsition-link" href="{{ route('tournament', $tournament->id) }}">
                                        <span class="site-menu-title">{{ $tournament->name }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="site-menu-item">
                        <a href="{{ route('forum') }}">
                            <i class="site-menu-icon fa fa-comments" aria-hidden="true"></i>
                            <span class="site-menu-title">Polémicas</span>
                        </a>
                    </li>
                    <li class="site-menu-item">
                        <a href="{{ route('legends') }}">
                            <i class="site-menu-icon fas fa-medal" aria-hidden="true"></i>
                            <span class="site-menu-title">Leyendas</span>
                        </a>
                    </li>
                    <li class="site-menu-category">MasterLeague</li>
                    <li class="site-menu-item has-sub">
                        <a href="{{ route('bets') }}">
                            <i class="site-menu-icon wb-heart-outline" aria-hidden="true"></i>
                            <span class="site-menu-title">Apuestas</span>
                        </a>
                    </li>
                    <li class="site-menu-item has-sub">
                        <a href="{{ route('groups') }}">
                            <i class="site-menu-icon far fa-users" aria-hidden="true"></i>
                            <span class="site-menu-title">Grupos</span>
                        </a>
                    </li>
                </ul>
                <div class="site-menubar-section">
                    <h5>
                        Efectividad
                        <span class="float-right">{{ getUserEfectividad($user->id) }}%</span>
                    </h5>
                    <div class="progress progress-xs">
                        <div class="progress-bar active" style="width: {{ getUserEfectividad($user->id) }}%;" role="progressbar"></div>
                    </div>
                    <h5>
                        Nivel
                        <span class="float-right">{{ getUserLevel($user->id) }}</span>
                    </h5>
                    <div class="progress progress-xs" data-placement="bottom" data-toggle="tooltip"
                         data-original-title="Próximo nivel: {{ \Illuminate\Support\Facades\DB::table('levels')->where('level', (getUserLevel($user->id)+1))->first()->points - getUserPoints($user->id) }}">
                        <div class="progress-bar progress-bar-warning" style="width: {{ getUserNextLevel($user->id) }}%;" role="progressbar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-menubar-footer">
        <a href="{{ route('faqs') }}" class="fold-show" data-placement="top" data-toggle="tooltip"
           data-original-title="Ayuda">
            <span class="icon wb-help-circle" aria-hidden="true"></span>
        </a>
        <a href="{{ route('user.profile') }}" data-placement="top" data-toggle="tooltip" data-original-title="Perfil">
            <span class="icon wb-user" aria-hidden="true"></span>
        </a>
        <a href="{{ route('logout') }}" data-placement="top" data-toggle="tooltip" data-original-title="Logout">
            <span class="icon wb-power" aria-hidden="true"></span>
        </a>
    </div>
</div>