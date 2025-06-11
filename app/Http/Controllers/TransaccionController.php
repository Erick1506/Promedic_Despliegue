<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Http\Services\TransaccionService;  // Importamos el servicio
use Illuminate\Http\Request;

class TransaccionController extends Controller
{
    protected $transaccionService;

    // Inyectamos el servicio de transacción
    public function __construct(TransaccionService $transaccionService)
    {
        $this->transaccionService = $transaccionService;  // Asignamos el servicio
    }

    // Lista todas las transacciones (solo delega a la capa de servicio si es necesario)
    public function index()
    {
        return $this->transaccionService->listarTransacciones();  // Delegamos al servicio
    }

    // Crea una nueva transacción
    public function store(Request $request)
    {
        $data = $request->validate([
            'Fecha_Transaccion' => 'nullable|date',
            'Cantidad' => 'nullable|integer',
            'Id_Administrador' => 'nullable|integer|exists:administrador,Id_Administrador',
            'Id_Producto' => 'nullable|integer|exists:producto,Id_Producto',
            'Id_Tipo_Transaccion' => 'nullable|integer|exists:tipo_transaccion,Id_Tipo_Transaccion',
        ]);

        // Delegamos la creación de la transacción al servicio
        $transaccion = $this->transaccionService->crearTransaccion($data);

        return response()->json($transaccion, 201);
    }

    // Crear transacción desde el producto (delegamos la lógica al servicio)
    public function storeFromProducto(Producto $producto, Request $request)
    {
        $data = $request->validate([
            'Id_Administrador' => 'nullable|integer|exists:administrador,Id_Administrador',
        ]);

        // Delegamos la creación de la transacción al servicio
        $this->transaccionService->registrarDesdeProducto($producto, $data);

        return response()->json(['message' => 'Transacción registrada correctamente'], 201);
    }

    // Muestra una transacción por ID
    public function show($id)
    {
        return $this->transaccionService->mostrarTransaccion($id);  // Delegamos la lógica
    }

    // Actualiza una transacción existente
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'Fecha_Transaccion' => 'nullable|date',
            'Cantidad' => 'nullable|integer',
            'Id_Administrador' => 'nullable|integer|exists:administrador,Id_Administrador',
            'Id_Producto' => 'nullable|integer|exists:producto,Id_Producto',
            'Id_Tipo_Transaccion' => 'nullable|integer|exists:tipo_transaccion,Id_Tipo_Transaccion',
        ]);

        // Delegamos la lógica de actualización al servicio
        $transaccion = $this->transaccionService->actualizarTransaccion($id, $data);

        return response()->json($transaccion);
    }

    // Elimina una transacción por ID
    public function destroy($id)
    {
        // Delegamos la eliminación al servicio
        $this->transaccionService->eliminarTransaccion($id);

        return response()->json(null, 204);
    }
}
