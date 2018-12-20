<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap admin template">
    <meta name="author" content="">

    <title>Login | La MasterLeague</title>

    <link rel="apple-touch-icon" href="{{ URL::to('img/logo.png') }}">
    <link rel="shortcut icon" href="{{ URL::to('img/logo.png') }}">

    @section('css-plugins')
        <link rel="stylesheet" href="{{ URL::to('global/vendor/bootstrap-social/bootstrap-social.css') }}">
        <link rel="stylesheet" href="{{ URL::to('assets/examples/css/pages/login-v2.css') }}">
        <link rel="stylesheet" href="{{ URL::to('global/vendor/bootstrap-social/assets/css/font-awesome.css') }}">
    @endsection

    @include('login.includes.css')

</head>
<body class="animsition page-login-v2 layout-full page-dark">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<style>
    body {
        background: transparent;
    }
</style>

<!-- Page -->
<div class="page" data-animsition-in="fade-in" data-animsition-out="fade-out">
    <div class="page-content">
        <div class="page-brand-info">
            <div class="brand">
                <img class="brand-img" src="{{ URL::to('img/logo.png') }}" alt="...">
                <h2 class="brand-text font-size-40">La MasterLeague</h2>
            </div>
            <p class="font-size-16">Regístrate e intenta predecir los resultados de las competiciones más importantes
                del deporte más hermoso del mundo. Invita a tus amigos, familiares, compañeros de trabajo y demuestra
                “quién es el que más sabe”<br><br>
                <strong>¡Juegue!</strong>
            </p>
        </div>

        <div class="page-login-main animation-slide-right animation-duration-1">
            <div class="brand hidden-md-up">
                <img class="brand-img" src="{{ URL::to('img/logo.png') }}" alt="...">
                <h3 class="brand-text font-size-40">La MasterLeague</h3>
            </div>
            <h3 class="font-size-24">Ingresar</h3>
            <p>Ingresa a la MasterLeague!.</p>

            <form method="get" action="{{ route('validateLogin') }}">
                <div class="form-group">
                    <label class="sr-only" for="inputEmail">Email</label>
                    <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <label class="sr-only" for="inputPassword">Password</label>
                    <input type="password" class="form-control" id="inputPassword" name="password"
                           placeholder="Password">
                </div>
                <div class="form-group clearfix">
                    <div class="checkbox-custom checkbox-inline checkbox-primary float-left">
                        <input type="checkbox" id="rememberMe" name="rememberMe">
                        <label for="rememberMe">Recordarme</label>
                    </div>
                    <a class="float-right" href="{{ route('password.request') }}">Olvidaste tu contraseña?</a>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
            </form>

            <p>No tienes cuenta? <a href="{{ route('register') }}">Registrate</a></p>

            <footer class="page-copyright">
                <p>WEBSITE creado por <a>EnZo</a></p>
                <p>© 2018. Todos los derechos reservados.</p>
                <a class="btn btn-social-icon btn-twitter">
                    <span style="color: #ffffff" class="fa fa-twitter"></span>
                </a>
                <a class="btn btn-social-icon btn-facebook" href="{{ route('social.auth', 'facebook') }}">
                    <span style="color: #ffffff" class="fa fa-facebook"></span>
                </a>
                <a class="btn btn-social-icon btn-google" href="{{ route('social.auth', 'google') }}">
                    <span style="color: #ffffff" class="fa fa-google"></span>
                </a>
            </footer>
        </div>

    </div>
</div>
<!-- End Page -->
@include('login.includes.modal-forgotPassword')

@include('login.includes.js')
@include('layouts.includes.info')

</body>
</html>
