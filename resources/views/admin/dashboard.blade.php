<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="{{ asset('/img/favicon.ico') }}"/>
    <link rel="stylesheet" href="{{ asset('css/dashboard_admin.css') }}"> <!--AQUÍ INCLUIMOS EN CSS -->
    <title>Administrador</title>
</head>
<body>
    @extends('layouts.app')
    @section('content') 
    <div class="container mt-4">
        <div class="logo-container">
            <img src="{{ asset('img/logo2-vestido-SF.png') }}" alt="Logo de Stylehub">
            <h2 class="logo">Stylehub</h2>
        </div>

        <h1>Panel del Administrador</h1>
        @include('partials.alerts')

        @auth
            @if(auth()->user()->is_Admin)
                
                <hr>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3>Gestión de Usuarios (General)</h3>
                    <div class="btn-group">
                        <a href="{{ route('registro') }}" class="btn btn-outline-dark me-2">
                            <i class="fa-solid fa-user-plus"></i> Nuevo Usuario
                        </a>
                        <a href="{{ route('Productos.index') }}" class="btn btn-outline-dark me-2">
                            Volver a Productos
                        </a>
                        <a href="{{ route('Ordenes.index') }}" class="btn btn-outline-dark me-2">
                            Ir a ventas
                        </a>
                        <a href="{{ route('home') }}" class="btn btn-outline-dark me-2">
                            Inicio
                        </a>
                        <form action=" {{ route('cerrar') }}" method="POST"> 
                            @csrf 
                            <button class="btn btn-outline-danger me-3"> 
                                <i class="fa-solid fa-arrow-right-from-bracket"></i> Cerrar sesión 
                            </button> 
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre Completo</th>
                                <th>Email</th>
                                <th>Tipo</th>
                                <th>Admin</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $us)
                            <tr>
                                <td>{{ $us->id }}</td>
                                <td><strong>{{ $us->name }} {{ $us->apellido }}</strong></td>
                                <td>{{ $us->email }}</td>
                                <td>
                                    @if($us->user_Type == 'gerente')
                                        <span class="badge bg-primary">Gerente</span>
                                    @elseif($us->user_Type == 'trabajador')
                                        <span class="badge bg-warning">Trabajador</span>
                                    @else
                                        <span class="badge bg-secondary">Cliente</span>
                                    @endif
                                </td>
                                <td>
                                    @if($us->is_Admin)
                                        <span class="badge bg-success">SÍ</span>
                                    @else
                                        <span class="badge bg-light text-dark border">No</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('Usuarios.edit',$us) }}" class="btn btn-sm btn-warning me-2">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('Usuarios.destroy', $us) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar usuario?')">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <hr>
                <h3>Usuarios Administrativos (Gerentes / Trabajadores)</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Correo Electrónico</th>
                                <th>Puesto</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Filtramos gerentes y trabajadores --}}
                            @forelse($users->whereIn('user_Type', ['gerente', 'trabajador']) as $admin)
                            <tr>
                                <td>{{ $admin->id }}</td>
                                <td>{{ $admin->name }} {{ $admin->apellido }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>
                                    <span class="badge {{ $admin->user_Type == 'gerente' ? 'bg-primary' : 'bg-warning' }}">
                                        {{ ucfirst($admin->user_Type) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center text-muted">No hay personal administrativo registrado.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <hr>
                <h3>Cartera de Clientes</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Correo Electrónico</th>
                                <th>Dirección</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users->where('user_Type', 'cliente') as $cliente)
                            <tr>
                                <td>{{ $cliente->id }}</td>
                                <td><strong>{{ $cliente->name }} {{ $cliente->apellido }}</strong></td>
                                <td>{{ $cliente->email }}</td>
                                <td>{{ $cliente->direccion ?? 'No registrada' }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center text-muted">No hay clientes registrados en el sistema.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            @endif
        @endauth
    </div>
    @endsection

</body>
</html>