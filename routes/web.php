<?php
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\UsuariosController;
    use App\Http\Controllers\ProductosController;
    use App\Http\Controllers\AuthController;

    Route::get('/', function () {
        return view('welcome');
    });
    Route::resource('Usuarios', AuthController::class);
    Route::resource('Productos', ProductosController::class);

    //RUTAS NUEVAS - CREADAS PARA LA ASIGNACIÓN DE PRODUCTOS - 2026_03_15
    Route::get('/Productos/{id}/edit', [
        ProductosController::class, 'edit'
    ])->name('Productos.edit');

    //RUTAS PARA POTREGER LAS RUTAS De los usuarios
    Route::middleware(['auth'])->group(function () {
        // Ruta para obtener los métodos de UsuariosController
        Route::resource('Productos', ProductosController::class);
    });

    Route::put('Productos/{id}', [
        ProductosController::class, 'update'
    ])->name('Productos.update');

    /****************************/
    //RUTAS ANTERIORES - USUARIOS
    Route::get('/Usuarios/{id}/edit', [
        // UsuariosController::class, 'edit'
        AuthController::class, 'edit'
    ])->name('Usuarios.edit');

    //RUTAS PARA POTREGER LAS RUTAS De los usuarios
    Route::middleware(['auth'])->group(function () {
        // Ruta para obtener los métodos de UsuariosController
        //Route::resource('Usuarios', UsuariosController::class);
        Route::resource('Usuarios', AuthController::class);
    });

    Route::put('Usuarios/{id}', [
        //UsuariosController::class, 'update'
        AuthController::class, 'update'
    ])->name('Usuarios.update');

    /*RUTAS PARA EL INICIO DE SESIÓN Y CERRAR SESIÓN */

    //RUTA PARA MOSTRAR EL FORMULARIO DE REGISTRO
    Route::get('/registro', [
        AuthController::class, 'registerForm'
    ])->name('registro');

    Route::post('/registro', [
        AuthController::class, 'register'
    ])->name('registro.store');

    //RUTAS PARA MOSTRAR EL FORMULARIO DE INICIO DE SESIÓN
    Route::get('/acceso',[
        AuthController::class, 'loginForm'
    ])->name('acceso');

    //Ruta para verificar el inicio de sesión
    //post enviar informacion
    Route::post('/acceso', [
        AuthController::class, 'login'
    ])->name('acceso.store');
    
    //Ruta para cerrar sesión
    //post manda informacion
    Route::post('/cerrar', [
        AuthController::class, 'logout'
    ])->name('cerrar');

    //RUTAS PARA EL ADMINSTRADOR
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/admin-dashboard',[
            AuthController::class, 'adminDashboard'
        ])->name('admin-dashboard');
    });