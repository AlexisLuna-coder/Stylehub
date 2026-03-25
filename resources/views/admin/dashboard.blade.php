<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
</head>
<body>
    @extends('layouts.app')
    @section('content') 
        <h1> Panel del administrador </h1>
        @include('partials.alerts')

        <!--ADMINISTRADOR-->
        @auth
        @if(auth()->user()->is_Admin)

        <hr>

        <h3>Gestión de usuarios</h3>

        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Materno</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Dirección</th>
                <th>Admin</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->apellido }}</td>
                <td>{{ $user->materno }}</td>
                <td>{{ $user->telefono }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->direccion }}</td>
                <td>
                    @if($user->is_Admin)
                        <span class="badge bg-success">Admin</span>
                    @else
                        <span class="badge bg-secondary">Usuario</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('Usuarios.edit',$user) }}">
                        <button class="btn btn-warning">
                            <i class="fa-solid fa-pen-to-square"></i> Editar
                        </button>
                    </a>
                    <form action="{{ route('Usuarios.destroy',$user) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button 
                        class="btn btn-danger"
                        onclick="return confirm('¿Eliminar el usuario?')">
                            <i class="fa-solid fa-trash"></i> Eliminar
                        </button>
                    </form>
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
        @endauth
        <!--ADMINISTRADOS-->
    @endsection
</body>
</html>