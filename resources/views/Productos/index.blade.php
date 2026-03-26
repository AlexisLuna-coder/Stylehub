<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONSULTA DE USUARIOS - STYLEHUB</title>
</head>
    <body>
        @extends('layouts.app')
        @section('content')
        <h1><center>CONSULTA DE PRODUCTOS - STYLEHUB</center></h1>
        <br>
        <div class="d-flex justify-content-end mb-2">
            <a href="{{ route('Productos.create') }}">
                <button type="button" class="btn btn-outline-dark me-3">
                    <i class="fa-solid fa-plus"></i> Nuevo producto
                </button>
            </a>
            <form action=" {{ route('cerrar') }}" method="POST"> 
                @csrf 
                <button class="btn btn-outline-danger me-3"> 
                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Cerrar sesión 
                </button> 
            </form>
            <!--verificar si la sesión esta activa--> 
            @auth 
            @if(auth()->user()->is_Admin) 
                <a href="{{ route('admin-dashboard') }}" class="btn btn-outline-secondary me-3 mb-3"> 
                    <i class="fa-solid fa-gear"></i> Panel Admin 
                </a> 
            @endif 
            @endauth 
        </div>
        @include('partials.alerts')
        <hr>
        <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Categoría</th>
                <th>Código</th>
                <th>Imagen</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($Productos as $producto)
            <tr>
            <td>{{ $producto->id }}</td>
            <td>{{ $producto->nombre }}</td>
            <td>{{ $producto->descripcion }}</td>
            <td>${{ $producto->precio }}</td>
            <td>{{ $producto->stock }}</td>
            <td>{{ $producto->categoria }}</td>
            <td>{{ $producto->codigo }}</td>
            <td>
                @if($producto->imagen)
                    <img src="{{ asset('storage/'.$producto->imagen) }}" width="60">
                @else
                    <span class="badge bg-warning text-dark">Pendiente</span>
                @endif
            </td>
            <td>
                @if($producto->estado == 'activo')
                    <span class="badge bg-success">Activo</span>
                    @else
                    <span class="badge bg-danger">Inactivo</span>
                @endif
            </td>
                <td>
                    <a href="{{ route('Productos.edit', $producto) }}">
                    <button class="btn btn-warning">
                    <i class="fa-solid fa-pen-to-square"></i> Editar
                    </button>
                </a>

                <form action="{{ route('Productos.destroy', $producto) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button 
                    class="btn btn-danger"
                    onclick="return confirm('¿Eliminar el producto?')">
                    <i class="fa-solid fa-trash"></i> Eliminar
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
