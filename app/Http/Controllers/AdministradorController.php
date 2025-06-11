<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    // Crear un nuevo administrador
    public function store(Request $request)
    {
        $data = $request->validate([
            'Nombre' => 'nullable|string|max:45',
            'Apellido' => 'nullable|string|max:45',
            'Correo' => 'nullable|email|max:45',
            'Telefono' => 'nullable|numeric',
            'token_recuperacion' => 'nullable|string|max:255',
            'token_expiracion' => 'nullable|date',
            'Contraseña' => 'required|string|max:255',
        ]);

        $admin = Administrador::create($data);

        return response()->json($admin, 201);
    }

    // Leer todos los administradores
    public function index()
    {
        return response()->json(Administrador::all(), 200);
    }

    // Leer un administrador específico
    public function show($id)
    {
        $admin = Administrador::findOrFail($id);
        return response()->json($admin, 200);
    }

    // Actualizar un administrador
    public function update(Request $request, $id)
    {
        $admin = Administrador::findOrFail($id);

        $data = $request->validate([
            'Nombre' => 'nullable|string|max:45',
            'Apellido' => 'nullable|string|max:45',
            'Correo' => 'nullable|email|max:45',
            'Telefono' => 'nullable|numeric',
            'token_recuperacion' => 'nullable|string|max:255',
            'token_expiracion' => 'nullable|date',
            'Contraseña' => 'sometimes|required|string|max:255',
        ]);

        $admin->update($data);

        return response()->json($admin, 200);
    }

    // Eliminar un administrador
    public function destroy($id)
    {
        $admin = Administrador::findOrFail($id);
        $admin->delete();

        return response()->json(null, 204);
    }
}
