<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * El espacio de nombres del controlador para la aplicación.
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Definir las rutas de la aplicación.
     */
    public function boot(): void
    {
        parent::boot();

        $this->routes(function () {
            // Ruta para API (todas las que tienes en Postman)
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace) // Asegura que los controladores se resuelvan correctamente
                ->group(base_path('routes/api.php'));

            // Rutas web (opcional)
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });
    }
}
