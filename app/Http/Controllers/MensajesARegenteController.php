<?php

namespace App\Http\Controllers;

use App\Models\MensajesARegente;
use Illuminate\Http\Request;

class MensajesARegenteController extends Controller
{
    // Lista todos los mensajes a regente
    public function index()
    {
        return MensajesARegente::all();
    }

    // Crea un nuevo mensaje a regente
    public function store(Request $request)
    {
        $data = $request->validate([
            'mensaje' => 'required|string',
            'fecha' => 'nullable|date',
        ]);

        $mensaje = MensajesARegente::create($data);

        return response()->json($mensaje, 201);
    }

    // Muestra un mensaje por ID
    public function show($id)
    {
        return MensajesARegente::findOrFail($id);
    }

    // Actualiza un mensaje existente
    public function update(Request $request, $id)
    {
        $mensaje = MensajesARegente::findOrFail($id);

        $data = $request->validate([
            'mensaje' => 'required|string',
            'fecha' => 'nullable|date',
        ]);

        $mensaje->update($data);

        return response()->json($mensaje);
    }

    // Elimina un mensaje por ID
    public function destroy($id)
    {
        MensajesARegente::findOrFail($id)->delete();

        return response()->json(null, 204);
    }
}
