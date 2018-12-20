@extends('layouts.master')

@section('body-class')
    page-user
@endsection

@section('css-plugins')
    <link rel="stylesheet" href="{{ URL::to('assets/examples/css/pages/user.css') }}">
@endsection

@section('main')
    <div class="page">
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
                                <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#" aria-expanded="false">Torneos </a>
                                <div class="dropdown-menu" role="menu">
                                    @foreach($tournaments as $torunament)
                                        <a class="dropdown-item" data-toggle="tab" href="#{{ $torunament->name }}" aria-controls="{{ $torunament->name }}" role="tab">
                                            {{ $torunament->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane animation-fade active" id="all_matches" role="tabpanel">
                                <!-- Primer tab TODOS LOS PARTIDOS -->
                                <ul class="list-group list">
                                    @foreach($matches as $match )
                                        <li id="{{ $match->id }}" class="list-group-item">
                                            <form method="post" action="{{ route('admin.match.finished') }}">
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
                                                        <input class="input-score form-control" maxlength="2" name="home_score" value="{{ $match->home_score }}" @if($match->finished) disabled @endif>
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
                                                        @if(!dateBiggerNow($match->date) && !$match->finished)
                                                            <span class="badge badge-round badge-danger">Pendiente</span>
                                                        @endif
                                                        <p class="realDate" style="display: none;">{{ $match->date }}</p>
                                                        <input type="hidden" name="match_id" value="{{ $match->id }}">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    </div>
                                                    <div class="media-body align-self-center">
                                                        <p class="nameAway">{{ $match->awayTeam['name'] }}</p>
                                                        <input class="input-score form-control" maxlength="2" name="away_score" value="{{ $match->away_score }}" @if($match->finished) disabled @endif>
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
                                                        @if(!$match->finished)
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
                            @foreach($tournaments as $tournament)
                                <div class="tab-pane animation-fade" id="{{ $torunament->name }}" role="tabpanel">
                                    <ul class="list-group">
                                        @foreach($torunament->matches as $match )
                                            <li id="{{ $match->id }}" class="list-group-item">
                                                <form method="post" action="{{ route('admin.match.finished') }}">
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
                                                            <input class="input-score form-control" maxlength="2" name="home_score" value="{{ $match->home_score }}" @if($match->finished) disabled @endif>
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
                                                            @if(!dateBiggerNow($match->date) && !$match->finished)
                                                                <span class="badge badge-round badge-danger">Pendiente</span>
                                                            @endif
                                                            <p class="realDate" style="display: none;">{{ $match->date }}</p>
                                                            <input type="hidden" name="match_id" value="{{ $match->id }}">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        </div>
                                                        <div class="media-body align-self-center">
                                                            <p class="nameAway">{{ $match->awayTeam['name'] }}</p>
                                                            <input class="input-score form-control" maxlength="2" name="away_score" value="{{ $match->away_score }}" @if($match->finished) disabled @endif>
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
                                                            @if(!$match->finished)
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
        </div>
    </div>
@endsection

@section('js-page')
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
    <script>
        var monkeyList = new List('test-list', {
            valueNames: ['nameHome', 'nameAway', 'realDate']
        });
    </script>
@endsection