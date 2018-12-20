
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap admin template">
    <meta name="author" content="">

    <title>La MasterLeague | {{$view_name}}</title>

    <link rel="apple-touch-icon" href="{{ URL::to('img/logo.png') }}">
    <link rel="shortcut icon" href="{{ URL::to('img/logo.png') }}">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{!! url('') !!}/global/css/bootstrap.min.css">
    <link rel="stylesheet" href="{!! url('') !!}/global/css/bootstrap-extend.min.css">
    <link rel="stylesheet" href="{!! url('') !!}/assets/css/site.min.css">
    <link rel="stylesheet" href="{{ URL::to('css/default.css') }}">

    <!-- Plugins -->
    <link rel="stylesheet" href="{!! url('') !!}/global/vendor/animsition/animsition.css">
    <link rel="stylesheet" href="{!! url('') !!}/global/vendor/asscrollable/asScrollable.css">
    <link rel="stylesheet" href="{!! url('') !!}/global/vendor/switchery/switchery.css">
    <link rel="stylesheet" href="{!! url('') !!}/global/vendor/intro-js/introjs.css">
    <link rel="stylesheet" href="{!! url('') !!}/global/vendor/slidepanel/slidePanel.css">
    <link rel="stylesheet" href="{!! url('') !!}/global/vendor/flag-icon-css/flag-icon.css">
    <link rel="stylesheet" href="{!! url('') !!}/global/vendor/select2/select2.css">
    <link rel="stylesheet" href="{!! url('') !!}/global/vendor/bootstrap-markdown/bootstrap-markdown.css">
    <link rel="stylesheet" href="{!! url('') !!}/global/vendor/bootstrap-select/bootstrap-select.css">
    <link rel="stylesheet" href="{!! url('') !!}/assets/examples/css/apps/forum.css">

    <!-- Toastr -->
    <link rel="stylesheet" href="{{ URL::to('/global/vendor/toastr/build/toastr.min.css') }}">

    <!-- Fonts -->
    <link rel="stylesheet" href="{!! url('') !!}/global/fonts/font-awesome/font-awesome.css">
    <link rel="stylesheet" href="{!! url('') !!}/global/fonts/web-icons/web-icons.min.css">
    <link rel="stylesheet" href="{!! url('') !!}/global/fonts/brand-icons/brand-icons.min.css">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

    <!--[if lt IE 9]>
    <script src="{!! url('') !!}/global/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->

    <!--[if lt IE 10]>
    <script src="{!! url('') !!}/global/vendor/media-match/media.match.min.js"></script>
    <script src="{!! url('') !!}/global/vendor/respond/respond.min.js"></script>
    <![endif]-->

    <!-- Scripts -->
    <script src="{!! url('') !!}/global/vendor/breakpoints/breakpoints.js"></script>
    <script>
        Breakpoints();
    </script>
</head>
<body class="animsition app-forum page-aside-left">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

@include('layouts.includes.header')
@include('layouts.includes.menu')

<!-- Page -->
<div class="page bg-white" id="test-list">

    @include('forum.includes.sidebar')

    <div class="page-main">

        <!-- Forum Content Header -->
        <div class="page-header">
            <form class="mt-20" action="#" role="search">
                <div class="input-search input-search-dark">
                    <input type="text" class="form-control w-full search" placeholder="Buscar..." name="">
                    <button type="submit" class="input-search-btn">
                        <i class="icon wb-search" aria-hidden="true"></i>
                    </button>
                </div>
            </form>
        </div>

        <!-- Forum Nav -->
        <div class="page-nav-tabs">
            <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="active nav-link" data-toggle="tab" href="#forum-newest" aria-controls="forum-newest"
                       aria-expanded="true" role="tab">Todos</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-toggle="tab" href="#forum-activity" aria-controls="forum-activity"
                       aria-expanded="false" role="tab">Nuevos</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-toggle="tab" href="#forum-answer" aria-controls="forum-answer"
                       aria-expanded="false" role="tab">Antiguos</a>
                </li>
            </ul>
        </div>

        <!-- Forum Content -->
        <div class="page-content tab-content page-content-table nav-tabs-animate">
            <div class="tab-panel animation-fade active" id="forum-newest" role="tabpanel">
                <table class="table is-indent">
                    <tbody class="list">
                    @foreach($topics as $topic)
                        <tr data-url="{{ route('forum.slidePanel', $topic->id) }}" data-toggle="slidePanel" >
                            <td class="pre-cell"></td>
                            <td class="cell-60 responsive-hide">
                                <a class="avatar" href="javascript:void(0)">
                                    <img class="img-fluid" src="{{ URL::to('img/avatars') }}/{{ $topic->user->avatar->img }}" alt="...">
                                </a>
                            </td>
                            <td>
                                <div class="content">
                                    <div class="title">
                                        <span class="topic">{{ $topic->title }}</span>
                                        <div class="flags responsive-hide">
                                            @if(!$topic->active)
                                                <i class="locked icon wb-lock" aria-hidden="true"></i>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="metas">
                                        <span class="author">{{ $topic->user->name }}</span>
                                        <span class="started">{{ date('d-m-Y', strtotime($topic->created_at)) }}</span>
                                        <span class="category" style="display: none">{{ $topic->category }}</span>
                                    </div>
                                    <div class="metas">
                                        <span class="category"><strong style="color: {{ colorCategory($topic->category) }}">{{ $topic->category }}</strong></span>
                                    </div>
                                </div>
                            </td>
                            <td class="cell-80 forum-posts">
                                <span>
                                    <i class="icon wb-inbox" aria-hidden="true"></i>
                                    <span class="badge badge-pill up badge-primary">{{ $topic->replies->count() }}</span>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<button class="site-action btn-raised btn btn-success btn-floating" data-target="#addTopicForm"
        data-toggle="modal" type="button">
    <i class="icon wb-pencil" aria-hidden="true"></i>
</button>

<!-- Add Topic Form -->
<div class="modal fade" id="addTopicForm" aria-hidden="true" aria-labelledby="addTopicForm"
     role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple">
        <div class="modal-content">
            <form method="post" action="{{ route('topic.store') }}">
                <div class="modal-header">
                    <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Crear Nuevo Tema</h4>
                </div>
                <div class="modal-body container-fluid">
                    <div class="form-group">
                        <label class="form-control-label mb-15" for="topicTitle">Título:</label>
                        <input type="text" class="form-control" id="topicTitle" name="title" placeholder="Cómo hacer..."/>
                    </div>
                    <div class="form-group">
                        <textarea name="content" data-provide="markdown" data-iconlibrary="fa" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="form-control-label mb-15" for="topicCategory">Categoría:</label>
                                <select name="category" id="topicCategory" data-plugin="selectpicker">
                                    <option value="General">General</option>
                                    <option value="Apuestas">Apuestas</option>
                                    <option value="Resultados">Resultados</option>
                                    <option value="Puntos">Puntos</option>
                                    <option value="Problemas">Problemas</option>
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
<!-- End Page -->

@include('layouts.includes.footer')

<!-- Core  -->
<script src="{!! url('') !!}/global/vendor/babel-external-helpers/babel-external-helpers.js"></script>
<script src="{!! url('') !!}/global/vendor/jquery/jquery.js"></script>
<script src="{!! url('') !!}/global/vendor/popper-js/umd/popper.min.js"></script>
<script src="{!! url('') !!}/global/vendor/bootstrap/bootstrap.js"></script>
<script src="{!! url('') !!}/global/vendor/animsition/animsition.js"></script>
<script src="{!! url('') !!}/global/vendor/mousewheel/jquery.mousewheel.js"></script>
<script src="{!! url('') !!}/global/vendor/asscrollbar/jquery-asScrollbar.js"></script>
<script src="{!! url('') !!}/global/vendor/asscrollable/jquery-asScrollable.js"></script>
<script src="{!! url('') !!}/global/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>

<!-- Plugins -->
<script src="{!! url('') !!}/global/vendor/switchery/switchery.js"></script>
<script src="{!! url('') !!}/global/vendor/intro-js/intro.js"></script>
<script src="{!! url('') !!}/global/vendor/screenfull/screenfull.js"></script>
<script src="{!! url('') !!}/global/vendor/slidepanel/jquery-slidePanel.js"></script>
<script src="{!! url('') !!}/global/vendor/slidepanel/jquery-slidePanel.js"></script>
<script src="{!! url('') !!}/global/vendor/bootstrap-markdown/bootstrap-markdown.js"></script>
<script src="{!! url('') !!}/global/vendor/bootstrap-select/bootstrap-select.js"></script>
<script src="{!! url('') !!}/global/vendor/marked/marked.js"></script>
<script src="{!! url('') !!}/global/vendor/to-markdown/to-markdown.js"></script>

<!-- Toastr -->
<script src="{{ URL::to('/global/vendor/toastr/build/toastr.min.js') }}"></script>

<!-- Scripts -->
<script src="{!! url('') !!}/global/js/Component.js"></script>
<script src="{!! url('') !!}/global/js/Plugin.js"></script>
<script src="{!! url('') !!}/global/js/Base.js"></script>
<script src="{!! url('') !!}/global/js/Config.js"></script>

<script src="{!! url('') !!}/assets/js/Section/Menubar.js"></script>
<script src="{!! url('') !!}/assets/js/Section/GridMenu.js"></script>
<script src="{!! url('') !!}/assets/js/Section/Sidebar.js"></script>
<script src="{!! url('') !!}/assets/js/Section/PageAside.js"></script>
<script src="{!! url('') !!}/assets/js/Plugin/menu.js"></script>

<script src="{!! url('') !!}/global/js/config/colors.js"></script>
<script src="{!! url('') !!}/assets/js/config/tour.js"></script>
<script>Config.set('assets', '{!! url('') !!}/assets');</script>

<!-- Page -->
<script src="{!! url('') !!}/assets/js/Site.js"></script>
<script src="{!! url('') !!}/global/js/Plugin/asscrollable.js"></script>
<script src="{!! url('') !!}/global/js/Plugin/slidepanel.js"></script>
<script src="{!! url('') !!}/global/js/Plugin/switchery.js"></script>
<script src="{!! url('') !!}/global/js/Plugin/bootstrap-select.js"></script>
<script src="{!! url('') !!}/assets/js/BaseApp.js"></script>
<script src="{!! url('') !!}/assets/js/App/Forum.js"></script>

<script src="{!! url('') !!}/assets/examples/js/apps/forum.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>

<script>
    var options = {
        valueNames: ['category', 'topic', 'author'],
        page: 3,
        pagination: true
    };

    var userList = new List('test-list', options);
</script>

@include('layouts.includes.info')

</body>
</html>
