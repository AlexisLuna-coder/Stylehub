<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="{{ asset('/img/favicon.ico') }}"/>
    <link rel="stylesheet" href="{{ asset('css/productosCreate.css') }}"> <!--AQUÍ INCLUIMOS EN CSS -->
    <title>Registro - Productos</title>
</head>
    <body>
        @extends('layouts.app')
        @section('content')
            <div class="product-wrapper">
                <div class="logo-container">
                    <img src="{{ asset('img/logo2-vestido-SF.png') }}" alt="Logo de Stylehub">
                    <h2 class="logo">Stylehub</h2>
                </div>
                <h1>Registrar Producto</h1>

                <form action="{{ route('Productos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-box"></i></span>
                        <input type="text" name="nombre" placeholder="Nombre del producto" class="form-control" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-align-left"></i></span>
                        <textarea name="descripcion" placeholder="Descripción" class="form-control" rows="2"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa-solid fa-dollar-sign"></i></span>
                                <input type="number" step="0.01" name="precio" placeholder="Precio" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa-solid fa-cubes"></i></span>
                                <input type="number" name="stock" placeholder="Stock" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-tags"></i></span>
                        <input type="text" name="categoria" placeholder="Categoría" class="form-control">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-barcode"></i></span>
                        <input type="text" name="codigo" placeholder="Código [ej. ABCZ-000]" class="form-control" pattern="[a-zA-Z]{4}-[0-9]{3}">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-image"></i></span>
                        <input type="file" name="imagen" class="form-control">
                    </div>

                    <div class="input-group mb-4">
                        <span class="input-group-text"><i class="fa-solid fa-toggle-on"></i></span>
                        <select name="estado" class="form-control">
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="fa-solid fa-floppy-disk"></i> Guardar Producto
                    </button>

                    <a href="{{ route('Productos.index') }}" class="btn btn-outline-dark">
                        Ir a la consulta
                    </a>
                </form>
            </div>
        @endsection
    </body>
</html>