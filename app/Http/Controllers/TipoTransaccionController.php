<?php

namespace App\Http\Controllers;

use App\Models\TipoTransaccion;
use Illuminate\Http\Request;

class TipoTransaccionController extends Controller
{
    // Lista todos los tipos de transacciones
    public function index()
    {
        return TipoTransaccion::all();
    }

    // Crea un nuevo tipo de transacción
    public function store(Request $request)
    {
        $data = $request->validate([
            'Tipo_Transaccion' => 'nullable|string|max:45',
        ]);

        $tipoTransaccion = TipoTransaccion::create($data);

        return response()->json($tipoTransaccion, 201);
    }

    // Muestra un tipo de transacción por ID
    public function show($id)
    {
        return TipoTransaccion::findOrFail($id);
    }

    // Actualiza un tipo de transacción existente
    public function update(Request $request, $id)
    {
        $tipoTransaccion = TipoTransaccion::findOrFail($id);

        $data = $request->validate([
            'Tipo_Transaccion' => 'nullable|string|max:45',
        ]);

        $tipoTransaccion->update($data);

        return response()->json($tipoTransaccion);
    }

    // Elimina un tipo de transacción por ID
    public function destroy($id)
    {
        TipoTransaccion::findOrFail($id)->delete();

        return response()->json(null, 204);
    }
}
