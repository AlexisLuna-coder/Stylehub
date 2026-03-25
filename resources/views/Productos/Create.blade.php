<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Productos</title>
</head>
    <body>

    @extends('layouts.app')

    @section('content')

    <h1>Registrar un nuevo usuario </h1>
    <form action="{{ route('Productos.store') }}" method="POST" enctype="multipart/form-data"> <!-- enctype="multipart/form-data" sirve para subir archivos (imágenes, documentos, etc.) desde un formulario HTML al servidor -->
        <!--<@csrf USO obligatorio para enviar informacion en formularios-->
        @csrf

        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-box"></i></span>
            <input type="text" name="nombre" placeholder="Nombre del producto" class="form-control">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-align-left"></i></span>
            <textarea name="descripcion" placeholder="Descripción del producto" class="form-control"></textarea>
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-dollar-sign"></i></span>
            <input type="number" step="0.01" name="precio" placeholder="Precio" class="form-control">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-cubes"></i></span>
            <input type="number" name="stock" placeholder="Stock disponible" class="form-control">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-tags"></i></span>
            <input type="text" name="categoria" placeholder="Categoría" class="form-control">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-barcode"></i></span>
            <input type="text" name="codigo" placeholder="Código del producto" class="form-control">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-image"></i></span>
            <input type="file" name="imagen" class="form-control">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-toggle-on"></i></span>
            <select name="estado" class="form-control">
                <option value="activo">Activo</option>
                <option value="inactivo">Inactivo</option>
            </select>
        </div>
        <center>
            <button type="submit" class="btn btn-success">
                <i class="fa-solid fa-floppy-disk"></i> Guardar
            </button>
            <a href="{{ route('Productos.index') }}">
                <button type="button" class="btn btn-outline-dark">
                    Ir a la consulta
                </button>
            </a>
        </center>
        </form>
        @endsection
    </body>
</html>