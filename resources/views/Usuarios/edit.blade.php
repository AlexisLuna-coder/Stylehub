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

    <form action="{{ route('Usuarios.update', $Usuario) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="input-group mb-3">
            <input type="text" name="name" class="form-control"
            value="{{ $Usuario->name }}" required>
        </div>

        <div class="input-group mb-3">
            <input type="text" name="apellido" class="form-control"
            value="{{ $Usuario->apellido }}" required>
        </div>

        <div class="input-group mb-3">
            <input type="text" name="materno" class="form-control"
            value="{{ $Usuario->materno }}" required>
        </div>

        <div class="input-group mb-3">
            <input type="text" name="telefono" class="form-control"
            value="{{ $Usuario->telefono }}" required>
        </div>

        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control"
            value="{{ $Usuario->email }}" required>
        </div>

        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control"
            placeholder="Nueva contraseña (opcional)">
        </div>

        <div class="input-group mb-3">
            <input type="text" name="direccion" class="form-control"
            value="{{ $Usuario->direccion }}" required>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input"
                type="checkbox"
                name="is_Admin"
                value="1"
                {{ $Usuario->is_Admin ? 'checked' : '' }}>
            <label>Es administrador</label>
        </div>

        <button type="submit" class="btn btn-success">
            Actualizar
        </button>

        <a href="{{ route('Usuarios.index') }}" class="btn btn-dark">
            Regresar
        </a>

    </form>

    @endsection
</body>
</html>