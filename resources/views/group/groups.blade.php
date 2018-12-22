@extends('layouts.master')

@section('body-class')
    app-documents
@endsection

@section('css-plugins')
    <link rel="stylesheet" href="{{ URL::to('global/vendor/bootstrap-select/bootstrap-select.css') }}">
    <link rel="stylesheet" href="{{ URL::to('global/vendor/bootstrap-markdown/bootstrap-markdown.css') }}">
    <link rel="stylesheet" href="{{ URL::to('global/vendor/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/examples/css/apps/documents.css') }}">
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
                    @foreach($user->groupsBelong as $group)
                        <li>
                            <div class="category">
                                <h4 class="name"><a href="{{ route('group', $group->id) }}">{{ $group->name }}</a></h4>
                                <h6 class="tournament-name tournament">{{ $group->tournament->name }}</h6>
                                <p>{!!  substr($group->description,0,90) !!}...</p>
                                <hr>
                                @if($group->users->where('id', Auth::id())->first()->pivot->active)
                                    <div class="row no-space">
                                        <div class="col-4">
                                            <div class="counter">
                                                <span class="counter-number">{{ countUsersByGroup($group->id) }}</span>
                                                <div class="counter-label">Usuarios</div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="counter">
                                                <span class="counter-number">#{{ getGrupoUserLugar($group->id,$user->id) }}</span>
                                                <div class="counter-label">Lugar</div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="counter">
                                                <div class="avatar avatar-online">
                                                    <img src="{{ URL::to('img/avatars') }}/{{ $group->user->avatar->img }}" alt="...">
                                                    <p class="user" style="display: none">{{ $group->user->name }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row no-space">
                                        <div class="col-12">
                                            <div class="counter">
                                                <a class="btn btn-primary" href="{{ route('group.confirmGroup', $group->id) }}" >Ingresar</a>
                                                <a class="btn btn-primary btn-danger" href="{{ route('group.deleteInvitation', $group->id) }}">Borrar</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page -->

    <button class="site-action btn-raised btn btn-success btn-floating" data-target="#addGroupForm"
            data-toggle="modal" type="button">
        <i class="icon wb-plus" aria-hidden="true"></i>
    </button>

    <!-- Add Topic Form -->
    <div class="modal fade" id="addGroupForm" aria-hidden="true" aria-labelledby="addTopicForm"
         role="dialog" tabindex="-1">
        <div class="modal-dialog modal-simple">
            <div class="modal-content">
                <form method="post" action="{{ route('group.store') }}">
                    <div class="modal-header">
                        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
                        <h4 class="modal-title">Crear Nuevo Grupo</h4>
                    </div>
                    <div class="modal-body container-fluid">
                        <div class="form-group">
                            <label class="form-control-label mb-15" for="topicTitle">Nombre:</label>
                            <input type="text" class="form-control" id="topicTitle" name="name" placeholder="Shelerino Cup..."/>
                        </div>
                        <div class="form-group">
                            <textarea name="description" data-provide="markdown" data-iconlibrary="fa" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label mb-15">Participantes:</label>
                            <select required name="users[]" class="form-control" multiple data-plugin="select2" data-minimum-input-length="2" data-max-option="15">
                                @foreach($users as $userGroup)
                                    <option value="{{ $userGroup->id }}"> {{ $userGroup->email }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="form-control-label mb-15" for="topicCategory">Torneo:</label>
                                    <select name="tournament" id="topicCategory" data-plugin="selectpicker">
                                        @foreach($tournaments as $tournament)
                                            <option value="{{ $tournament->id }}">{{ $tournament->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-left">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button class="btn btn-primary" type="submit">Ingresar</button>
                        <a class="btn btn-primary btn-danger" data-dismiss="modal" href="javascript:void(0)">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
            valueNames: ['name', 'tournament', 'user']
        });
    </script>
@endsection
