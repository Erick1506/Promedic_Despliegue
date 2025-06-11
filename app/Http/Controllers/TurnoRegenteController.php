<?php

namespace App\Http\Controllers;

use App\Models\TurnoRegente;
use Illuminate\Http\Request;

class TurnoRegenteController extends Controller
{
    // Lista todos los turnos
    public function index()
    {
        return TurnoRegente::all();
    }

    // Crea un nuevo turno
    public function store(Request $request)
    {
        $data = $request->validate([
            'turno' => 'nullable|string|max:50',
        ]);

        $turno = TurnoRegente::create($data);

        return response()->json($turno, 201);
    }

    // Muestra un turno por ID
    public function show($id)
    {
        return TurnoRegente::findOrFail($id);
    }

    // Actualiza un turno existente
    public function update(Request $request, $id)
    {
        $turno = TurnoRegente::findOrFail($id);

        $data = $request->validate([
            'turno' => 'nullable|string|max:50',
        ]);

        $turno->update($data);

        return response()->json($turno);
    }

    // Elimina un turno por ID
    public function destroy($id)
    {
        TurnoRegente::findOrFail($id)->delete();

        return response()->json(null, 204);
    }
}
