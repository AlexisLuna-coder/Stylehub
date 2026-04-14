<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=" {{ asset('css/registerU.css') }}"> <!-- LLAMADA A CSS DEL LOGIN -->
    <link rel="icon" type="image/jpg" href="{{ asset('/img/favicon.ico') }}"/>
    <title>Registro</title>
</head>
<body>
    @extends('layouts.app')
    @section('content')

    <!-- <h1>Registrar nuevo usuario</h1> -->
    @include('partials.alerts')
    <div class="register-wrapper">
        <!-- IMAGEN PLAYERA -->
        <div class="shirt-side">
            <img src="{{ asset('/img/PlayeraRegister.png') }}" class="shirt-img">
        </div>
        <!-- FORMULARIO -->
        <div class="register-container">
            <h1>Registro de usuario</h1>
            @include('partials.alerts')
            <form action="{{ route('registro.store') }}" method="POST">
                @csrf
                <div class="input-group">
                    <span><i class="fa-solid fa-user"></i></span>
                    <input type="text" name="name" placeholder="Nombre completo" required>
                </div>

                <div class="input-group">
                    <span><i class="fa-solid fa-user"></i></span>
                    <input type="text" name="apellido" placeholder="Apellido" required>
                </div>

                <div class="input-group">
                    <span><i class="fa-solid fa-user"></i></span>
                    <input type="text" name="materno" placeholder="Apellido materno" required>
                </div>

                <div class="input-group">
                    <span><i class="fa-solid fa-phone"></i></span>
                    <input type="text" name="telefono" placeholder="777-000-0000" required>
                </div>

                <div class="input-group">
                    <span><i class="fa-solid fa-at"></i></span>
                    <input type="email" name="email" placeholder="Correo electrónico" required>
                </div>

                <div class="input-group">
                    <span><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password" placeholder="Contraseña" required>
                </div>

                <div class="input-group">
                    <span><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" required>
                </div>

                <div class="input-group">
                    <span><i class="fa-solid fa-house"></i></span>
                    <input type="text" name="direccion" placeholder="Dirección" required>
                </div>

                <button type="submit" class="btn-main">
                    Crear cuenta
                </button>

                <p>
                    ¿Ya tienes cuenta?
                    <a href="{{ route('acceso') }}">Iniciar sesión</a>
                </p>
            </form>
        </div>
    </div>
    @endsection
</body>
</html>