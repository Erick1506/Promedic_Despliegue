<?php

namespace App\Http\Controllers;

use App\Models\Regente;
use Illuminate\Http\Request;
use App\models\TurnoRegente;

class RegenteController extends Controller
{
    // Lista todos los regentes
    public function index(Request $request)
    {

        // Verificar sesión de administrador
        if (!session()->has('admin_id')) {
            return redirect()->route('dashboard')->with('error_js', 'Ups, no tienes permisos para acceder a esta página.');
        }



        $busqueda = $request->input('buscar_regente', '');
        $regentes = Regente::with('turno')->where('Nombre', 'LIKE', "%$busqueda%")->get();
        $turnos = TurnoRegente::all();
        return view('regentes.index', compact('regentes', 'turnos'));
    }

    // Crea un nuevo regente
    public function store(Request $request)
    {
        $data = $request->validate([
            'Nombre' => 'nullable|string|max:45',
            'Apellido' => 'nullable|string|max:45',
            'DNI' => 'nullable|integer',
            'Fecha_Contratacion' => 'nullable|date',
            'Licencia' => 'nullable|integer',
            'Correo' => 'nullable|string|email|max:45',
            'Telefono' => 'nullable|numeric',
            'Contraseña_Encriptada' => 'required',
            'Id_Turno' => 'nullable|integer|exists:turno_regente,Id_Turno',
            'token_recuperacion' => 'nullable|string|max:255',
            'token_expiracion' => 'nullable|date',
        ]);

        

        $regente = Regente::create($data);

        return redirect()->route('regentes.index')->with('success', 'regente agregado exitosamente.');
    }

    // Muestra un regente por ID
    public function show($id)
    {
        return Regente::findOrFail($id);
    }

    // Actualiza un regente existente
    public function update(Request $request, $id)
    {
        $regente = Regente::findOrFail($id);

        $data = $request->validate([
            'Nombre' => 'nullable|string|max:45',
            'Apellido' => 'nullable|string|max:45',
            'DNI' => 'nullable|integer',
            'Fecha_Contratacion' => 'nullable|date',
            'Licencia' => 'nullable|integer',
            'Correo' => 'nullable|string|email|max:45',
            'Telefono' => 'nullable|numeric',
            'Contraseña_Encriptada' => 'sometimes|required',
            'Id_Turno' => 'nullable|integer|exists:turno_regente,Id_Turno',
            'token_recuperacion' => 'nullable|string|max:255',
            'token_expiracion' => 'nullable|date',
        ]);

        $regente->actualizarConPassword($data);

        return redirect()->route('regentes.index')->with('success', 'regente Actualizado exitosamente.');
    }

    // Elimina un regente por ID
    public function destroy($id)
    {
        Regente::findOrFail($id)->delete();

        return response()->json(null, 204);
    }
    public function create()
    {
        $turnos = TurnoRegente::all(); // Obtener los turnos
        return view('regentes.create', compact('turnos'));
    }

    public function edit($id)
    {
        $regente = Regente::findOrFail($id);
        $turnos = TurnoRegente::all();
        return view('regentes.edit', compact('regente', 'turnos'));
    }

}
