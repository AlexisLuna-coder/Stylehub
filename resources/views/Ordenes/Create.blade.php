<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="{{ asset('/img/favicon.ico') }}"/>
    <link rel="stylesheet" href="{{ asset('css/ventas.css') }}">
    <title>COMPRA - STYLEHUB</title>
</head>
<body>
    @extends('layouts.app')
    @section('content')
        <div class="ventas-wrapper">
            <div class="logo-container">
                <img src="{{ asset('img/logo2-vestido-SF.png') }}" alt="Logo de Stylehub">
                <h2 class="logo">Stylehub</h2>
            </div>

            <h1>Crear Nueva Orden</h1>
            @include('partials.alerts')

            <form action="{{ route('Ordenes.store') }}" method="POST">
                @csrf
                @php $user = auth()->user(); @endphp

                <div class="row">
                    <div class="col-md-5 columna-izquierda">
                        
                        @if($user->is_Admin || $user->user_Type == 'gerente' || $user->user_Type == 'trabajador')
                        <div class="mb-4">
                            <label>Seleccionar usuario</label>
                            <select name="user_id" class="form-control" required>
                                <option value="">-- Seleccionar usuario --</option>
                                @foreach($usuarios as $u)
                                    <option value="{{ $u->id }}">{{ $u->name }} - {{ $u->email }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif

                        <div class="mb-4">
                            <label>Dirección de envío</label>
                            <input type="text" id="direccion_envio" name="direccion_envio" class="form-control" placeholder="Ingrese dirección">

                            <div class="form-check mt-2">
                                <input type="checkbox" id="usar_direccion" class="form-check-input">
                                <label class="form-check-label" for="usar_direccion">
                                    Usar dirección de mi cuenta
                                </label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label>Método de pago</label>
                            <select name="metodo_pago" class="form-control">
                                <option value="Tarjeta">Tarjeta</option>
                                <option value="Efectivo">Efectivo</option>
                                <option value="Transferencia">Transferencia</option>
                                <option value="Deposito">Depósito</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-7 columna-derecha">
                        <h4><i class="fa-solid fa-cart-shopping me-2"></i> Seleccionar productos</h4>
                        
                        <div class="lista-productos-scroll">
                            @foreach($productos as $producto)
                                <div class="row mb-2 producto-item align-items-center {{ $producto->estado == 'inactivo' ? 'producto-inactivo' : '' }}">
                                    <div class="col-7 col-md-7">
                                        <span class="nombre-prod">{{ $producto->nombre }}</span> 
                                        <span class="precio-prod">${{ $producto->precio }}</span>
                                    </div>
                                    <div class="col-5 col-md-5 text-end">
                                        
                                        @if($producto->estado == 'activo')
                                            <input type="number" 
                                                name="productos[{{ $producto->id }}]" 
                                                class="form-control input-cantidad" 
                                                min="0" 
                                                max="{{ $producto->stock }}"
                                                value="0">
                                        @else
                                            <span class="badge bg-danger" style="padding: 8px 10px; font-size: 0.75rem; border-radius: 8px;">No disponible</span>
                                        @endif
                                        
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-4 row">
                            <div class="col-md-6">
                                <a href="{{ route('Ordenes.index') }}" class="btn btn-dark">
                                    <i class="fa-solid fa-arrow-left"></i> Regresar
                                </a>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa-solid fa-check"></i> Crear orden
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
    @endsection
</body>
</html>