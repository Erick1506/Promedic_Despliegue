<?php

namespace App\Http\Controllers;

use App\Models\TipoPromocion;
use Illuminate\Http\Request;

class TipoPromocionController extends Controller
{
    // Lista todos los tipos de promociones
    public function index()
    {
        return TipoPromocion::all();
    }

    // Crea un nuevo tipo de promoción
    public function store(Request $request)
    {
        $data = $request->validate([
            'Tipo_Promocion' => 'nullable|string|max:50',
        ]);

        $tipoPromocion = TipoPromocion::create($data);

        return response()->json($tipoPromocion, 201);
    }

    // Muestra un tipo de promoción por ID
    public function show($id)
    {
        return TipoPromocion::findOrFail($id);
    }

    // Actualiza un tipo de promoción existente
    public function update(Request $request, $id)
    {
        $tipoPromocion = TipoPromocion::findOrFail($id);

        $data = $request->validate([
            'Tipo_Promocion' => 'nullable|string|max:50',
        ]);

        $tipoPromocion->update($data);

        return response()->json($tipoPromocion);
    }

    // Elimina un tipo de promoción por ID
    public function destroy($id)
    {
        TipoPromocion::findOrFail($id)->delete();

        return response()->json(null, 204);
    }
}
