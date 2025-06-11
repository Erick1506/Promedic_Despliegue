<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Los mapeos de políticas para la aplicación.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Registrar cualquier servicio de autenticación / autorización.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Aquí puedes registrar gates adicionales si es necesario
    }
}
