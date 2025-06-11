<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    // Lista todos los proveedores
    public function index(Request $request)
    {
        // Obtener la búsqueda si existe
        $busqueda = $request->input('buscar_proveedor', '');
        $proveedores = Proveedor::where('Nombre_Proveedor', 'LIKE', "%$busqueda%")->get();

        return view('proveedores.index', compact('proveedores'));
    }

    // Crea un nuevo proveedor
    public function store(Request $request)
    {
        $data = $request->validate([
            'Nombre_Proveedor' => 'nullable|string|max:45',
            'Direccion_Proveedor' => 'nullable|string|max:45',
            'Correo' => 'nullable|string|email|max:45',
            'Telefono' => 'nullable|numeric',
            'Id_Administrador' => 1,
        ]);

        Proveedor::create($data);

        // Redirigir a la lista de proveedores
        return redirect()->route('proveedores.index')->with('success', 'Proveedor agregado exitosamente.');
    }

    // Muestra un proveedor por ID
    public function show($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        return view('proveedores.show', compact('proveedor'));
    }

    // Actualiza un proveedor existente
    public function update(Request $request, $id)
    {
        $proveedor = Proveedor::findOrFail($id);

        $data = $request->validate([
            'Nombre_Proveedor' => 'nullable|string|max:45',
            'Direccion_Proveedor' => 'nullable|string|max:45',
            'Correo' => 'nullable|string|email|max:45',
            'Telefono' => 'nullable|numeric',
            'Id_Administrador' => 'nullable|integer|exists:administrador,Id_Administrador',
        ]);

        $proveedor->update($data);

        // Redirigir a la lista de proveedores
        return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado exitosamente.');
    }

    // Elimina un proveedor por ID
    public function destroy($id)
    {
        Proveedor::findOrFail($id)->delete();

        // Redirigir a la lista de proveedores
        return redirect()->route('proveedores.index')->with('success', 'Proveedor eliminado exitosamente.');
    }

    public function create()
    {
        return view('proveedores.create'); // Asegúrate de tener esta vista
    }

    public function edit($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        return view('proveedores.edit', compact('proveedor'));
    }

}
