<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @extends('layouts.app')

    @section('content')

    <h1>Crear nueva orden</h1>

    @include('partials.alerts')

    <form action="{{ route('Ordenes.store') }}" method="POST">
        @csrf
        
        @php
            $user = auth()->user();
        @endphp

        @if($user->is_Admin || $user->user_Type == 'gerente' || $user->user_Type == 'trabajador')

        <div class="mb-3">
            <label>Seleccionar usuario</label>
            <select name="user_id" class="form-control" required>
                <option value="">-- Seleccionar usuario --</option>

                @foreach($usuarios as $u)
                    <option value="{{ $u->id }}">
                        {{ $u->name }} - {{ $u->email }}
                    </option>
                @endforeach
            </select>
        </div>

        @endif

        <!-- DIRECCIÓN -->
        <div class="mb-3">
            <label>Dirección de envío</label>
            <input type="text" 
                id="direccion_envio"
                name="direccion_envio" 
                class="form-control"
                placeholder="Ingrese dirección">

            <div class="form-check mt-2">
                <input type="checkbox" 
                    id="usar_direccion" 
                    class="form-check-input">

                <label class="form-check-label">
                    Usar dirección de mi cuenta
                </label>
            </div>
        </div>
        <script>
            document.getElementById('usar_direccion').addEventListener('change', function() {
                let input = document.getElementById('direccion_envio');
                if(this.checked){
                    input.value = "{{ auth()->user()->direccion }}";
                    input.readOnly = true;
                } else {
                    input.value = "";
                    input.readOnly = false;
                }

            });
        </script>

        <!-- MÉTODO DE PAGO -->
        <div class="mb-3">
            <label>Método de pago</label>
            <select name="metodo_pago" class="form-control">
                <option value="Tarjeta">Tarjeta</option>
                <option value="Efectivo">Efectivo</option>
                <option value="Transferencia">Transferencia</option>
                <option value="Deposito">Deposito</option>
            </select>
        </div>

        <hr>

        <h4>Seleccionar productos</h4>

        @foreach($productos as $producto)
            <div class="row mb-2">
                <div class="col-md-6">
                    {{ $producto->nombre }} (${{ $producto->precio }})
                </div>

                <div class="col-md-3">
                    <input type="number" 
                        name="productos[{{ $producto->id }}]" 
                        class="form-control" 
                        min="0" 
                        max="{{ $producto->stock }}"
                        value="0">
                </div>
            </div>
        @endforeach

        <br>

        <button type="submit" class="btn btn-success">
            Crear orden
        </button>

        <a href="{{ route('Ordenes.index') }}" class="btn btn-dark">
            Regresar
        </a>

    </form>

    @endsection
    
</body>
</html>