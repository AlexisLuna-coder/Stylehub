<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    @extends('layouts.app')
    @section('content')

    <h1>Registrar nuevo usuario</h1>
    @include('partials.alerts')
    <form action="{{ route('registro.store') }}" method="POST">
    @csrf

    <div class="input-group mb-3">
        <span class="input-group-text">
            <i class="fa-solid fa-user"></i>
        </span>
        <input type="text" name="name" placeholder="Nombre" class="form-control" required>
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text">
            <i class="fa-solid fa-user"></i>
        </span>
        <input type="text" name="apellido" placeholder="Apellido" class="form-control" required>
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text">
            <i class="fa-solid fa-user"></i>
        </span>
        <input type="text" name="materno" placeholder="Apellido materno" class="form-control" required>
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text">
            <i class="fa-solid fa-phone"></i>
        </span>
        <input type="text" name="telefono" placeholder="Teléfono" class="form-control" required>
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text">
            <i class="fa-solid fa-at"></i>
        </span>
        <input type="email" name="email" placeholder="Correo electrónico" class="form-control" required>
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text">
            <i class="fa-solid fa-lock"></i>
        </span>
        <input type="password" name="password" placeholder="Contraseña" class="form-control" required>
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text">
            <i class="fa-solid fa-lock"></i>
        </span>
        <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" class="form-control" required>
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text">
            <i class="fa-solid fa-house"></i>
        </span>
        <input type="text" name="direccion" placeholder="Dirección" class="form-control" required>
    </div>

    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="is_Admin" value="1" id="adminCheck">
        <label class="form-check-label" for="adminCheck">
            Es administrador
        </label>
    </div>

    <center>

    <button type="submit" class="btn btn-success">
        <i class="fa-solid fa-floppy-disk"></i> Guardar
    </button>

    <a href="{{ route('acceso') }}">
        <button type="button" class="btn btn-outline-dark">
            Ir a iniciar sesión
        </button>
    </a>

    </center>

    </form>

    @endsection
</body>
</html>