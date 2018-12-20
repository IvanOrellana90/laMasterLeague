@extends('layouts.master')

@section('body-class')
    page-user page-aside-left
@endsection

@section('css-plugins')
    <link rel="stylesheet" href="{{ URL::to('global/vendor/bootstrap-select/bootstrap-select.css') }}">
    <link rel="stylesheet" href="{{ URL::to('global/vendor/bootstrap-markdown/bootstrap-markdown.css') }}">
    <link rel="stylesheet" href="{{ URL::to('global/vendor/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/examples/css/pages/user.css') }}">
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
                            <h5 class="page-aside-title">{{ $group->name }}</h5>
                            <div class="list-group" role="tablist">
                                <a class="list-group-item" data-toggle="tab" href="#exampleTabsOne" aria-controls="exampleTabsOne" role="tab">
                                    <i class="icon fa fa-trophy" aria-hidden="true"></i>Ranking</a>
                                <a class="list-group-item" data-toggle="tab" href="#exampleTabsOne" aria-controls="exampleTabsOne" role="tab">
                                    <i class="icon fa fa-calendar" aria-hidden="true"></i>La Fecha</a>
                                <a class="list-group-item" data-toggle="tab" href="#exampleTabsThree" aria-controls="exampleTabsThree" role="tab">
                                    <i class="icon fa fa-comments" aria-hidden="true"></i>Galería</a>
                                <a class="list-group-item" data-toggle="tab" href="#exampleTabsFour" aria-controls="exampleTabsFour" role="tab">
                                    <i class="icon fa fa-bell" aria-hidden="true"></i>Pendientes</a>
                                @if($user->id == $group->user->id)
                                    <hr>
                                    <a class="list-group-item text-center red-600" href="{{ route('group.destroy', $group->id) }}">
                                        Eliminar
                                    </a>
                                    <a class="list-group-item text-center blue-600" href="" data-target="#editGroupForm" data-toggle="modal">
                                        Editar
                                    </a>
                                @endif
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-main">

            <div class="tab-content pt-20">

                <div class="col-lg-12 panel-group-alert">
                    <!-- Example Panel Alert -->
                    <div class="panel" id="examplePanelToolbar">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ $group->name }}</h3>
                            <div class="panel-actions">
                                <a class="panel-action icon wb-close" data-toggle="panel-close" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="alert alert-primary alert-dismissible" role="alert">
                            <p>{!! $group->description !!}</p>
                        </div>
                    </div>
                    <!-- End Example Panel Alert -->
                </div>

                <div class="tab-pane active" id="exampleTabsOne" role="tabpanel">
                    @include('group.ranking')
                </div>
                <div class="tab-pane" id="exampleTabsThree" role="tabpanel">
                    @include('group.messages')
                </div>
                <div class="tab-pane" id="exampleTabsFour" role="tabpanel">
                    @include('group.pending')
                </div>
            </div>
        </div>
    </div>

    <button class="site-action btn-raised btn btn-success btn-floating" data-target="#addPlayerForm"
            data-toggle="modal" type="button">
        <i class="icon wb-plus" aria-hidden="true"></i>
    </button>

    <!-- Add Topic Form -->
    <div class="modal fade" id="addPlayerForm" aria-hidden="true" aria-labelledby="addTopicForm"
         role="dialog" tabindex="-1">
        <div class="modal-dialog modal-simple">
            <div class="modal-content">
                <form method="post" action="{{ route('group.storeInvitations') }}">
                    <div class="modal-header">
                        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
                        <h4 class="modal-title">Invitar Participantes</h4>
                    </div>
                    <div class="modal-body container-fluid">
                        <div class="form-group">
                            <label class="form-control-label mb-15">Participantes:</label>
                            <select required name="users[]" class="form-control" multiple data-plugin="select2" data-minimum-input-length="2" data-max-option="15">
                                @foreach($users as $userGroup)
                                    <option value="{{ $userGroup->id }}">{{ $userGroup->email }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer text-left">
                        <input type="hidden" name="group_id" value="{{ $group->id }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button class="btn btn-primary" type="submit">Invitar</button>
                        <a class="btn btn-primary btn-danger" data-dismiss="modal" href="javascript:void(0)">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Group Form -->
    <div class="modal fade" id="editGroupForm" aria-hidden="true" aria-labelledby="editGroupForm"
         role="dialog" tabindex="-1">
        <div class="modal-dialog modal-simple">
            <div class="modal-content">
                <form method="post" action="{{ route('group.update') }}">
                    <div class="modal-header">
                        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
                        <h4 class="modal-title">Editar {{ $group->name }}</h4>
                    </div>
                    <div class="modal-body container-fluid">
                        <div class="form-group">
                            <label class="form-control-label mb-15" for="topicTitle">Nombre:</label>
                            <input type="text" class="form-control" id="topicTitle" name="name" value="{{ $group->name }}" placeholder="Shelerino Cup..."/>
                        </div>
                        <div class="form-group">
                            <textarea name="description" data-provide="markdown" data-iconlibrary="fa" rows="10">{{ $group->description }}
                            </textarea>
                        </div>
                    </div>
                    <div class="modal-footer text-left">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="group_id" value="{{ $group->id }}">
                        <button class="btn btn-primary" type="submit">Editar</button>
                        <a class="btn btn-primary btn-danger" data-dismiss="modal" href="javascript:void(0)">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js-plugins')
    <script src="{{ URL::to('global/vendor/select2/select2.full.min.js') }}"></script>
    <script src="{{ URL::to('global/vendor/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ URL::to('global/vendor/bootstrap-markdown/bootstrap-markdown.js') }}"></script>
@endsection

@section('js-page')
    <script src="{{ URL::to('global/js/Plugin/select2.js') }}"></script>
    <script src="{{ URL::to('global/js/Plugin/bootstrap-select.js') }}"></script>
    <script src="{{ URL::to('global/js/Plugin/responsive-tabs.js') }}"></script>
    <script src="{{ URL::to('global/js/Plugin/closeable-tabs.js') }}"></script>
    <script src="{{ URL::to('global/js/Plugin/panel.js') }}"></script>
    <script src="{{ URL::to('global/js/Plugin/tabs.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
    <script>
        var monkeyList = new List('test-list', {
            valueNames: ['name']
        });
    </script>
@endsection