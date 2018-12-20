<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap admin template">
    <meta name="author" content="">
    <meta name="_token" content="{{ csrf_token() }}" />

    <title>La MasterLeague | {{$view_name}}</title>

    <link rel="apple-touch-icon" href="{{ URL::to('img/logo.png') }}">
    <link rel="shortcut icon" href="{{ URL::to('img/logo.png') }}">

    @include('layouts.includes.css')

</head>
<body class="animsition @yield('body-class')">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

@include('layouts.includes.header')

@if(Auth::user()->admin)
    @include('layouts.includes.menuAdmin')
@elseif(Auth::user()->admin == 0)
    @include('layouts.includes.menu')
@endif

@yield('main')

@include('layouts.includes.footer')
@include('layouts.includes.js')
@include('layouts.includes.info')

</body>
</html>