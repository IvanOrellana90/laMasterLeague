@extends('layouts.master')

@section('body-class')
    page-user
@endsection

@section('css-plugins')
    <link rel="stylesheet" href="{{ URL::to('assets/examples/css/pages/user.css') }}">
@endsection

@section('main')
    <!-- Page -->
    <div class="page">
        <div class="page-content">
            <!-- Panel -->
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
                                    @foreach($matches->groupBy('round') as $matchesGroup)
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
                                    @foreach($matches->sortBy('date') as $match )
                                        <li id="{{ $match->id }}" class="list-group-item">
                                            <form method="post" action="{{ route('bet.store') }}">
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
                                                        <input class="input-score form-control" maxlength="2" name="home_score" value="{{ $user->bets->where('match_id', $match->id)->first()['home_score'] }}">
                                                    </div>
                                                    <div class="media-body align-self-center">
                                                        <p>
                                                            <i class="icon icon-color wb-map" aria-hidden="true"></i>
                                                            Street 4190 W Lone Mountain Rd
                                                        </p>
                                                        <h6 class="mt-0 mb-5">
                                                            {{ date('d-m-Y', strtotime($match->date)) }} <br>
                                                            @if($match->finished)
                                                                <small>{{ $match->home_score. " - " .$match->away_score }}</small>
                                                            @else
                                                                <small>{{ date('H:i', strtotime($match->date)) }}</small>
                                                            @endif
                                                        </h6>
                                                        <p class="realDate" style="display: none;">{{ $match->date }}</p>
                                                        <input type="hidden" name="match_id" value="{{ $match->id }}">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    </div>
                                                    <div class="media-body align-self-center">
                                                        <p class="nameAway">{{ $match->awayTeam['name'] }}</p>
                                                        <input class="input-score form-control" maxlength="2" name="away_score" value="{{ $user->bets->where('match_id', $match->id)->first()['away_score'] }}">
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
                                                    <div class="pl-0 pl-sm-20 mt-15 mt-sm-0 align-self-center">
                                                        @if(dateBiggerNow($match->date))
                                                            <button type="submit" class="btn btn-outline btn-success btn-sm" >Guardar</button>
                                                        @else
                                                            <button type="button" class="btn btn-outline btn-danger btn-sm disabled">Guardar</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </form>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- Segundo Tab JORNADAS -->
                            @foreach($matches->groupBy('round') as $matchesGroup)
                                <div class="tab-pane animation-fade" id="{{ $matchesGroup[0]->round }}" role="tabpanel">
                                    <ul class="list-group">
                                        @foreach($matchesGroup as $match )
                                            <li id="{{ $match->id }}" class="list-group-item">
                                                <form method="post" action="{{ route('bet.store') }}">
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
                                                            <p>{{ $match->homeTeam['name'] }}</p>
                                                            <input class="input-score form-control" maxlength="2" name="home_score" value="{{ $user->bets->where('match_id', $match->id)->first()['home_score'] }}">
                                                        </div>
                                                        <div class="media-body align-self-center">
                                                            <p>
                                                                <i class="icon icon-color wb-map" aria-hidden="true"></i>
                                                                Street 4190 W Lone Mountain Rd
                                                            </p>
                                                            <h6 class="mt-0 mb-5">
                                                                {{ date('d-m-Y', strtotime($match->date)) }} <br>
                                                                @if($match->finished)
                                                                    <small>{{ $match->home_score. " - " .$match->away_score }}</small>
                                                                @else
                                                                    <small>{{ date('H:i', strtotime($match->date)) }}</small>
                                                                @endif
                                                            </h6>
                                                            <input type="hidden" name="match_id" value="{{ $match->id }}">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        </div>
                                                        <div class="media-body align-self-center">
                                                            <p>{{ $match->awayTeam['name'] }}</p>
                                                            <input class="input-score form-control" maxlength="2" name="away_score" value="{{ $user->bets->where('match_id', $match->id)->first()['away_score'] }}">
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
                                                        <div class="pl-0 pl-sm-20 mt-15 mt-sm-0 align-self-center">
                                                            @if(dateBiggerNow($match->date))
                                                                <button type="submit" class="btn btn-outline btn-success btn-sm" >Guardar</button>
                                                            @else
                                                                <button type="button" class="btn btn-outline btn-danger btn-sm disabled">Guardar</button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </form>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            <!-- End Panel -->
        </div>
    </div>
    <!-- End Page -->
@endsection

@section('js-page')
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>

    <script>
        var monkeyList = new List('test-list', {
            valueNames: ['nameHome', 'nameAway', 'realDate']
        });
    </script>
@endsection