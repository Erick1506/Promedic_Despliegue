<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClasificacionController;
use App\Http\Controllers\ComprobanteController;
use App\Http\Controllers\EstadoProductoController;
use App\Http\Controllers\FormulaMedicaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\MensajesARegenteController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PromocionController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\RegenteController;
use App\Http\Controllers\TipoPromocionController;
use App\Http\Controllers\TipoTransaccionController;
use App\Http\Controllers\TransaccionController;
use App\Http\Controllers\TurnoRegenteController;


// Rutas para Administradores
Route::get('/administradores', [AdministradorController::class, 'index']);
Route::post('/administradores', [AdministradorController::class, 'store']);
Route::get('/administradores/{id}', [AdministradorController::class, 'show']);
Route::put('/administradores/{id}', [AdministradorController::class, 'update']);
Route::delete('/administradores/{id}', [AdministradorController::class, 'destroy']);

// Rutas para Categorías
Route::get('/categorias', [CategoriaController::class, 'index']);
Route::post('/categorias', [CategoriaController::class, 'store']);
Route::get('/categorias/{id}', [CategoriaController::class, 'show']);
Route::put('/categorias/{id}', [CategoriaController::class, 'update']);
Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy']);

// Rutas para Clasificaciones
Route::get('/clasificaciones', [ClasificacionController::class, 'index']);
Route::post('/clasificaciones', [ClasificacionController::class, 'store']);
Route::get('/clasificaciones/{id}', [ClasificacionController::class, 'show']);
Route::put('/clasificaciones/{id}', [ClasificacionController::class, 'update']);
Route::delete('/clasificaciones/{id}', [ClasificacionController::class, 'destroy']);

// Rutas para Comprobantes
Route::get('/comprobantes', [ComprobanteController::class, 'index']);
Route::post('/comprobantes', [ComprobanteController::class, 'store']);
Route::get('/comprobantes/{id}', [ComprobanteController::class, 'show']);
Route::put('/comprobantes/{id}', [ComprobanteController::class, 'update']);
Route::delete('/comprobantes/{id}', [ComprobanteController::class, 'destroy']);

// Rutas para Estado de Productos
Route::get('/estado-productos', [EstadoProductoController::class, 'index']);
Route::post('/estado-productos', [EstadoProductoController::class, 'store']);
Route::get('/estado-productos/{id}', [EstadoProductoController::class, 'show']);
Route::put('/estado-productos/{id}', [EstadoProductoController::class, 'update']);
Route::delete('/estado-productos/{id}', [EstadoProductoController::class, 'destroy']);

// Rutas para Fórmulas Médicas
Route::get('/formulas-medicas', [FormulaMedicaController::class, 'index']);
Route::post('/formulas-medicas', [FormulaMedicaController::class, 'store']);
Route::get('/formulas-medicas/{id}', [FormulaMedicaController::class, 'show']);
Route::put('/formulas-medicas/{id}', [FormulaMedicaController::class, 'update']);
Route::delete('/formulas-medicas/{id}', [FormulaMedicaController::class, 'destroy']);

// Rutas para Marcas
Route::get('/marcas', [MarcaController::class, 'index']);
Route::post('/marcas', [MarcaController::class, 'store']);
Route::get('/marcas/{id}', [MarcaController::class, 'show']);
Route::put('/marcas/{id}', [MarcaController::class, 'update']);
Route::delete('/marcas/{id}', [MarcaController::class, 'destroy']);

// Rutas para Mensajes a Regente
Route::get('/mensajes-a-regente', [MensajesARegenteController::class, 'index']);
Route::post('/mensajes-a-regente', [MensajesARegenteController::class, 'store']);
Route::get('/mensajes-a-regente/{id}', [MensajesARegenteController::class, 'show']);
Route::put('/mensajes-a-regente/{id}', [MensajesARegenteController::class, 'update']);
Route::delete('/mensajes-a-regente/{id}', [MensajesARegenteController::class, 'destroy']);

// Rutas para Notificaciones
Route::get('/notificaciones', [NotificacionController::class, 'index']);
Route::post('/notificaciones', [NotificacionController::class, 'store']);
Route::get('/notificaciones/{id}', [NotificacionController::class, 'show']);
Route::put('/notificaciones/{id}', [NotificacionController::class, 'update']);
Route::delete('/notificaciones/{id}', [NotificacionController::class, 'destroy']);

// Rutas para Productos
Route::get('/productos', [ProductoController::class, 'index']);
Route::post('/productos', [ProductoController::class, 'store']);
Route::get('/productos/{id}', [ProductoController::class, 'show']);
Route::put('/productos/{id}', [ProductoController::class, 'update']);
Route::delete('/productos/{id}', [ProductoController::class, 'destroy']);

// Rutas para Promociones
Route::get('/promociones', [PromocionController::class, 'index']);
Route::post('/promociones', [PromocionController::class, 'store']);
Route::get('/promociones/{id}', [PromocionController::class, 'show']);
Route::put('/promociones/{id}', [PromocionController::class, 'update']);
Route::delete('/promociones/{id}', [PromocionController::class, 'destroy']);

// Rutas para Proveedores
Route::get('/proveedores', [ProveedorController::class, 'index']);
Route::post('/proveedores', [ProveedorController::class, 'store']);
Route::get('/proveedores/{id}', [ProveedorController::class, 'show']);
Route::put('/proveedores/{id}', [ProveedorController::class, 'update']);
Route::delete('/proveedores/{id}', [ProveedorController::class, 'destroy']);

// Rutas para Regentes
Route::get('/regentes', [RegenteController::class, 'index']);
Route::post('/regentes', [RegenteController::class, 'store']);
Route::get('/regentes/{id}', [RegenteController::class, 'show']);
Route::put('/regentes/{id}', [RegenteController::class, 'update']);
Route::delete('/regentes/{id}', [RegenteController::class, 'destroy']);

// Rutas para Tipos de Promoción
Route::get('/tipos-promocion', [TipoPromocionController::class, 'index']);
Route::post('/tipos-promocion', [TipoPromocionController::class, 'store']);
Route::get('/tipos-promocion/{id}', [TipoPromocionController::class, 'show']);
Route::put('/tipos-promocion/{id}', [TipoPromocionController::class, 'update']);
Route::delete('/tipos-promocion/{id}', [TipoPromocionController::class, 'destroy']);

// Rutas para Tipos de Transacción
Route::get('/tipos-transaccion', [TipoTransaccionController::class, 'index']);
Route::post('/tipos-transaccion', [TipoTransaccionController::class, 'store']);
Route::get('/tipos-transaccion/{id}', [TipoTransaccionController::class, 'show']);
Route::put('/tipos-transaccion/{id}', [TipoTransaccionController::class, 'update']);
Route::delete('/tipos-transaccion/{id}', [TipoTransaccionController::class, 'destroy']);

// Rutas para Transacciones
Route::get('/transacciones', [TransaccionController::class, 'index']);
Route::post('/transacciones', [TransaccionController::class, 'store']);
Route::get('/transacciones/{id}', [TransaccionController::class, 'show']);
Route::put('/transacciones/{id}', [TransaccionController::class, 'update']);
Route::delete('/transacciones/{id}', [TransaccionController::class, 'destroy']);

// Rutas para Turnos de Regente
Route::get('/turnos-regente', [TurnoRegenteController::class, 'index']);
Route::post('/turnos-regente', [TurnoRegenteController::class, 'store']);
Route::get('/turnos-regente/{id}', [TurnoRegenteController::class, 'show']);
Route::put('/turnos-regente/{id}', [TurnoRegenteController::class, 'update']);
Route::delete('/turnos-regente/{id}', [TurnoRegenteController::class, 'destroy']); 



Route::get('/productos-criticos', [NotificacionController::class, 'productosCriticos']);
Route::get('/notificaciones', [NotificacionController::class, 'obtenerNotificaciones']);
Route::get('/mensajes-regente', [NotificacionController::class, 'obtenerMensajesARegente']);


