<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Regente;
use App\Models\Administrador;

class VerificarSesion
{
   public function handle(Request $request, Closure $next)
{
    if (session()->has('regente_id')) {
        $regente = Regente::find(session('regente_id'));
        if ($regente) {
            view()->share('usuario_autenticado', $regente);
            view()->share('rol_usuario', 'regente');

            $response = $next($request);
            return $this->sinCache($response);
        }
    }

    if (session()->has('admin_id')) {
        $admin = Administrador::find(session('admin_id'));
        if ($admin) {
            view()->share('usuario_autenticado', $admin);
            view()->share('rol_usuario', 'admin');

            $response = $next($request);
            return $this->sinCache($response);
        }
    }

    return redirect('/login');
}

protected function sinCache($response)
{
    return $response->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
                    ->header('Pragma', 'no-cache')
                    ->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
}

}
