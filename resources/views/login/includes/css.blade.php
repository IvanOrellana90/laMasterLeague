<!-- Stylesheets -->
<link rel="stylesheet" href="{{ URL::to('global/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::to('global/css/bootstrap-extend.min.css') }}">
<link rel="stylesheet" href="{{ URL::to('assets/css/site.min.css') }}">
@yield('css-stylesheets')

<!-- Plugins -->
<link rel="stylesheet" href="{{ URL::to('global/vendor/animsition/animsition.css') }}">
<link rel="stylesheet" href="{{ URL::to('global/vendor/asscrollable/asScrollable.css') }}">
<link rel="stylesheet" href="{{ URL::to('global/vendor/switchery/switchery.css') }}">
<link rel="stylesheet" href="{{ URL::to('global/vendor/intro-js/introjs.css') }}">
<link rel="stylesheet" href="{{ URL::to('global/vendor/slidepanel/slidePanel.css') }}">
<link rel="stylesheet" href="{{ URL::to('global/vendor/flag-icon-css/flag-icon.css') }}">
<!-- Toastr -->
<link rel="stylesheet" href="{{ URL::to('global/vendor/toastr/build/toastr.min.css') }}">
@yield('css-plugins')

<!-- Fonts -->
<link rel="stylesheet" href="{{ URL::to('global/fonts/web-icons/web-icons.min.css') }}">
<link rel="stylesheet" href="{{ URL::to('global/fonts/brand-icons/brand-icons.min.css') }}">
<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

<!--[if lt IE 9]>
<script src="{{ URL::to('global/vendor/html5shiv/html5shiv.min.js') }}"></script>
<![endif]-->

<!--[if lt IE 10]>
<script src="{{ URL::to('global/vendor/media-match/media.match.min.js') }}"></script>
<script src="{{ URL::to('global/vendor/respond/respond.min.js') }}"></script>
<![endif]-->

<!-- Scripts -->
<script src="{{ URL::to('global/vendor/breakpoints/breakpoints.js') }}"></script>
<script>
    Breakpoints();
</script>