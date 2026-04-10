<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="{{ asset('/img/favicon.ico') }}"/>
    <link rel="stylesheet" href="{{ asset('css/userEdit.css') }}">  <!--AQUÍ VA EL CSS -->
    <title>EDICIÓN DE USUARIOS - Admin</title>
</head>
<body>
    <div class="particles">
        <span></span><span></span><span></span><span></span><span></span>
        <span></span><span></span><span></span><span></span><span></span>
    </div>

    @extends('layouts.app')

    @section('content')
        <div class="user-wrap">
            <div class="logo-container">
                <img src="{{ asset('img/logo2-vestido-SF.png') }}" alt="Logo de Stylehub">
                <h2 class="logo">Stylehub</h2>
            </div>

            <h1>Editar usuario</h1>

            @include('partials.alerts')

            <form action="{{ route('Usuarios.update', $Usuario) }}" method="POST" class="user-form">
                @csrf
                @method('PUT')

                <div class="form-grid">
                    <div class="input-group">
                        <input type="text" name="name" class="form-control" placeholder="Nombre(s)" value="{{ $Usuario->name }}" required>
                    </div>

                    <div class="input-group">
                        <input type="text" name="apellido" class="form-control" placeholder="Apellido Paterno" value="{{ $Usuario->apellido }}" required>
                    </div>

                    <div class="input-group">
                        <input type="text" name="materno" class="form-control" placeholder="Apellido Materno" value="{{ $Usuario->materno }}" required>
                    </div>

                    <div class="input-group">
                        <input type="text" name="telefono" class="form-control" placeholder="Teléfono" value="{{ $Usuario->telefono }}" required>
                    </div>
                </div>

                <div class="input-group full-width">
                    <input type="email" name="email" class="form-control" placeholder="Correo Electrónico" value="{{ $Usuario->email }}" required>
                </div>

                <div class="input-group full-width">
                    <input type="password" name="password" class="form-control" placeholder="Nueva contraseña (opcional)">
                </div>

                <div class="input-group full-width">
                    <input type="text" name="direccion" class="form-control" placeholder="Dirección Completa" value="{{ $Usuario->direccion }}" required>
                </div>

                <div class="form-grid bottom-grid">
                    <div class="input-group">
                        <select name="user_Type" class="form-control" required>
                            <option value="cliente" {{ $Usuario->user_Type == 'cliente' ? 'selected' : '' }}>Cliente</option>
                            <option value="gerente" {{ $Usuario->user_Type == 'gerente' ? 'selected' : '' }}>Gerente</option>
                            <option value="trabajador" {{ $Usuario->user_Type == 'trabajador' ? 'selected' : '' }}>Trabajador</option>
                        </select>
                    </div>

                    <div class="form-check d-flex align-items-center justify-content-center">
                        <input class="form-check-input" type="checkbox" name="is_Admin" id="isAdminCheck" value="1" {{ $Usuario->is_Admin ? 'checked' : '' }}>
                        <label class="form-check-label" for="isAdminCheck">¿Es Administrador?</label>
                    </div>
                </div>

                <div class="form-grid buttons-grid">
                    <a href="{{ route('Usuarios.index') }}" class="btn btn-dark">Regresar</a>
                    <button type="submit" class="btn btn-success">Actualizar</button>
                </div>

            </form>
        </div>
    @endsection
</body>
</html>