<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    // Lista todas las marcas
    public function index()
    {
        return Marca::all();
    }

    // Crea una nueva marca
    public function store(Request $request)
    {
        $data = $request->validate([
            'Marca_Producto' => 'nullable|string|max:45',
        ]);

        $marca = Marca::create($data);

        return redirect()->route('productos.create')->with('success', 'marca agregada exitosamente.');

    }

    // Muestra una marca por ID
    public function show($id)
    {
        return Marca::findOrFail($id);
    }

    // Actualiza una marca existente
    public function update(Request $request, $id)
    {
        $marca = Marca::findOrFail($id);

        $data = $request->validate([
            'Marca_Producto' => 'nullable|string|max:45',
        ]);

        $marca->update($data);

        return response()->json($marca);
    }

    // Elimina una marca por ID
    public function destroy($id)
    {
        Marca::findOrFail($id)->delete();

        return response()->json(null, 204);
    }
}
