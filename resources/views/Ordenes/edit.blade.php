<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="{{ asset('/img/favicon.ico') }}"/>
    <link rel="stylesheet" href="{{ asset('css/editOrdenes.css') }}">
    <title>EDITAR ORDEN - STYLEHUB</title>
</head>
<body>
    @extends('layouts.app')
    @section('content')
        <div class="editar-wrapper">
            
            <div class="logo-container">
                <img src="{{ asset('img/logo2-vestido-SF.png') }}" alt="Logo de Stylehub">
                <h2 class="logo">Stylehub</h2>
            </div>

            <h1>Editar orden #{{ $orden->id }}</h1>

            @include('partials.alerts')

            <div class="total-box">
                TOTAL DE LA ORDEN: <span>${{ number_format($orden->total, 2) }}</span>
            </div>

            <form action="{{ route('Ordenes.update', $orden) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Estado de la Orden</label>
                    <select name="estado" class="form-control">
                        <option value="Pendiente" {{ $orden->estado == 'Pendiente' || $orden->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="Pagado" {{ $orden->estado == 'Pagado' || $orden->estado == 'pagado' ? 'selected' : '' }}>Pagado</option>
                        <option value="Enviado" {{ $orden->estado == 'Enviado' || $orden->estado == 'enviado' ? 'selected' : '' }}>Enviado</option>
                        <option value="Entregado" {{ $orden->estado == 'Entregado' || $orden->estado == 'entregado' ? 'selected' : '' }}>Entregado</option>
                        <option value="Cancelado" {{ $orden->estado == 'Cancelado' || $orden->estado == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Dirección de Envío</label>
                    <textarea name="direccion_envio" class="form-control" rows="2" required>{{ $orden->direccion_envio }}</textarea>
                </div>

                <div class="mb-4">
                    <label>Método de pago</label>
                    <select name="metodo_pago" class="form-control">
                        <option value="tarjeta" {{ strtolower($orden->metodo_pago) == 'tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                        <option value="efectivo" {{ strtolower($orden->metodo_pago) == 'efectivo' ? 'selected' : '' }}>Efectivo</option>
                        <option value="transferencia" {{ strtolower($orden->metodo_pago) == 'transferencia' ? 'selected' : '' }}>Transferencia</option>
                        <option value="deposito" {{ strtolower($orden->metodo_pago) == 'deposito' ? 'selected' : '' }}>Depósito</option>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route('Ordenes.index') }}" class="btn btn-dark">
                            <i class="fa-solid fa-arrow-left"></i> Regresar
                        </a>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success">
                            <i class="fa-solid fa-floppy-disk"></i> Actualizar
                        </button>
                    </div>
                </div>

            </form>
        </div>
    @endsection
</body>
</html>