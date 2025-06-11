<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Los eventos y sus oyentes registrados para la aplicación.
     *
     * @var array
     */
    protected $listen = [
        // 'App\Events\EventName' => [
        //     'App\Listeners\ListenerName',
        // ],
    ];

    /**
     * Registrar cualquier servicio de eventos.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
