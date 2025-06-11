<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Clasificacion;
use App\Models\Regente;

class DashboardController extends Controller
{
    public function __construct()
    {
        
        // Esto se aplica a todas las respuestas de este controlador
        \Illuminate\Support\Facades\Response::macro('nocache', function ($content) {
            return response($content)
                ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
                ->header('Pragma', 'no-cache')
                ->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
        });
    }
    public function index()
    {
        $productos = Producto::with(['marca', 'estadoProducto', 'categoria', 'clasificacion'])->get();
        $categorias = Categoria::all();
        $clasificaciones = Clasificacion::all();
        $regentes = Regente::all();

        $view = view('dashboard', compact('productos', 'categorias', 'clasificaciones', 'regentes'));

        return response($view)
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
    }

}
