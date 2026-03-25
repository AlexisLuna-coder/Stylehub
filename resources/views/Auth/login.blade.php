<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
</head>
<body>
    @extends('layouts.app')
    @section('content')

    <h1>INICIO DE SESIÓN </h1>
    @include('partials.alerts')
    <form action=" {{ route('acceso.store') }}" method="POST"> 
        @csrf
        <input type="email" name="email" placeholder="Correo" class="form-control" required>
        <br>
        <input type="password" name="password" placeholder="Contraseña" class="form-control" required>
        <br>

        <button type="submit" class="btn btn-success">Enviar</button>
    </form>
    
    @endsection
</body>
</html>
