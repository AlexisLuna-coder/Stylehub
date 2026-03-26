<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Editar</title>
</head>
    <body>
    @extends('layouts.app')
    @section('content')
    @include('partials.alerts')
    <h1>Editar producto : {{ $Producto->nombre }} </h1>

    <form action="{{ route('Productos.update', $Producto) }}" method="POST" enctype="multipart/form-data"> <!-- enctype="multipart/form-data" sirve para subir archivos (imágenes, documentos, etc.) desde un formulario HTML al servidor -->
        <!-- uso obligatorio para la actualizaxion para el comentario es ctrl + k + c -->
        @csrf
        @method('PUT')

        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-box"></i></span>
            <input required type="text" name="nombre" placeholder="Nombre del producto"
            value="{{ $Producto->nombre }}" class="form-control">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-align-left"></i></span>
            <textarea name="descripcion" class="form-control" placeholder="Descripción del producto">{{ $Producto->descripcion }}</textarea>
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-dollar-sign"></i></span>
            <input required type="number" step="0.01" name="precio" placeholder="Precio"
            value="{{ $Producto->precio }}" class="form-control">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-cubes"></i></span>
            <input required type="number" name="stock" placeholder="Stock disponible"
            value="{{ $Producto->stock }}" class="form-control">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-tags"></i></span>
            <input type="text" name="categoria" placeholder="Categoría"
            value="{{ $Producto->categoria }}" class="form-control">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-barcode"></i></span>
            <input type="text" name="codigo" placeholder="Código del producto"
            value="{{ $Producto->codigo }}" class="form-control">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-image"></i></span>
            <input type="file" name="imagen" class="form-control">
            @if($Producto->imagen)
                <img src="{{ asset('storage/'.$Producto->imagen) }}" width="100">
            @endif
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-toggle-on"></i></span>
            <select name="estado" class="form-control">

                <option value="activo"
                {{ $Producto->estado == 'activo' ? 'selected' : '' }}>
                Activo
                </option>

                <option value="inactivo"
                {{ $Producto->estado == 'inactivo' ? 'selected' : '' }}>
                Inactivo
                </option>

            </select>
        </div>
        <button type="submit" class="btn btn-outline-success">
            <i class="fa-solid fa-floppy-disk"></i> Guardar
        </button>
        </form>

        <div class="d-flex justify-content-end mb">
            <a href="{{ route('Productos.index') }}" class="btn btn-outline-danger">
            <i class="fa-solid fa-arrow-left"></i> Regresar
            </a>
        </div>
        @endsection
    </body>
</html>
