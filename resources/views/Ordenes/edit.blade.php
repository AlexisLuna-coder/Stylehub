<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDITAR ORDEN/COMPRA</title>
</head>
<body>
    @extends('layouts.app')

    @section('content')

    <h1>Editar orden #{{ $orden->id }}</h1>

    @include('partials.alerts')

    <form action="{{ route('Ordenes.update', $orden) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- ESTADO -->
        <div class="mb-3">
            <label>Estado</label>
            <select name="estado" class="form-control">

                <option value="pendiente" {{ $orden->estado == 'pendiente' ? 'selected' : '' }}>
                    Pendiente
                </option>

                <option value="pagado" {{ $orden->estado == 'pagado' ? 'selected' : '' }}>
                    Pagado
                </option>

                <option value="enviado" {{ $orden->estado == 'enviado' ? 'selected' : '' }}>
                    Enviado
                </option>

                <option value="entregado" {{ $orden->estado == 'entregado' ? 'selected' : '' }}>
                    Entregado
                </option>

                <option value="cancelado" {{ $orden->estado == 'cancelado' ? 'selected' : '' }}>
                    Cancelado
                </option>

            </select>
        </div>

        <!-- DIRECCIÓN -->
        <div class="mb-3">
            <label>Dirección</label>
            <input type="text" name="direccion_envio" class="form-control"
                value="{{ $orden->direccion_envio }}" required>
        </div>

        <!-- MÉTODO DE PAGO -->
        <div class="mb-3">
            <label>Método de pago</label>
            <select name="metodo_pago" class="form-control">

                <option value="tarjeta" {{ $orden->metodo_pago == 'tarjeta' ? 'selected' : '' }}>
                    Tarjeta
                </option>

                <option value="efectivo" {{ $orden->metodo_pago == 'efectivo' ? 'selected' : '' }}>
                    Efectivo
                </option>

                <option value="transferencia" {{ $orden->metodo_pago == 'transferencia' ? 'selected' : '' }}>
                    Transferencia
                </option>

            </select>
        </div>

        <button type="submit" class="btn btn-success">
            Actualizar
        </button>

        <a href="{{ route('Ordenes.index') }}" class="btn btn-dark">
            Regresar
        </a>

    </form>

    @endsection
    
</body>
</html>