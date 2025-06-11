<?php

namespace App\Http\Controllers;

use App\Models\Clasificacion;
use Illuminate\Http\Request;

class ClasificacionController extends Controller
{
    // Obtiene todos los registros de clasificaciones
    public function index()
    {
        return Clasificacion::all();
    }

    // Crea un nuevo registro de clasificacion
    public function store(Request $request)
    {
        $data = $request->validate([
            'Nombre_Clasificacion' => 'nullable|string|max:45',
            'Descripcion_Clasificacion' => 'nullable|string|max:2000',
            'Id_Categoria' => 'nullable|integer|exists:categoria,Id_Categoria',
        ]);

        $clasificacion = Clasificacion::create($data);

        return redirect()->route('productos.create')->with('success', 'clasificacion agregada exitosamente.');
    }

    // Muestra un registro específico de clasificacion por su ID
    public function show($id)
    {
        return Clasificacion::findOrFail($id);
    }

    // Actualiza información de un registro existente de clasificacion
    public function update(Request $request, $id)
    {
        $clasificacion = Clasificacion::findOrFail($id);

        $data = $request->validate([
            'Nombre_Clasificacion' => 'nullable|string|max:45',
            'Descripcion_Clasificacion' => 'nullable|string|max:2000',
            'Id_Categoria' => 'nullable|integer|exists:categoria,Id_Categoria',
        ]);

        $clasificacion->update($data);

        return response()->json($clasificacion);
    }

    // Elimina un registro de clasificacion por ID
    public function destroy($id)
    {
        Clasificacion::findOrFail($id)->delete();

        return response()->json(null, 204);
    }

    public function edit($id)
    {
        $clasificacion = Clasificacion::findOrFail($id);
        return view('clasificaciones.edit', compact('clasificacion'));
    }

}
