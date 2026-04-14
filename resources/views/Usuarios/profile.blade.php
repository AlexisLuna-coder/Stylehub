<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="{{ asset('/img/favicon.ico') }}"/>
    <link rel="stylesheet" href="{{ asset('css/usuarioProfile.css') }}">
    <title>MI PERFIL - STYLEHUB</title>
</head>
<body>
    @extends('layouts.app')

    @section('content')
        <div class="profile-wrapper">
            @include('partials.alerts')
            
            <div class="logo-container">
                <img src="{{ asset('img/logo2-vestido-SF.png') }}" alt="Logo de Stylehub">
                <h2 class="logo">Stylehub</h2>
            </div>
            
            <div class="profile-header-card">
                
                <div class="avatar-section">
                    <div class="avatar-circle">
                        <i class="fa-solid fa-user"></i>
                    </div>
                </div>

                <div class="info-section">
                    <h2>{{ auth()->user()->name }} {{ auth()->user()->apellido }}</h2>
                    <p class="member-date">
                        <i class="fa-solid fa-calendar-check me-2"></i> Miembro desde: 
                        <strong>{{ auth()->user()->created_at->format('Y-m-d') }}</strong>
                    </p>
                    <p class="tokens-info">
                        <i class="fa-solid fa-coins me-2"></i> Tokens: 
                        <strong>{{ auth()->user()->tokens ?? '0' }}</strong>
                    </p>
                </div>

                <div class="actions-section">
                    <div class="settings-box">
                        <i class="fa-solid fa-gear settings-icon"></i>
                        <div class="settings-buttons">
                            <a href="{{ route('home') }}" class="btn btn-outline-dark">
                                <i class="fa-solid fa-house me-2"></i> Inicio
                            </a>

                            <a href="{{ route('Usuarios.edit', auth()->user()->id) }}" class="btn btn-outline-dark">
                                Editar Datos
                            </a>
                            <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#passwordModal">
                                Cambiar Contraseña
                            </button>

                            <form action=" {{ route('cerrar') }}" method="POST"> 
                                @csrf 
                                <button class="btn btn-outline-danger me-3"> 
                                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Cerrar sesión 
                                </button> 
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="separator">

            <h3 class="section-title">HISTORIAL DE PEDIDOS</h3>

            <table class="table mt-4">
                <thead>
                    <tr>
                        <th>Pedido</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(auth()->user()->ordenes ?? [] as $orden)
                    <tr>
                        <td class="pedido-info">
                            <div class="img-container">
                                @if($orden->productos && $orden->productos->count() > 0 && $orden->productos->first()->imagen)
                                    <img src="{{ asset('storage/'.$orden->productos->first()->imagen) }}" alt="Producto">
                                @else
                                    <div class="placeholder-img"><i class="fa-solid fa-box"></i></div>
                                @endif
                            </div>
                            <span class="fw-bold text-gold">#{{ str_pad($orden->id, 4, '0', STR_PAD_LEFT) }}</span>
                        </td>
                        
                        <td>{{ \Carbon\Carbon::parse($orden->fecha)->format('Y-m-d') }}</td>
                        
                        <td class="text-warning fw-bold">${{ number_format($orden->total, 2) }}</td>
                        
                        <td>
                            @if(strtolower($orden->estado) == 'entregado')
                                <span class="badge bg-success">Entregado</span>
                            @elseif(strtolower($orden->estado) == 'enviado')
                                <span class="badge bg-primary">Enviado</span>
                            @elseif(strtolower($orden->estado) == 'cancelado')
                                <span class="badge bg-danger">Cancelado</span>
                            @else
                                <span class="badge bg-warning">Pendiente</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center empty-state">
                            <i class="fa-solid fa-basket-shopping fa-3x mb-3" style="color: #D4AF37;"></i>
                            <h4>Aún no has realizado ningún pedido.</h4>
                            <p>¡Explora nuestros productos y estrena hoy!</p>
                            <a href="{{ route('Productos.index') }}" class="btn btn-outline-secondary mt-2">Ir a la Tienda</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="modal fade" id="passwordModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content custom-modal">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fa-solid fa-lock me-2"></i> Cambiar Contraseña</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('Usuario.password') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Contraseña Actual</label>
                                <input type="password" name="current_password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nueva Contraseña</label>
                                <input type="password" name="new_password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirmar Nueva Contraseña</label>
                                <input type="password" name="new_password_confirmation" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-gold-solid">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
</body>
</html>