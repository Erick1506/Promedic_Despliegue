<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use Illuminate\Http\Request;
use App\Http\Services\NotificationService;



class NotificacionController extends Controller
{
    // Lista todas las notificaciones
    public function index()
    {
        return Notificacion::all();
    }

    // Crea una nueva notificación
    public function store(Request $request)
    {
        $data = $request->validate([
            'mensaje' => 'required|string',
            'fecha_creacion' => 'nullable|date',
        ]);

        $notificacion = Notificacion::create($data);

        return response()->json($notificacion, 201);
    }

    // Muestra una notificación por ID
    public function show($id)
    {
        return Notificacion::findOrFail($id);
    }

    // Actualiza una notificación existente
    public function update(Request $request, $id)
    {
        $notificacion = Notificacion::findOrFail($id);

        $data = $request->validate([
            'mensaje' => 'required|string',
            'fecha_creacion' => 'nullable|date',
        ]);

        $notificacion->update($data);

        return response()->json($notificacion);
    }

    // Elimina una notificación por ID
    public function destroy($id)
    {
        Notificacion::findOrFail($id)->delete();

        return response()->json(null, 204);
    }



    public function __construct(NotificationService $service)
    {
        $this->notificationService = $service;
    }

    protected $notificationService;

   
    public function productosCriticos()
    {
        $productos = $this->notificationService->productosCriticos();
        return response()->json($productos);
    }

    public function crearNotificacion(Request $request)
    {
        $request->validate(['mensaje' => 'required|string']);
        $notificacion = $this->notificationService->crearNotificacion($request->mensaje);
        return response()->json($notificacion, 201);
    }

    public function enviarMensajeARegente(Request $request)
    {
        $request->validate(['mensaje' => 'required|string']);
        $mensaje = $this->notificationService->enviarMensajeARegente($request->mensaje);
        return response()->json($mensaje, 201);
    }

    public function obtenerMensajesARegente()
    {
        $mensajes = $this->notificationService->obtenerMensajesARegente();
        return response()->json($mensajes);
    }

    public function obtenerNotificaciones()
    {
        $notificaciones = $this->notificationService->obtenerNotificaciones();
        return response()->json($notificaciones);
    }

}
