<!-- Stylesheets -->
<link rel="stylesheet" href="{!! url('') !!}/global/css/bootstrap.min.css">
<link rel="stylesheet" href="{!! url('') !!}/global/css/bootstrap-extend.min.css">
<link rel="stylesheet" href="{!! url('') !!}/assets/css/site.min.css">
<link rel="stylesheet" href="{{ URL::to('css/default.css') }}">
@yield('css-stylesheets')

<!-- Plugins -->
<link rel="stylesheet" href="{!! url('') !!}/global/vendor/animsition/animsition.css">
<link rel="stylesheet" href="{!! url('') !!}/global/vendor/asscrollable/asScrollable.css">
<link rel="stylesheet" href="{!! url('') !!}/global/vendor/switchery/switchery.css">
<link rel="stylesheet" href="{!! url('') !!}/global/vendor/intro-js/introjs.css">
<link rel="stylesheet" href="{!! url('') !!}/global/vendor/slidepanel/slidePanel.css">
<link rel="stylesheet" href="{!! url('') !!}/global/vendor/flag-icon-css/flag-icon.css">
<!-- Toastr -->
<link rel="stylesheet" href="{{ URL::to('/global/vendor/toastr/build/toastr.min.css') }}">
@yield('css-plugins')

<!-- Fonts -->
<link rel="stylesheet" href="{!! url('') !!}/global/fonts/font-awesome/font-awesome.css">
<link rel="stylesheet" href="{!! url('') !!}/global/fonts/web-icons/web-icons.min.css">
<link rel="stylesheet" href="{!! url('') !!}/global/fonts/brand-icons/brand-icons.min.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

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