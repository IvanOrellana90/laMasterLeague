@extends('layouts.master')

@section('body-class')
    page-profile
@endsection

@section('css-plugins')
    <link rel="stylesheet" href="{{ URL::to('assets/examples/css/pages/profile.css') }}">
    <link rel="stylesheet" href="{{ URL::to('global/vendor/morris/morris.css') }}">
@endsection

@section('main')

    <!-- Page -->
    <div class="page">
        <div class="page-content container-fluid">
            <div class="row">
                <div class="col-xxl-6">
                    <div class="row">
                        <div class="col-xxl-12 col-lg-6">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6">
                                    <div class="card card-shadow text-center">
                                        <div class="card-block">
                                            <a class="avatar avatar-lg" style="cursor: pointer;" data-target="#exampleNiftyFadeScale" data-toggle="modal">
                                                <img src="{{ URL::to('img/logos') }}/{{ $match->homeTeam['flag'] }}" alt="...">
                                            </a>
                                            <div class="font-size-20 mb-5 blue-600 text-truncate">{{ $match->homeTeam['name'] }}</div>
                                            <div class="font-size-14 text-truncate">{{ $match->homeTeam['coach'] }}</div>
                                            @if(!$match->finished)
                                                <div class="font-size-20 mb-5 blue-600 text-truncate">-</div>
                                            @elseif($match->home_score < $match->away_score)
                                                <div class="font-size-20 mb-5 red-600 text-truncate">{{ $match->home_score }}</div>
                                            @elseif($match->home_score == $match->away_score)
                                                <div class="font-size-20 mb-5 yellow-600 text-truncate">{{ $match->home_score }}</div>
                                            @else
                                                <div class="font-size-20 mb-5 green-600 text-truncate">{{ $match->home_score }}</div>
                                            @endif
                                        </div>
                                        <div class="card-footer">
                                            <div class="row no-space">
                                                <div class="col-6">
                                                    <strong class="profile-stat-count">{{ getTeamTournamentEfectividad($match->tournament->id, $match->homeTeam['id']) }}%</strong>
                                                    <span>Efectividad</span>
                                                </div>
                                                <div class="col-6">
                                                    <strong class="profile-stat-count">{{ getTeamTournamentMatches($match->tournament->id, $match->homeTeam['id']) }}</strong>
                                                    <span>Partidos</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <div class="card card-shadow text-center">
                                        <div class="card-block">
                                            <a class="avatar avatar-lg" style="cursor: pointer;" data-target="#exampleNiftyFadeScale" data-toggle="modal">
                                                <img src="{{ URL::to('img/logos') }}/{{ $match->awayTeam['flag'] }}" alt="...">
                                            </a>
                                            <div class="font-size-20 mb-5 blue-600 text-truncate">{{ $match->awayTeam['name'] }}</div>
                                            <div class="font-size-14 text-truncate">{{ $match->awayTeam['coach'] }}</div>
                                            @if(!$match->finished)
                                                <div class="font-size-20 mb-5 blue-600 text-truncate">-</div>
                                            @elseif($match->home_score < $match->away_score)
                                                <div class="font-size-20 mb-5 green-600 text-truncate">{{ $match->away_score }}</div>
                                            @elseif($match->home_score == $match->away_score)
                                                <div class="font-size-20 mb-5 yellow-600 text-truncate">{{ $match->away_score }}</div>
                                            @else
                                                <div class="font-size-20 mb-5 red-600 text-truncate">{{ $match->away_score }}</div>
                                            @endif
                                        </div>
                                        <div class="card-footer">
                                            <div class="row no-space">
                                                <div class="col-6">
                                                    <strong class="profile-stat-count">{{ getTeamTournamentEfectividad($match->tournament->id, $match->awayTeam['id']) }}%</strong>
                                                    <span>Efectividad</span>
                                                </div>
                                                <div class="col-6">
                                                    <strong class="profile-stat-count">{{ getTeamTournamentMatches($match->tournament->id, $match->awayTeam['id']) }}</strong>
                                                    <span>Partidos</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-12 col-lg-6">
                            <!-- Panel Bar Pie -->
                            <div class="card card-shadow" id="chartBarPie" style="height:92.5%">
                                <div class="card-block p-0">
                                    <div class="p-30">
                                        <div class="row no-space">
                                            <div class="col-7">
                                                <table>
                                                    <tr class="font-size-20 clearfix">
                                                        <td class="text-center">
                                                            <i class="far fa-map-pin site-menu-icon"></i>
                                                        </td>
                                                        <td>
                                                            {{ $match->stadium->name }}
                                                        </td>
                                                    </tr>
                                                    <tr lass="font-size-16 clearfix">
                                                        <td class="text-center">
                                                            <i class="far fa-trophy site-menu-icon"></i>
                                                        </td>
                                                        <td>
                                                            {{ $match->tournament->name }}
                                                        </td>
                                                    </tr>
                                                    <tr lass="font-size-14 clearfix">
                                                        <td class="text-center">
                                                            <i class="far fa-stopwatch site-menu-icon"></i>
                                                        </td>
                                                        <td>
                                                            {{ date('d-m-Y', strtotime($match->date)) }}
                                                            <small>{{ date('H:i', strtotime($match->date)) }}</small>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <p class="mt-20">
                                                    <span class="icon wb-medium-point blue-200 mr-5"></span>
                                                    {{ getPercentageHome($match->id,$bets->count()) }} Local
                                                </p>
                                                <p class="mb-18">
                                                    <span class="icon wb-medium-point blue-500 mr-5"></span>
                                                    {{ getPercentageDraw($match->id,$bets->count()) }} Empate
                                                </p>
                                                <p>
                                                    <span class="icon wb-medium-point blue-800 mr-5"></span>
                                                    {{ getPercentageAway($match->id,$bets->count()) }} Visita
                                                </p>
                                            </div>
                                            <div class="col-5 mt-">
                                                <div class="example mt-0 mb-0">
                                                    <div style="height: 233px;" id="exampleMorrisDonut"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="row no-space">
                                        <div class="col-3">
                                            <strong class="profile-stat-count">{{ getMediaGolesLocal($match->id,$bets->count()) }}</strong>
                                            <span>Local</span>
                                        </div>
                                        <div class="col-3">
                                            <strong class="profile-stat-count">{{ getMediaGolesVisita($match->id,$bets->count()) }}</strong>
                                            <span>Visita</span>
                                        </div>
                                        <div class="col-3">
                                            <strong class="profile-stat-count">{{ getPuntosPromedio($match->id,$bets->count()) }}</strong>
                                            <span>Puntos</span>
                                        </div>
                                        <div class="col-3">
                                            <strong class="profile-stat-count">{{ $bets->count() }}</strong>
                                            <span>Total</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Panel Bar Pie -->
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-xxl-6 col-xl-12">
                    <!-- Panel -->
                    <div class="panel">
                        <div class="panel-body" id="bet-list">
                            <form class="page-search-form mb-40" role="search">
                                <div class="input-search input-search-dark">
                                    <i class="input-search-icon wb-search" aria-hidden="true"></i>
                                    <input type="text" class="form-control search" id="inputSearch" name="search" placeholder="Buscar">
                                    <button type="button" class="input-search-close icon wb-close" aria-label="Close"></button>
                                </div>
                            </form>
                            <div class="nav-tabs-animate nav-tabs-horizontal" data-plugin="tabs">
                                <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="active nav-link" data-toggle="tab" href="#apuestas"aria-controls="apuestas" role="tab">Apuestas </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane active animation-slide-left" id="apuestas" role="tabpanel">
                                        @include('bet.includes.usersBets')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Panel -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Page -->
@endsection

@section('js-page')
    <script src="{{ URL::to('global/vendor/raphael/raphael.min.js') }}"></script>
    <script src="{{ URL::to('global/vendor/morris/morris.min.js') }}"></script>
    <script src="{{ URL::to('global/js/Plugin/responsive-tabs.js') }}"></script>
    <script src="{{ URL::to('global/js/Plugin/tabs.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
    <script>
        var betList = new List('bet-list', {
            valueNames: ['username']
        });
    </script>
    <script>
        new Morris.Donut({
        element: 'exampleMorrisDonut',
        data: [{
            label: "Local",
            value: parseInt("{{ getNumberHome($match->id) }}")
        }, {
            label: "Empate",
            value: parseInt("{{ getNumberDraw($match->id) }}")
        }, {
            label: "Visita",
            value: parseInt("{{ getNumberAway($match->id) }}")
        }],
        // barSizeRatio: 0.35,
        resize: true,
        colors: [Config.colors("blue", 200), Config.colors("blue", 500), Config.colors("blue", 800)]
        });
    </script>
@endsection