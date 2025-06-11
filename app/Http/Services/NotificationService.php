<?php

namespace App\Http\Services;

use App\Models\Producto;
use App\Models\Notificacion;
use App\Models\MensajesARegente;
use Carbon\Carbon;

class NotificationService
{
    public function productosCriticos()
    {
        $hoy = Carbon::today();
        $unaSemana = $hoy->copy()->addDays(7);

        return Producto::where(function ($query) use ($hoy, $unaSemana) {
            $query->whereDate('Fecha_Vencimiento', '<', $hoy) // vencidos
                  ->orWhereBetween('Fecha_Vencimiento', [$hoy, $unaSemana]) // por vencer
                  ->orWhereColumn('Cantidad_Stock', '>', 'Cantidad_Maxima') // stock máximo
                  ->orWhereColumn('Cantidad_Stock', '<=', 'Cantidad_Minima'); // stock mínimo superado
        })->get();
    }

    public function crearNotificacion($mensaje)
    {
        return Notificacion::create([
            'mensaje' => $mensaje,
            'fecha_creacion' => Carbon::now(),
        ]);
    }

    public function enviarMensajeARegente($mensaje)
    {
        return MensajesARegente::create([
            'mensaje' => $mensaje,
            'fecha' => Carbon::now(),
        ]);
    }

    public function obtenerMensajesARegente()
    {
        return MensajesARegente::orderBy('fecha', 'desc')->get();
    }

    public function obtenerNotificaciones()
    {
        return Notificacion::orderBy('fecha_creacion', 'desc')->get();
    }
}
