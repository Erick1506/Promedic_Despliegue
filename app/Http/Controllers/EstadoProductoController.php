<?php

namespace App\Http\Controllers;

use App\Models\EstadoProducto;
use Illuminate\Http\Request;

class EstadoProductoController extends Controller
{
    // Obtiene todos los estados de producto
    public function index()
    {
        return EstadoProducto::all();
    }

    // Crea un nuevo estado de producto
    public function store(Request $request)
    {
        $data = $request->validate([
            'Tipo_Estado_Producto' => 'nullable|string|max:45',
        ]);

        $estadoProducto = EstadoProducto::create($data);

        return response()->json($estadoProducto, 201);
    }

    // Muestra un estado de producto por ID
    public function show($id)
    {
        return EstadoProducto::findOrFail($id);
    }

    // Actualiza un estado de producto existente
    public function update(Request $request, $id)
    {
        $estadoProducto = EstadoProducto::findOrFail($id);

        $data = $request->validate([
            'Tipo_Estado_Producto' => 'nullable|string|max:45',
        ]);

        $estadoProducto->update($data);

        return response()->json($estadoProducto);
    }

    // Elimina un estado de producto por ID
    public function destroy($id)
    {
        EstadoProducto::findOrFail($id)->delete();

        return response()->json(null, 204);
    }
}
