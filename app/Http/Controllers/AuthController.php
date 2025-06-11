<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Regente; 
use App\Models\Administrador; 

class AuthController extends Controller
{
    // Muestra el formulario de inicio de sesión
    public function showLoginForm()
    {
        return view('auth.login'); // Retorna la vista de login
    }

    // Procesa el inicio de sesión
    public function login(Request $request)
    {
        // Validación de los datos recibidos
        $request->validate([
            'correo' => 'required|email',
            'contraseña' => 'required|string',
        ]);

        // Busca el regente por correo
        $regente = Regente::where('Correo', $request->correo)->first();

        if ($regente) {
            // Verifica la contraseña
            if (Hash::check($request->contraseña, $regente->Contraseña_Encriptada)) {
                // Guarda en sesión
                session(['regente_id' => $regente->Id_Regente]);
                session(['nombre_regente' => $regente->Nombre]);
                return redirect('/dashboard'); // Redirige al dashboard
            } else {
                return back()->withErrors(['contraseña' => 'Contraseña incorrecta.']);
            }
        }

        // Busca el administrador por correo
        $admin = Administrador::where('Correo', $request->correo)->first();

        if ($admin) {
            // Verifica la contraseña
            if (Hash::check($request->contraseña, $admin->Contraseña)) {
                // Guarda en sesión
                session(['admin_id' => $admin->Id_Administrador]);
                session(['nombre_admin' => $admin->Nombre]);
                return redirect('/dashboard'); // Redirige al dashboard
            } else {
                return back()->withErrors(['contraseña' => 'Contraseña incorrecta.']);
            }
        }

        return back()->withErrors(['correo' => 'El correo no está registrado.']);
    }

    // Cierra sesión
   public function logout(Request $request)
{
    session()->flush(); // Elimina todos los datos de sesión
    return redirect()->route('login.form')->with('success', 'Sesión cerrada correctamente');
}

}
