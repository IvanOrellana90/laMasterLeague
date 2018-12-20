@extends('layouts.master')

@section('body-class')
    page-user page-aside-left
@endsection

@section('css-plugins')
    <link rel="stylesheet" href="{{ URL::to('assets/examples/css/pages/user.css') }}">
    <link rel="stylesheet" href="{{ URL::to('global/vendor/bootstrap-select/bootstrap-select.css') }}">
    <link rel="stylesheet" href="{{ URL::to('global/vendor/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/examples/css/apps/documents.css') }}">
@endsection

@section('main')
    <div class="page" data-plugin="tabs">
        <div class="page-aside">
            <div class="page-aside-switch">
                <i class="icon wb-chevron-left" aria-hidden="true"></i>
                <i class="icon wb-chevron-right" aria-hidden="true"></i>
            </div>
            <div class="page-aside-inner page-aside-scroll">
                <div data-role="container">
                    <div data-role="content">
                        <section class="page-aside-section">
                            <h5 class="page-aside-title">{{ $tournament->name }}</h5>
                            <div class="list-group" role="tablist">
                                <a class="list-group-item" data-toggle="tab" href="#exampleTabsOne" aria-controls="exampleTabsOne" role="tab">
                                    <i class="icon fa fa-calendar" aria-hidden="true"></i>Partidos</a>
                                <!-- Grupos no hay goles para orden
                                <a class="list-group-item" data-toggle="tab" href="#exampleTabsTwo" aria-controls="exampleTabsTwo" role="tab">
                                    <i class="icon fa-group" aria-hidden="true"></i>Grupos</a> -->
                                <a class="list-group-item" data-toggle="tab" href="#exampleTabsThree" aria-controls="exampleTabsThree" role="tab">
                                    <i class="icon fas fa-futbol" aria-hidden="true"></i>Equipos</a>
                                <a class="list-group-item" data-toggle="tab" href="#exampleTabsFour" aria-controls="exampleTabsFour" role="tab">
                                    <i class="icon fa fa-list-ol" aria-hidden="true"></i>Ranking</a>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-main">
            <div class="tab-content pt-20">
                <div class="tab-pane active" id="exampleTabsOne" role="tabpanel">
                    @include('tournament.matches')
                </div>
                <!-- Grupos no hay goles para orden
                <div class="tab-pane" id="exampleTabsTwo" role="tabpanel">
                    Negant parvos fructu nostram mutans supplicii ac dissentias, maius tibi licebit
                    ruinae philosophia. Salutatus repellere titillaret expetendum
                    ipsi. Cupiditates intellegam exercitumque privatio concederetur,
                    sempiternum, verbis malint dissensio nullas noctesque earumque.
                </div> -->
                <div class="tab-pane" id="exampleTabsThree" role="tabpanel">
                    @include('tournament.teams')
                </div>
                <div class="tab-pane" id="exampleTabsFour" role="tabpanel">
                    @include('tournament.ranking')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-plugins')
    <script src="{{ URL::to('global/vendor/select2/select2.full.min.js') }}"></script>
    <script src="{{ URL::to('global/vendor/matchheight/jquery.matchHeight-min.js') }}"></script>
    <script src="{{ URL::to('global/vendor/bootstrap-select/bootstrap-select.js') }}"></script>
@endsection

@section('js-page')
    <script src="{{ URL::to('global/js/Plugin/select2.js') }}"></script>
    <script src="{{ URL::to('global/js/Plugin/matchheight.js') }}"></script>
    <script src="{{ URL::to('global/js/Plugin/animate-list.js') }}"></script>
    <script src="{{ URL::to('global/js/Plugin/responsive-tabs.js') }}"></script>
    <script src="{{ URL::to('global/js/Plugin/closeable-tabs.js') }}"></script>
    <script src="{{ URL::to('global/js/Plugin/tabs.js') }}"></script>
    <script src="{{ URL::to('global/js/Plugin/bootstrap-select.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
    <script>
        var monkeyList = new List('test-list', {
            valueNames: ['nameHome', 'nameAway', 'realDate']
        });

        var matchesList = new List('matches-list', {
            valueNames: ['teamName']
        });

        var userList = new List('users-list', {
            valueNames: ['userName']
        });
    </script>
@endsection