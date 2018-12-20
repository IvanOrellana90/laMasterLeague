<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap admin template">
    <meta name="author" content="">

    <title>Registro | La MasterLeague</title>

    <link rel="apple-touch-icon" href="{{ URL::to('img/logo.png') }}">
    <link rel="shortcut icon" href="{{ URL::to('img/logo.png') }}">

    @section('css-plugins')
        <link rel="stylesheet" href="{{ URL::to('assets/examples/css/pages/register-v2.css') }}">
    @endsection

    @include('login.includes.css')

</head>
<body class="animsition page-register-v2 layout-full page-dark">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

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

        <div class="page-register-main animation-slide-left animation-duration-1">
            <div class="brand hidden-md-up">
                <img class="brand-img" src="{{ URL::to('img/logo.png') }}" alt="...">
                <h3 class="brand-text font-size-40">La MasterLeague</h3>
            </div>
            <h3 class="font-size-24">Registrarte</h3>
            <p>Debes registrarte para poder participar en la MasterLeague</p>

            <form method="post" role="form" action="{{ route('user.store') }}">
                <div class="form-group">
                    <label class="sr-only" for="inputName">Nombre Completo</label>
                    <input type="text" class="form-control" id="inputName" name="name" placeholder="Nombre Completo">
                </div>
                <div class="form-group">
                    <label class="sr-only" for="inputEmail">Correo</label>
                    <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Correo">
                </div>
                <div class="form-group">
                    <label class="sr-only" for="inputEmail">Confirmar Correo</label>
                    <input type="email" class="form-control" id="checkEmail" name="email_confirmation" placeholder="Confirmar Correo">
                </div>
                <div class="form-group">
                    <label class="sr-only" for="inputPassword">Password</label>
                    <input type="password" class="form-control" id="inputPassword" name="password"
                           placeholder="Contraseña">
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-primary btn-block">Registrarme</button>
            </form>

            <p>Ya tienes cuenta? <a href="{{ route('login') }}">Ingresar</a></p>

            <footer class="page-copyright">
                <p>WEBSITE creado por <a>EnZo</a></p>
                <p>© 2018. Todos los derechos reservados.</p>
            </footer>
        </div>

    </div>
</div>
<!-- End Page -->

@section('js-page')
    <script src="{{ URL::to('global/js/Plugin/animate-list.js') }}"></script>
@endsection

@include('login.includes.js')
@include('layouts.includes.info')

</body>
</html>