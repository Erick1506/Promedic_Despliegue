<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Regente;
use App\Models\Administrador;

class PasswordController extends Controller
{
    // Muestra el formulario para que el usuario ingrese su correo
    public function showEmailForm()
    {
        return view('auth.passwords.email'); // formulario con input correo
    }

    // Valida el correo y envía email con token
    public function checkEmail(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
        ]);

        $correo = $request->correo;

        // Buscar en Regente
        $user = Regente::where('Correo', $correo)->first();
        $tipo = 'regente';

        if (!$user) {
            // Buscar en Administrador
            $user = Administrador::where('Correo', $correo)->first();
            $tipo = 'admin';
        }

        if (!$user) {
            return back()->withErrors(['correo' => 'El correo no está registrado.']);
        }

        // Generar token seguro y expiración 1 hora
        $token = Str::random(60);
        $user->token_recuperacion = $token;
        $user->token_expiracion = Carbon::now()->addHour();
        $user->save();

        // Enviar correo con link
        $link = route('password.reset.form', [
            'correo' => $correo,
            'token' => $token,
            'tipo' => $tipo
        ]);

        Mail::send('emails.reset_password', ['link' => $link, 'nombre' => $user->Nombre], function($message) use ($correo) {
            $message->to($correo);
            $message->subject('Recuperación de contraseña');
        });

        return back()->with('status', 'Te enviamos un correo con el enlace para restablecer tu contraseña.');
    }

    // Mostrar formulario para restablecer contraseña (validando token)
    public function showResetForm(Request $request)
    {
        $correo = $request->correo;
        $token = $request->token;
        $tipo = $request->tipo;

        if (!$correo || !$token || !$tipo) {
            return redirect()->route('password.email.form')->withErrors(['token' => 'Enlace inválido']);
        }

        // Buscar usuario según tipo
        $user = null;
        if ($tipo === 'regente') {
            $user = Regente::where('Correo', $correo)->where('token_recuperacion', $token)->first();
        } elseif ($tipo === 'admin') {
            $user = Administrador::where('Correo', $correo)->where('token_recuperacion', $token)->first();
        }

        if (!$user) {
            return redirect()->route('password.email.form')->withErrors(['token' => 'Token inválido']);
        }

        // Verificar expiración token
        if (Carbon::now()->gt(Carbon::parse($user->token_expiracion))) {
            return redirect()->route('password.email.form')->withErrors(['token' => 'El enlace ha expirado']);
        }

        return view('auth.passwords.reset', compact('correo', 'token', 'tipo'));
    }

    // Procesar el cambio de contraseña
    public function resetPassword(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'tipo' => 'required|string',
            'token' => 'required|string',
            'password' => 'required|min:6|confirmed',
        ]);

        $correo = $request->correo;
        $tipo = $request->tipo;
        $token = $request->token;
        $passwordPlain = $request->password;

        // Buscar usuario según tipo y token
        $user = null;
        if ($tipo === 'regente') {
            $user = Regente::where('Correo', $correo)
                ->where('token_recuperacion', $token)
                ->first();
        } elseif ($tipo === 'admin') {
            $user = Administrador::where('Correo', $correo)
                ->where('token_recuperacion', $token)
                ->first();
        }

        if (!$user) {
            return redirect()->route('password.email.form')->withErrors(['token' => 'Token inválido o usuario no encontrado']);
        }

        // Verificar expiración token
        if (Carbon::now()->gt(Carbon::parse($user->token_expiracion))) {
            return redirect()->route('password.email.form')->withErrors(['token' => 'El enlace ha expirado']);
        }

        // Actualizar contraseña
        if ($tipo === 'regente') {
            $user->Contraseña_Encriptada = Hash::make($passwordPlain);
        } else {
            // Para admin, usa mutator para encriptar automáticamente
            $user->Contraseña = $passwordPlain;
        }

        // Limpiar token y expiración
        $user->token_recuperacion = null;
        $user->token_expiracion = null;

        $user->save();

        return redirect()->route('login.form')->with('status', 'Contraseña actualizada correctamente.');
    }
}
