<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}"> <!--ESTO ES PARA EL CSS -->
    <link rel="icon" type="image/jpg" href="{{ asset('/img/favicon.ico') }}"/>
    <title>Catálogo Externo - Stylehub</title>
</head>
<body>    
    <div class="main-container">
        
        <aside class="sidebar">
            <div class="logo-container">
                <img src="{{ asset('img/logo2-vestido-SF.png') }}" alt="Logo de Stylehub">
                <h2 class="logo">Stylehub</h2>
            </div>

            <nav>
                <a href="{{ route('home') }}">Inicio</a>
                <a href="#ropa">Ropa en Tendencia</a>
                <a href="#zapatos">Calzado Exclusivo</a>
                
                @guest
                    <a href="{{ route('acceso') }}">Iniciar Sesión</a>
                    <a href="{{ route('registro') }}">Registrarse</a>
                @endguest

                @auth
                    <a href="{{ route('Ordenes.create') }}">Registrar Pedidos</a>
                    
                    @if(Auth::user()->is_Admin == 1)
                        <a href="{{ route('admin-dashboard') }}">Panel de Admin</a>
                    @else
                        <a href="{{ route('Productos.index') }}">Inventario / Productos</a>
                    @endif

                    <a href="{{ route('Usuario.profile') }}" class="btn-acceder">
                        Mi perfil
                    </a>
                @endauth
            </nav>

            @auth
            <div class="logout-container">
                <form action="{{ route('cerrar') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout">Cerrar sesión</button>
                </form>
            </div>
            @endauth
        </aside>

        <main class="content">
            
            <header class="topbar">
                <div class="menu-links">
                    <a href="#ropa">Ver Ropa</a>
                    <a href="#zapatos">Ver Zapatos</a>
                </div>
            </header>

            <section class="hero" id="ropa">
                <div class="hero-text">
                    <h1>ROPA EN <br> TENDENCIA</h1>
                    <p>Explora la mejor ropa conectada directamente vía API.</p>
                    <button class="more-btn">Ver más</button>
                </div>

                <div class="books">
                    @foreach($ropa as $prenda)
                        <div class="book">
                            <img src="{{ $prenda['images'][0] ?? '' }}" alt="Imagen no disponible">
                            <h4>{{ $prenda['title'] ?? 'Sin título' }}</h4>
                            <p>{{ $prenda['category']['name'] ?? 'General' }}</p>
                            <p class="price">$ {{ $prenda['price'] ?? '0' }}</p>
                        </div>
                    @endforeach
                </div>
            </section>

            <section class="hero" id="zapatos">
                <div class="hero-text">
                    <h1>CALZADO <br> EXCLUSIVO</h1>
                    <p>Los mejores estilos en zapatos actualizados en tiempo real.</p>
                    <button class="more-btn">Ver más</button>
                </div>

                <div class="books">
                    @foreach($zapatos as $zapato)
                        <div class="book">
                            <img src="{{ $zapato['images'][0] ?? '' }}" alt="Imagen no disponible">
                            <h4>{{ $zapato['title'] ?? 'Sin título' }}</h4>
                            <p>{{ $zapato['category']['name'] ?? 'General' }}</p>
                            <p class="price">$ {{ $zapato['price'] ?? '0' }}</p>
                        </div>
                    @endforeach
                </div>
            </section>
        </main>
    </div>
</body>
</html>