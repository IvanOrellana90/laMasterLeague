@extends('layouts.master')

@section('body-class')
    page-profile
@endsection

@section('css-plugins')
    <link rel="stylesheet" href="{{ URL::to('assets/examples/css/pages/profile.css') }}">
@endsection

@section('main')

    <!-- Page -->
    <div class="page">
        <div class="page-content container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <!-- Page Widget -->
                    <div class="card card-shadow text-center">
                        <div class="card-block">
                            @if(isLeyenda($user->id))
                                <div class="ribbon ribbon-vertical ribbon-bookmark ribbon-warning">
                                    <span class="ribbon-inner"><i class="icon fa fa-star" aria-hidden="true"></i></span>
                                </div>
                            @endif
                            <a class="avatar avatar-lg" style="cursor: pointer;" data-target="#exampleNiftyFadeScale" data-toggle="modal">
                                <img src="{{ URL::to('img/avatars') }}/{{ $user->avatar->img }}" alt="...">
                            </a>
                            <h4 class="profile-user">{{ $user->name }}</h4>
                            <p class="profile-job">{{ date('d-m-Y', strtotime($user->created_at)) }}</p>
                            <p><strong>{{ $user->avatar->name }}</strong></p>
                        </div>
                        <div class="card-footer">
                            <div class="row no-space">
                                <div class="col-4">
                                    <strong class="profile-stat-count">{{ $user->bets->count() }}</strong>
                                    <span>Apuestas</span>
                                </div>
                                <div class="col-4">
                                    <strong class="profile-stat-count">{{ $user->groupsBelong->count() }}</strong>
                                    <span>Grupos</span>
                                </div>
                                <div class="col-4">
                                    <strong class="profile-stat-count">{{ getUserLevel($user->id) }}</strong>
                                    <span>Nivel</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Page Widget -->
                </div>

                <div class="col-lg-9">
                    <!-- Panel -->
                    <div class="panel">
                        <div class="panel-body nav-tabs-animate nav-tabs-horizontal" data-plugin="tabs">
                            <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="active nav-link" data-toggle="tab" href="#apuestas"aria-controls="apuestas" role="tab">Apuestas </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-toggle="tab" href="#mensajes" aria-controls="mensajes" role="tab">Mensajes</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#" aria-expanded="false">Menu </a>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="active dropdown-item" data-toggle="tab" href="#apuestas" aria-controls="apuestas"
                                           role="tab">Apuestas <span class="badge badge-pill badge-danger">5</span></a>
                                        <a class="dropdown-item" data-toggle="tab" href="#mensajes" aria-controls="mensajes"
                                           role="tab">Mensajes</a>
                                    </div>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active animation-slide-left" id="apuestas" role="tabpanel">
                                    @include('user.bets')
                                </div>

                                <div class="tab-pane animation-slide-left" id="mensajes" role="tabpanel">
                                    @include('user.topics')
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
    <script src="{{ URL::to('global/js/Plugin/responsive-tabs.js') }}"></script>
    <script src="{{ URL::to('global/js/Plugin/tabs.js') }}"></script>
@endsection