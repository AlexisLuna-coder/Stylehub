<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ORDENES GENERADAS</title>
</head>
<body>
    @extends('layouts.app')

    @section('content')

    <h1><center>GESTIÓN DE ÓRDENES</center></h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('Ordenes.create') }}" class="btn btn-outline-dark me-2">
            <i class="fa-solid fa-plus"></i> Nueva Orden
        </a>

        <a href="{{ route('Productos.index') }}" class="btn btn-outline-secondary">
            Regresar
        </a>
    </div>

    @include('partials.alerts')

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Dirección</th>
                <th>Pago</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($ordenes as $orden)
            <tr>
                <td>{{ $orden->id }}</td>
                <td>{{ $orden->user ? $orden->user->name . ' ' . $orden->user->apellido : 'N/A' }}</td>
                <td>{{ $orden->fecha }}</td>
                <td>${{ $orden->total }}</td>
                <td>
                    <span class="badge bg-info">{{ $orden->estado }}</span>
                </td>
                <td>{{ $orden->direccion_envio }}</td>
                <td>{{ $orden->metodo_pago }}</td>

                <td>
                    <a href="{{ route('Ordenes.edit', $orden) }}" class="btn btn-warning">
                        Editar
                    </a>

                    <form action="{{ route('Ordenes.destroy', $orden) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger"
                            onclick="return confirm('¿Eliminar la orden?')">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @endsection
    
</body>
</html>