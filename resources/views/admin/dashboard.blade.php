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

    @auth
    @if(auth()->user()->is_Admin)

    <hr>

    <h3>Gestión de usuarios (General)</h3>

    <a href="{{ route('registro') }}" class="btn btn-outline-dark mb-3">
        Registrar nuevo usuario
    </a>

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
            <th>Tipo</th>
            <th>Admin</th>
            <th>Acciones</th>
        </tr>
        </thead>

        <tbody>
            @foreach($users as $us)
            <tr>
                <td>{{ $us->id }}</td>
                <td>{{ $us->name }}</td>
                <td>{{ $us->apellido }}</td>
                <td>{{ $us->materno }}</td>
                <td>{{ $us->telefono }}</td>
                <td>{{ $us->email }}</td>
                <td>{{ $us->direccion }}</td>

                <!-- TIPO DE USUARIO -->
                <td>
                    @if($us->user_Type == 'gerente')
                        <span class="badge bg-primary">Gerente</span>
                    @elseif($us->user_Type == 'trabajador')
                        <span class="badge bg-warning">Trabajador</span>
                    @else
                        <span class="badge bg-secondary">Cliente</span>
                    @endif
                </td>

                <!-- ADMIN -->
                <td>
                    @if($us->is_Admin)
                        <span class="badge bg-success">Admin</span>
                    @else
                        <span class="badge bg-secondary">Usuario</span>
                    @endif
                </td>

                <!-- ACCIONES -->
                <td>
                    <a href="{{ route('Usuarios.edit',$us) }}">
                        <button class="btn btn-warning">
                            <i class="fa-solid fa-pen-to-square"></i> Editar
                        </button>
                    </a>

                    <form action="{{ route('Usuarios.destroy', $us) }}" method="POST" class="d-inline">
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

    <!-- aquí estará la tabla donde se muestren tdos los trabajadores/empleados/gerentes que tiene la tienda ( permitirá al admin ver a sus trabajadores y sus datos )-->
    <hr>
    <h3>Usuarios administrativos (Gerentes / Trabajadores)</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Tipo</th>
            </tr>
        </thead>

        <tbody>
            @if($gerentes->isEmpty() && $trabajadores->isEmpty() || $trabajadores->count() < 0 && $gerentes->count() < 0)
                <tr>
                    <td colspan="4" class="text-center">
                        No se cuenta con usuarios administrativos o empleados
                    </td>
                </tr>
            @endif

            @foreach($gerentes as $us)
            <tr>
                <td>{{ $us->id }}</td>
                <td>{{ $us->name }}</td>
                <td>{{ $us->email }}</td>
                <td><span class="badge bg-primary">Gerente</span></td>
            </tr>
            @endforeach

            @foreach($trabajadores as $us)
            <tr>
                <td>{{ $us->id }}</td>
                <td>{{ $us->name }}</td>
                <td>{{ $us->email }}</td>
                <td><span class="badge bg-warning">Trabajador</span></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!--AQquí estarán los usuarios que son clientes ( permitirá al admin ver a sus clientes y sus datos )-->
    <hr>
    <h3>Usuarios clientes</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
            </tr>
        </thead>

        <tbody>
            @if($clientes->isEmpty() || $clientes->count() < 0)
                <tr>
                    <td colspan="4" class="text-center">
                        No se cuenta con usuarios administrativos
                    </td>
                </tr>
            @endif

            @foreach($clientes as $us)
            <tr>
                <td>{{ $us->id }}</td>
                <td>{{ $us->name }}</td>
                <td>{{ $us->email }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @endif
    @endauth

    <a href="{{ route('Productos.index') }}">
        <button type="button" class="btn btn-outline-dark">
            Volver a productos
        </button>
    </a>

    @endsection

</body>
</html>