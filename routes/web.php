    <?php
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\UserController;
    use App\Http\Controllers\ProductosController;
    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\OrdenesController;
    use App\Http\Controllers\DetalleOrdenController;

    //esto es para todos
    Route::get('/', function () {
        return view('welcome');
    });

    //RUTA PARA MOSTRAR LOS PRODUCTOS DESDE LA API EXTERNA
    Route::get('/home', [
        ProductosController::class, 'home'
    ])->name('home');
    

    // REGISTRO
    Route::get('/registro', [AuthController::class, 'registerForm'])->name('registro');
    Route::post('/registro', [AuthController::class, 'register'])->name('registro.store');

    // LOGIN
    Route::get('/acceso', [AuthController::class, 'loginForm'])->name('acceso');
    Route::post('/acceso', [AuthController::class, 'login'])->name('acceso.store');

    // LOGOUT
    Route::post('/cerrar', [AuthController::class, 'logout'])->name('cerrar');


    //SOLAMENTE USUARIOS AUTENTICADOS (clientes, admin, trabajadores,...)
    Route::middleware(['auth'])->group(function () {

        // user
        // Mostrar el perfil del usuario autenticado
        Route::get('/mi-perfil', [
            UserController::class, 'userProfile'
        ])->name('Usuario.profile');

        // Actualizar contraseña desde el perfil
        Route::put('/mi-perfil/password', [
            UserController::class, 'updatePassword'
        ])->name('Usuario.password');

        // PRODUCTOS (todos entran, PERO controlas en vista/controller)
        Route::resource('Productos', ProductosController::class);
        // ORDENES (todos pueden usar)
        Route::resource('Ordenes', OrdenesController::class)
            ->parameters(['Ordenes' => 'orden']);
        // DETALLES
        Route::resource('DetallesOrden', DetalleOrdenController::class);

        //
        // -------- ORDENES --------
        // Mostrar formulario crear orden
        Route::get('/Ordenes/create', [
            OrdenesController::class, 'create'
        ])->name('Ordenes.create');
        // Guardar orden
        Route::post('/Ordenes', [
            OrdenesController::class, 'store'
        ])->name('Ordenes.store');
        // Editar orden
        Route::get('/Ordenes/{orden}/edit', [
            OrdenesController::class, 'edit'
        ])->name('Ordenes.edit');
        // Actualizar orden
        Route::put('/Ordenes/{orden}', [
            OrdenesController::class, 'update'
        ])->name('Ordenes.update');
        // Eliminar orden
        Route::delete('/Ordenes/{orden}', [
            OrdenesController::class, 'destroy'
        ])->name('Ordenes.destroy');
        // -------- DETALLE ORDEN --------
        // Mostrar todos los detalles
        Route::get('/DetallesOrden', [
            detalleOrdenController::class, 'index'
        ])->name('DetallesOrden.index');
        // Crear detalle
        Route::get('/DetallesOrden/create', [
            detalleOrdenController::class, 'create'
        ])->name('DetallesOrden.create');
        // Guardar detalle
        Route::post('/DetallesOrden', [
            detalleOrdenController::class, 'store'
        ])->name('DetallesOrden.store');
        // Editar detalle
        Route::get('/DetallesOrden/{detalleOrden}/edit', [
            detalleOrdenController::class, 'edit'
        ])->name('DetallesOrden.edit');
        // Actualizar detalle
        Route::put('/DetallesOrden/{detalleOrden}', [
            detalleOrdenController::class, 'update'
        ])->name('DetallesOrden.update');
        // Eliminar detalle
        Route::delete('/DetallesOrden/{detalleOrden}', [
            detalleOrdenController::class, 'destroy'
        ])->name('DetallesOrden.destroy');
        //RUTAS NUEVAS - CREADAS PARA LA ASIGNACIÓN DE PRODUCTOS - 2026_03_15
        Route::get('/Productos/{id}/edit', [
            ProductosController::class, 'edit'
        ])->name('Productos.edit');
        Route::put('/Productos/{id}', [
            ProductosController::class, 'update'
        ])->name('Productos.update');
    });

    //Protección de rutas para ADMIN
    Route::middleware(['auth','admin'])->group(function () {
        Route::get('/admin-dashboard', [AuthController::class, 'adminDashboard']) //Clase y nombre del método
            ->name('admin-dashboard');
        Route::resource('Usuarios', UserController::class);
    });