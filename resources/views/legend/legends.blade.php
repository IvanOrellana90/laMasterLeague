@extends('layouts.master')

@section('body-class')
    app-documents
@endsection

@section('css-plugins')
    <link rel="stylesheet" href="{{ URL::to('global/vendor/bootstrap-select/bootstrap-select.css') }}">
    <link rel="stylesheet" href="{{ URL::to('global/vendor/bootstrap-markdown/bootstrap-markdown.css') }}">
    <link rel="stylesheet" href="{{ URL::to('global/vendor/select2/select2.css') }}">
    <link rel="stylesheet" href="{{  URL::to('assets/examples/css/apps/documents.css') }}">
@endsection

@section('main')
    <!-- Page -->
    <div class="page">

        <div class="page-content" id="test-list">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <select data-plugin="selectpicker" data-style="btn-outline">
                            <option>Todo</option>
                            @foreach($tournaments as $tournament)
                                <option>{{ $tournament->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="input-search-btn">
                        <i class="icon wb-search" aria-hidden="true"></i>
                    </button>
                    <input type="text" class="form-control search" placeholder="Buscar">
                </div>
            </div>
            <div class="documents-wrap categories" data-plugin="animateList" data-child="li">
                <ul class="blocks blocks-100 blocks-xxl-4 blocks-lg-3 blocks-sm-2 list" data-plugin="matchHeight">
                    @foreach($legends as $legend)
                        <li>
                            <div class="card card-shadow">
                                <div class="card-header card-header-transparent cover overlay">
                                    <div class="cover-background h-150" style="background-image: url('{{ URL::to('img/banner') }}/{{ $legend->tournament->img }}')"></div>
                                </div>
                                <div class="ribbon ribbon-vertical ribbon-bookmark ribbon-warning">
                                    <span class="ribbon-inner"><i class="icon fa fa-star" aria-hidden="true"></i></span>
                                </div>
                                <div class="card-block px-30 py-20" style="height:calc(100% - 250px);">
                                    <div style="position:relative;padding-left:110px;">
                                        <a class="avatar avatar-100 bg-transparent" href="{{ route('user', $legend->user->id) }}" style="position:absolute;top:-50px;left:0;">
                                            <img src="{{ URL::to('img/avatars') }}/{{ $legend->user->avatar->img }}" alt="">
                                        </a>
                                        <div class="mb-40">
                                            <div class="font-size-20">
                                                <p class="name">{{ $legend->user->name }}</p>
                                            </div>
                                            <div class="font-size-14">
                                                <a href="{{ route('tournament', $legend->tournament->id) }}" class="tournament">
                                                    {{ $legend->tournament->name. " " .$legend->tournament->season }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-center ">
                                    <div class="row no-space">
                                        <div class="col-4">
                                            <div class="counter">
                                                <span class="counter-number">{{ getUserTournamentEfectividad($legend->tournament->id,$legend->user->id) }}%</span>
                                                <div class="counter-label">Efectividad</div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="counter">
                                                <span class="counter-number">{{ getUserTournamentPoints($legend->tournament->id,$legend->user->id) }}</span>
                                                <div class="counter-label">Puntos</div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="counter">
                                                <span class="counter-number">{{ getUserTournamentPoints($legend->tournament->id,$legend->user->id) }}</span>
                                                <div class="counter-label">Participantes</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page -->
@endsection

@section('js-plugins')
    <script src="{{ URL::to('global/vendor/select2/select2.full.min.js') }}"></script>
    <script src="{{ URL::to('global/vendor/matchheight/jquery.matchHeight-min.js') }}"></script>
    <script src="{{ URL::to('global/vendor/bootstrap-markdown/bootstrap-markdown.js') }}"></script>
    <script src="{{ URL::to('global/vendor/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ URL::to('global/vendor/stickyfill/stickyfill.js') }}"></script>
@endsection

@section('js-page')
    <script src="{{ URL::to('global/js/Plugin/select2.js') }}"></script>
    <script src="{{ URL::to('global/js/Plugin/matchheight.js') }}"></script>
    <script src="{{ URL::to('global/js/Plugin/bootstrap-select.js') }}"></script>
    <script src="{{ URL::to('global/js/Plugin/animate-list.js') }}"></script>
    <script src="{{ URL::to('assets/js/Site.js') }}"></script>
    <script src="{{ URL::to('assets/js/App/Documents.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>

    <script>
        var monkeyList = new List('test-list', {
            valueNames: ['name', 'tournament']
        });
    </script>
@endsection
