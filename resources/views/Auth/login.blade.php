<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- FORMA DE LLAMAR RECURSOS DESDE LARAVEL -->
    <link rel="stylesheet" href=" {{ asset('css/login.css') }}"> <!-- LLAMADA A CSS DEL LOGIN -->
    <title>Inicio de sesión</title>
</head>
<body>
    @extends('layouts.app')
    @section('content')
        <div class="login-wrapper">
            <div class="particles">
                <span></span><span></span><span></span><span></span><span></span>
                <span></span><span></span><span></span><span></span><span></span>
            </div>

            <div class="login-container">
                <img src="{{ asset('img/logo-vestido-SF.png') }}" class="logo">

                <h1>INICIO DE SESIÓN</h1>
                @include('partials.alerts')
                <form action="{{ route('acceso.store') }}" method="POST">
                    @csrf
                    <input type="email" name="email" placeholder="Correo electrónico" required>
                    <input type="password" name="password" placeholder="Contraseña" required>
                    <button type="submit">Iniciar sesión</button>
                </form>
                <p>¿No tienes cuenta? 
                    <a href="{{ route('registro') }}">Regístrate aquí</a>
                </p>
            </div>
        </div>
    @endsection
</body>
</html>
