<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stylehub - Bienvenido</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="icon" type="image/jpg" href="{{ asset('/img/favicon.ico') }}"/>

    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}"> <!--AQUÍ INCLUIMOS EN CSS -->
</head>
<body>
    <div class="glass-card">
        <img src="{{ asset('img/logo2-vestido-SF.png') }}" alt="Logo Stylehub" class="logo-welcome">
        
        <h1>STYLEHUB</h1>

        <a href="{{ route('home') }}" class="btn-acceder">
            ACCEDER
        </a>
    </div>
</body>
</html>