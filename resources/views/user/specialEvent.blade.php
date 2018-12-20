@if(\Illuminate\Support\Facades\Auth::user()->id == "12")
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

    <!-- Plugins -->
    <link rel="stylesheet" href="{!! url('') !!}/global/vendor/animsition/animsition.css">
    <link rel="stylesheet" href="{!! url('') !!}/global/vendor/asscrollable/asScrollable.css">
    <link rel="stylesheet" href="{!! url('') !!}/global/vendor/switchery/switchery.css">
    <link rel="stylesheet" href="{!! url('') !!}/global/vendor/intro-js/introjs.css">
    <link rel="stylesheet" href="{!! url('') !!}/global/vendor/slidepanel/slidePanel.css">
    <link rel="stylesheet" href="{!! url('') !!}/global/vendor/flag-icon-css/flag-icon.css">
    <link rel="stylesheet" href="{!! url('') !!}/assets/examples/css/pages/errors.css">


    <!-- Fonts -->
    <link rel="stylesheet" href="{!! url('') !!}/global/fonts/web-icons/web-icons.min.css">
    <link rel="stylesheet" href="{!! url('') !!}/global/fonts/brand-icons/brand-icons.min.css">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

    <style>
        .page-error header h1 {
            font-size: 5em;
            font-weight: 200;
        }
    </style>

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
{{ $user->unlock(new \App\Achievements\SpecialEvent1()) }}
<body class="animsition page-error page-error-400 layout-full">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->


<!-- Page -->
<div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">
    <div class="page-content vertical-align-middle">
        <header>
            <h1 class="animation-slide-top">Felicitaciones</h1>
            <div class="card-block">
                <a class="avatar avatar-lg" style="width: 100px;" data-target="#exampleNiftyFadeScale" data-toggle="modal">
                    <img src="{!! url('') !!}/img/avatars/avatar23.png" alt="...">
                </a>
            </div>
        </header>
        <p class="error-advise">HAS GANADO UN EVENTO ESPECIAL!</p>
        <a class="btn btn-primary btn-round" href="{{ route('home') }}">VOLVER AL INICIO</a>

        <footer class="page-copyright">
            <p>WEBSITE creado por <a href="">EnZo</a></p>
            <p>© 2018. Todos los derechos reservados.</p>
            <div class="social">
                <a class="btn btn-icon btn-pure" href="javascript:void(0)">
                    <i class="icon bd-twitter" aria-hidden="true"></i>
                </a>
                <a class="btn btn-icon btn-pure" href="javascript:void(0)">
                    <i class="icon bd-facebook" aria-hidden="true"></i>
                </a>
                <a class="btn btn-icon btn-pure" href="javascript:void(0)">
                    <i class="icon bd-dribbble" aria-hidden="true"></i>
                </a>
            </div>
        </footer>
    </div>
</div>
<!-- End Page -->


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

<script>
    (function(document, window, $){
        'use strict';

        var Site = window.Site;
        $(document).ready(function(){
            Site.run();
        });
    })(document, window, jQuery);
</script>
</body>
</html>
@else

@endif
