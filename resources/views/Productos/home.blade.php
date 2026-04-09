<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <title>Catálogo Externo - Stylehub</title>
</head>
<body>    
    <div class="main-container">
        <aside class="sidebar">
            <h2 class="logo">Stylehub</h2>

            <nav class="">
                <a href="{{ route('home') }}">Inicio</a>
                <a href="#">Favoritos</a>
                <a href="#">Mis compras</a>
                <a href="#">Explorar</a>
                <a href="#">Configuración</a>
            </nav>
            <a href="{{ route('admin-dashboard') }}" class="logout">Volver al Panel</a>
        </aside>

        <main class="content">
            <header class="topbar">
                <form action="{{ route('home') }}" method="GET" class="filter-form">
                    <input type="text" name="titulo" placeholder="Buscar producto..." value="{{ request('titulo') }}">
                    <input type="number" name="min" placeholder="Precio Mín" value="{{ request('min') }}">
                    <input type="number" name="max" placeholder="Precio Máx" value="{{ request('max') }}">
                    <select name="categoria">
                        <option value="">Categorías</option>
                        <option value="1">Ropa</option>
                        <option value="2">Electrónica</option>
                        <option value="3">Muebles</option>
                        <option value="4">Zapatos</option>
                    </select>
                    <button type="submit" class="more-btn">Filtrar</button>
                </form>
            </header>

            <section class="hero">
                <div class="hero-text">
                    <h1>CATÁLOGO <br> EXTERNO</h1>
                    <p>
                        Explora productos de tendencia mundial <br>
                        conectados directamente vía API.
                    </p>
                </div>

                <div class="books">
                    @forelse($resultados as $item)
                        <div class="book">
                            <img src="{{ $item['category']['image'] ?? 'https://via.placeholder.com/150' }}" 
                                alt="{{ $item['title'] }}"
                                onerror="this.src='https://via.placeholder.com/150'">
                            
                            <h4>{{ $item['title'] }}</h4>
                            <p class="price">${{ $item['price'] }}</p>
                            <span class="category-badge">{{ $item['category']['name'] ?? 'General' }}</span>
                        </div>
                    @empty
                        <div class="no-results">
                            <p>No se encontraron productos con esos filtros.</p>
                        </div>
                    @endforelse
                </div>
            </section>
        </main>
    </div>
</body>
</html>