<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="{{ asset('/img/favicon.ico') }}"/>
    <link rel="stylesheet" href="{{ asset('css/indexOrdenes.css') }}">
    <title>ÓRDENES GENERADAS - STYLEHUB</title>
</head>
<body>
    @extends('layouts.app')

    @section('content')
        <div class="wrap-orders">
            <div class="logo-container">
                <img src="{{ asset('img/logo2-vestido-SF.png') }}" alt="Logo de Stylehub">
                <h2 class="logo">Stylehub</h2>
            </div>

            <h1><center>GESTIÓN DE ÓRDENES</center></h1>
            <hr>

            <div class="top-bar-container">

                <div class="ganancias-box">
                    <span class="titulo">GANANCIAS TOTALES</span>
                    <span class="monto">${{ number_format($ordenes->sum('total'), 2) }}</span>
                </div>

                <div class="botones-box">
                    <a href="{{ route('Ordenes.create') }}" class="btn btn-outline-dark me-2">
                        <i class="fa-solid fa-plus"></i> Nueva Orden
                    </a>
                    <a href="{{ route('Productos.index') }}" class="btn btn-outline-secondary">
                        <i class="fa-solid fa-boxes-stacked"></i> Ver Productos
                    </a>

                    <a href="{{ route('Usuario.profile') }}" class="btn-acceder">
                        Mi perfil
                    </a>
                </div>

            </div>

            @include('partials.alerts')

            <table class="table table-striped table-hover mt-4">
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
                    @forelse($ordenes as $orden)
                    <tr>
                        <td>#{{ $orden->id }}</td>
                        <td><strong>{{ $orden->user ? $orden->user->name . ' ' . $orden->user->apellido : 'Cliente Invitado' }}</strong></td>
                        <td>{{ \Carbon\Carbon::parse($orden->fecha)->format('d/m/Y') }}</td> 
                        <td class="text-warning fw-bold">${{ number_format($orden->total, 2) }}</td>
                        <td>
                            @if(strtolower($orden->estado) == 'entregado')
                                <span class="badge bg-success">Entregado</span>
                            @elseif(strtolower($orden->estado) == 'cancelado')
                                <span class="badge bg-danger">Cancelado</span>
                            @elseif(strtolower($orden->estado) == 'enviado')
                                <span class="badge bg-primary">Enviado</span>
                            @else
                                <span class="badge bg-warning">Pendiente</span>
                            @endif
                        </td>
                        <td><small>{{ ($orden->direccion_envio) }}</small></td>
                        <td style="text-transform: uppercase;">{{ $orden->metodo_pago }}</td>

                        <td>
                            <a href="{{ route('Ordenes.edit', $orden) }}" class="btn btn-warning">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>

                            <form action="{{ route('Ordenes.destroy', $orden) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('¿Eliminar la orden #{{ $orden->id }}?')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center bg-transparent border-0" style="padding: 50px;">
                            <h4 style="color: rgba(255,255,255,0.5);">No hay órdenes registradas todavía.</h4>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endsection
</body>
</html>