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
                <div class="dropdown page-user-sortlist">
                    Ordenar por: <a class="dropdown-toggle inline-block" data-toggle="dropdown"
                                    href="#" aria-expanded="false"> Fecha</a>
                    <div class="dropdown-menu animation-scale-up animation-top-right animation-duration-250"
                         role="menu">
                        <a class="active dropdown-item sort" data-sort="realDate">Fecha</a>
                        <a class="dropdown-item sort" data-sort="nameHome">Local</a>
                        <a class="dropdown-item sort" data-sort="nameAway">Visita</a>
                    </div>
                </div>

                <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="active nav-link" data-toggle="tab" href="#all_matches" aria-controls="all_matches" role="tab">
                            Todos los Partidos
                        </a>
                    </li>
                    <li class="dropdown nav-item" role="presentation">
                        <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#" aria-expanded="false">Jornadas </a>
                        <div class="dropdown-menu" role="menu">
                            @foreach($tournament->matches->groupBy('round') as $matchesGroup)
                                <a class="dropdown-item" data-toggle="tab" href="#{{ $matchesGroup[0]->round }}" aria-controls="{{ $matchesGroup[0]->round }}" role="tab">
                                    {{ $matchesGroup[0]->round }}
                                </a>
                            @endforeach
                        </div>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane animation-fade active" id="all_matches" role="tabpanel">
                        <!-- Primer tab TODOS LOS PARTIDOS -->
                        <ul class="list-group list">
                            @foreach($tournament->matches->sortBy('date') as $match )
                                <li id="{{ $match->id }}" class="list-group-item">
                                    <div class="media">
                                        <div class="pr-0 pr-sm-20 align-self-center">
                                            <div class="avatar avatar-online">
                                                <img src="{{ URL::to('img/logos') }}/{{ $match->homeTeam['flag'] }}" alt="...">
                                                @if(!$match->finished)
                                                    <i class="bg-blue-700"></i>
                                                @elseif($match->home_score > $match->away_score)
                                                    <i></i>
                                                @elseif($match->home_score == $match->away_score)
                                                    <i class="bg-yellow-500"></i>
                                                @else
                                                    <i class="bg-red-800"></i>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="media-body align-self-center">
                                            <p class="nameHome">{{ $match->homeTeam['name'] }}</p>
                                            <input class="input-score form-control" maxlength="2" name="home_score" value="{{ $match->home_score }}" disabled>
                                        </div>
                                        <div class="media-body align-self-center">
                                            <p>
                                                <i class="icon icon-color wb-map" aria-hidden="true"></i>
                                                @if($match->stadium_id != null)
                                                    {{ $match->stadium->name }}
                                                @elseif($match->homeTeam['stadium_id'] != null)
                                                    {{ $match->homeTeam }}
                                                @else
                                                    No definido
                                                @endif
                                            </p>
                                            <h6 class="mt-0 mb-5">
                                                {{ date('d-m-Y', strtotime($match->date)) }} <br>
                                                <small>{{ date('H:i', strtotime($match->date)) }}</small>
                                            </h6>
                                            <p class="realDate" style="display: none;">{{ $match->date }}</p>
                                            <input type="hidden" name="match_id" value="{{ $match->id }}">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        </div>
                                        <div class="media-body align-self-center">
                                            <p class="nameAway">{{ $match->awayTeam['name'] }}</p>
                                            <input class="input-score form-control" maxlength="2" name="away_score" value="{{ $match->away_score }}" disabled>
                                        </div>
                                        <div class="pr-0 pr-sm-20 align-self-center">
                                            <div class="avatar avatar-online">
                                                <img src="{{ URL::to('img/logos') }}/{{ $match->awayTeam['flag'] }}" alt="...">
                                                @if(!$match->finished)
                                                    <i class="bg-blue-700"></i>
                                                @elseif($match->home_score < $match->away_score)
                                                    <i></i>
                                                @elseif($match->home_score == $match->away_score)
                                                    <i class="bg-yellow-500"></i>
                                                @else
                                                    <i class="bg-red-800"></i>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- Segundo Tab JORNADAS -->
                    @foreach($tournament->matches->groupBy('round') as $matchesGroup)
                        <div class="tab-pane animation-fade" id="{{ $matchesGroup[0]->round }}" role="tabpanel">
                            <ul class="list-group">
                                @foreach($matchesGroup as $match )
                                    <li id="{{ $match->id }}" class="list-group-item">
                                        <div class="media">
                                            <div class="pr-0 pr-sm-20 align-self-center">
                                                <div class="avatar avatar-online">
                                                    <img src="{{ URL::to('img/logos') }}/{{ $match->homeTeam['flag'] }}" alt="...">
                                                    @if(!$match->finished)
                                                        <i class="bg-blue-700"></i>
                                                    @elseif($match->home_score > $match->away_score)
                                                        <i></i>
                                                    @elseif($match->home_score == $match->away_score)
                                                        <i class="bg-yellow-500"></i>
                                                    @else
                                                        <i class="bg-red-800"></i>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="media-body align-self-center">
                                                <p class="nameHome">{{ $match->homeTeam['name'] }}</p>
                                                <input class="input-score form-control" maxlength="2" name="home_score" value="{{ $match->home_score }}" disabled>
                                            </div>
                                            <div class="media-body align-self-center">
                                                <p>
                                                    <i class="icon icon-color wb-map" aria-hidden="true"></i>
                                                    {{ $match->homeTeam['stadium'] }}
                                                </p>
                                                <h6 class="mt-0 mb-5">
                                                    {{ date('d-m-Y', strtotime($match->date)) }} <br>
                                                    <small>{{ date('H:i', strtotime($match->date)) }}</small>
                                                </h6>
                                                <p class="realDate" style="display: none;">{{ $match->date }}</p>
                                                <input type="hidden" name="match_id" value="{{ $match->id }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            </div>
                                            <div class="media-body align-self-center">
                                                <p class="nameAway">{{ $match->awayTeam['name'] }}</p>
                                                <input class="input-score form-control" maxlength="2" name="away_score" value="{{ $match->away_score }}" disabled>
                                            </div>
                                            <div class="pr-0 pr-sm-20 align-self-center">
                                                <div class="avatar avatar-online">
                                                    <img src="{{ URL::to('img/logos') }}/{{ $match->awayTeam['flag'] }}" alt="...">
                                                    @if(!$match->finished)
                                                        <i class="bg-blue-700"></i>
                                                    @elseif($match->home_score < $match->away_score)
                                                        <i></i>
                                                    @elseif($match->home_score == $match->away_score)
                                                        <i class="bg-yellow-500"></i>
                                                    @else
                                                        <i class="bg-red-800"></i>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>