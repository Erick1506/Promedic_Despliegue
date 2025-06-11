<?php

namespace App\Http\Controllers;

use App\Models\FormulaMedica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FormulaMedicaController extends Controller
{
    // Lista todas las fórmulas médicas
    public function index()
    {
        $formulas = FormulaMedica::all();
        return view('formulas_medicas.index', compact('formulas'));
    }

    // Muestra el formulario para crear una nueva fórmula médica
    public function create()
    {
        return view('formulas_medicas.create');
    }

    // Registra una nueva fórmula médica
    public function store(Request $request)
    {
        $data = $request->validate([
            'Nombre_Paciente' => 'required|string|max:45',
            'Identificacion_Paciente' => 'required|integer',
            'Fecha_Insercion' => 'required|date',
            'Id_Administrador' => 'required|integer|exists:administrador,Id_Administrador',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // validación correcta
        ]);

        // Guardar la imagen en public/img/formulas
        if ($request->hasFile('imagen')) {
            $archivo = $request->file('imagen');
            $nombreImagen = time() . '_' . $archivo->getClientOriginalName();
            $archivo->move(public_path('img/formulas'), $nombreImagen);

            $data['Imagen'] = 'img/formulas/' . $nombreImagen;
        }

        FormulaMedica::create($data);

        return redirect()->route('recetas.index')->with('success', 'Fórmula médica creada exitosamente.');
    }

    // Muestra el formulario para editar una fórmula médica existente
    public function edit($id)
    {
        $formula = FormulaMedica::findOrFail($id);
        return view('formulas_medicas.edit', compact('formula'));
    }

    // Actualiza una fórmula médica existente
    public function update(Request $request, $id)
    {
        $formulaMedica = FormulaMedica::findOrFail($id);

        $data = $request->validate([
            'Nombre_Paciente' => 'required|string|max:45',
            'Identificacion_Paciente' => 'required|integer',
            'Fecha_Insercion' => 'required|date',
            'Id_Administrador' => 'required|integer|exists:administrador,Id_Administrador',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Si se sube una nueva imagen, reemplazar la anterior
        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior si existe
            if ($formulaMedica->Imagen && file_exists(public_path($formulaMedica->Imagen))) {
                unlink(public_path($formulaMedica->Imagen));
            }

            $archivo = $request->file('imagen');
            $nombreImagen = time() . '_' . $archivo->getClientOriginalName();
            $archivo->move(public_path('img/formulas'), $nombreImagen);

            $data['Imagen'] = 'img/formulas/' . $nombreImagen;
        }

        $formulaMedica->update($data);

        return redirect()->route('recetas.index')->with('success', 'Fórmula médica actualizada exitosamente.');
    }

    // Elimina una fórmula médica por ID
    public function destroy($id)
    {
        $formula = FormulaMedica::findOrFail($id);

        // Eliminar la imagen del servidor si existe
        if ($formula->Imagen && file_exists(public_path($formula->Imagen))) {
            unlink(public_path($formula->Imagen));
        }

        $formula->delete();

        return redirect()->route('recetas.index')->with('success', 'Fórmula médica eliminada exitosamente.');
    }
}
