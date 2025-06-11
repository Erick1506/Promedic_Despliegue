<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PromocionController;
use App\Http\Controllers\EstadisticaController;
use App\Http\Controllers\FormulaMedicaController;
use App\Http\Controllers\RegenteController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClasificacionController;
use App\Http\controllers\MarcaController;
use App\Http\controllers\EstadisticasController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\MensajesARegenteController;


Route::get('/', function () {
    return view('auth.login');
});

// Ruta para mostrar formulario de login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');

// Ruta para procesar formulario de login
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

// Ruta para logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Ruta protegida (dashboard)
Route::get('/dashboard', function () {
    if (!session()->has('regente_id') && !session()->has('admin_id')) {
        return redirect('/login');
    }
    return view('dashboard');
})->name('dashboard');

// Dashboard desde controlador (esta línea puede quedar si es necesaria)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Estadísticas
Route::get('/estadisticas', [EstadisticasController::class, 'index'])->name('estadisticas.index');


// Productos
Route::resource('productos', ProductoController::class)
    ->except(['show']);

// Marcas

Route::resource('marcas', MarcaController::class);

// Promociones
Route::resource('promociones', PromocionController::class);

// Recetas médicas
Route::resource('recetas', FormulaMedicaController::class)
    ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

// Regentes 
Route::resource('regentes', RegenteController::class ,);

// Proveedores
Route::resource('proveedores', ProveedorController::class)
    ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

// Categorías
Route::resource('categorias', CategoriaController::class);

// Clasificaciones
Route::resource('clasificaciones', ClasificacionController::class);

// Vender producto
Route::post('/productos/vender', [ProductoController::class, 'vender'])->name('productos.vender');


// ruta para informes inventario
Route::get('/informes/inventario', [ReporteController::class, 'index'])->name('informes.inventario');
Route::get('/informes/inventario/pdf', [ReporteController::class, 'generarPDF'])->name('informes.pdf_inventario');
Route::post('/generar-informe', [ReporteController::class, 'generarPDF'])->name('form');

// Recuperar contraseña 
use App\Http\Controllers\PasswordController;

Route::get('/recuperar', [PasswordController::class, 'showEmailForm'])->name('password.email.form');
Route::post('/recuperar', [PasswordController::class, 'checkEmail'])->name('password.email.check');
Route::get('/cambiar', [PasswordController::class, 'showResetForm'])->name('password.reset.form');
Route::post('/cambiar', [PasswordController::class, 'resetPassword'])->name('password.reset.save');

use App\Http\Controllers\NotificacionController;

Route::get('/productos-criticos', [NotificacionController::class, 'productosCriticos']);

Route::post('/notificaciones', [NotificacionController::class, 'crearNotificacion']);

Route::post('/mensajes-regente', [NotificacionController::class, 'enviarMensajeARegente']);

Route::get('/mensajes-regente', [NotificacionController::class, 'obtenerMensajesARegente']);

Route::get('/notificaciones', [NotificacionController::class, 'obtenerNotificaciones']);

