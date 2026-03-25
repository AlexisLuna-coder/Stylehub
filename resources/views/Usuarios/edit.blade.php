<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDICIÓN DE USUARIOS - Admin</title>
</head>
<body>
    @extends('layouts.app')
    @section('content')
    <h1>Editar usuario - Panel Admin</h1>
    @include('partials.alerts')
    <form action="{{ route('Usuarios.update'), $Usuario }}" method="POST"> <!--NOTA. ESTO NO FUNCIONA, NO SE PORQUE-->

    @csrf
    @method('PUT')

    <div class="input-group mb-3">
        <span class="input-group-text">
            <i class="fa-solid fa-user"></i>
        </span>
        <input type="text" name="name" class="form-control"
        value="{{ $user->name }}" placeholder="Nombre" required>
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text">
            <i class="fa-solid fa-user"></i>
        </span>
        <input type="text" name="apellido" class="form-control"
        value="{{ $user->apellido }}" placeholder="Apellido" required>
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text">
            <i class="fa-solid fa-user"></i>
        </span>
        <input type="text" name="materno" class="form-control"
        value="{{ $user->materno }}" placeholder="Apellido materno" required>
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text">
            <i class="fa-solid fa-phone"></i>
        </span>
        <input type="text" name="telefono" class="form-control"
        value="{{ $user->telefono }}" placeholder="Teléfono" required>
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text">
            <i class="fa-solid fa-at"></i>
        </span>
        <input type="email" name="email" class="form-control"
        value="{{ $user->email }}" placeholder="Correo electrónico" required>
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text">
            <i class="fa-solid fa-lock"></i>
        </span>
        <input type="password" name="password" class="form-control"
        placeholder="Nueva contraseña (opcional)">
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text">
            <i class="fa-solid fa-house"></i>
        </span>
        <input type="text" name="direccion" class="form-control"
        value="{{ $user->direccion }}" placeholder="Dirección" required>
    </div>

    <div class="form-check mb-3">
        <input class="form-check-input"
            type="checkbox"
            name="is_Admin"
            value="1"
            id="adminCheck"
            {{ $user->is_Admin ? 'checked' : '' }}>
        <label class="form-check-label" for="adminCheck">
            Es administrador
        </label>
    </div>
    <center>
        <button type="submit" class="btn btn-success">
        <i class="fa-solid fa-floppy-disk"></i> Actualizar
        </button>

        <a href="{{ route('Usuarios.index') }}">
        <button type="button" class="btn btn-outline-dark">
        <i class="fa-solid fa-arrow-left"></i> Regresar
        </button>
        </a>
    </center>
    </form>
    @endsection 
</body>
</html>