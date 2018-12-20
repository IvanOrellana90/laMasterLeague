<div class="page-content">
    <div class="panel">
        <div class="panel-body" id="test-list">
            <form class="page-search-form" role="search">
                <div class="input-search input-search-dark">
                    <i class="input-search-icon wb-search" aria-hidden="true"></i>
                    <input type="text" class="form-control search" id="inputSearch" name="search" placeholder="Buscar">
                    <button type="button" class="input-search-close icon wb-close" aria-label="Close"></button>
                </div>
            </form>

            <div class="nav-tabs-horizontal nav-tabs-animate" data-plugin="tabs">
                <div class="tab-content">
                    <div class="tab-pane animation-fade active" id="all_matches" role="tabpanel">
                        <!-- Primer tab TODOS LOS PARTIDOS -->
                        <ul class="list-group list">
                            @php($count = 0)
                            @php($points = 1000)
                            @php($countReal = 0)
                            @foreach($group->users->sortByDesc('points') as $user )
                                @if($user->pivot->active)
                                    @php($countReal++)
                                    @if($points > $user->points)
                                        @php($count = $countReal)
                                    @endif
                                    @php($points = $user->points)
                                    <li class="list-group-item">
                                        <div class="media">
                                            <div class="pr-0 pr-sm-20 align-self-center">
                                                <div class="avatar avatar-online">
                                                    <img src="{{ URL::to('img/avatars') }}/{{ $user->avatar->img }}" alt="...">
                                                    <i class="avatar avatar-busy"></i>
                                                </div>
                                            </div>
                                            <div class="media-body align-self-center">
                                                <h4 class="mt-0 mb-5">
                                                    <a href="{{ route('user', $user->id) }}" class="name">{{ $user->name }}</a>
                                                </h4>
                                                <p>
                                                    Registrado hace: {{ diffDays($user->created_at) }} días
                                                </p>
                                            </div>
                                            <div class="media-body align-self-center">
                                                <h4 class="mt-0 mb-5">
                                                    {{ getUserTournamentEfectividad($group->tournament->id, $user->id) }} %
                                                </h4>
                                                <p>
                                                    Efectividad
                                                </p>
                                            </div>
                                            <div class="media-body align-self-center">
                                                <h4 class="mt-0 mb-5">
                                                    {{ $user->points }}
                                                </h4>
                                                <p>
                                                    Puntos
                                                </p>
                                            </div>
                                            <div class="media-body align-self-center">
                                                <h4 class="mt-0 mb-5">
                                                    {{ $count }}º
                                                </h4>
                                                <p>
                                                    Lugar
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>