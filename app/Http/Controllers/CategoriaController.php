<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        return Categoria::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'Nombre_Categoria' => 'nullable|string|max:45',
            'Descripcion_Categoria' => 'nullable|string|max:200',
        ]);

        $categoria = Categoria::create($data);

        return redirect()->route('productos.create')->with('success', 'categoria agregada exitosamente.');
    }

    public function show($id)
    {
        $categoria = Categoria::findOrFail($id);
        return $categoria;
    }

    public function update(Request $request, $id)
    {
        $categoria = Categoria::findOrFail($id);

        $data = $request->validate([
            'Nombre_Categoria' => 'nullable|string|max:45',
            'Descripcion_Categoria' => 'nullable|string|max:200',
        ]);

        $categoria->update($data);

        return response()->json($categoria);
    }

    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return response()->json(null, 204);
    }

    public function edit($id)
{
    $categoria = Categoria::findOrFail($id);
    return view('categorias.edit', compact('categoria'));
}
}
