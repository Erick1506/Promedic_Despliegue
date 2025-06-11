<?php
// app/Http/Controllers/EstadisticasController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\EstadisticasService;

class EstadisticasController extends Controller
{
    protected $estadisticasService;

    public function __construct(EstadisticasService $estadisticasService)
    {
        $this->estadisticasService = $estadisticasService;
    }

    public function index(Request $request)
    {
        // Verificar sesión de administrador
        if (!session()->has('admin_id')) {
            return redirect()->route('dashboard')->with('error_js', 'Ups, no tienes permisos para acceder a esta página.');
        }


        // Obtener todos los productos
        $productos = $this->estadisticasService->obtenerProductos();

        // Etiquetas para las semanas
        $labels = ["Semana 1", "Semana 2", "Semana 3", "Semana 4", "Semana 5"];

        // Inicializar datos de ventas semanal
        $ventasData = [0, 0, 0, 0, 0];

        // Si se ha seleccionado un producto, obtener las ventas semanales
        if ($request->filled('producto')) {
            $ventasData = $this->estadisticasService->obtenerVentasSemanalesPorProducto($request->input('producto'));
        }

        // Obtener todas las categorías
        $categorias = $this->estadisticasService->obtenerCategorias();

        $clasificaciones = null;
        $productos_clasificacion = collect();


        // Si se ha seleccionado una categoría, obtener clasificaciones relacionadas
        if ($request->filled('categoria_id')) {
            $clasificaciones = $this->estadisticasService->obtenerClasificacionesPorCategoria($request->input('categoria_id'));

            // Si también se ha seleccionado una clasificación, obtener productos de esa clasificación
            if ($request->filled('clasificacion_id')) {
                $productos_clasificacion = $this->estadisticasService->obtenerProductosPorClasificacion($request->input('clasificacion_id'));
            }
        }

        // Obtener productos más vendidos y menos vendidos
        $productos_vendidos = $this->estadisticasService->obtenerProductosMasVendidos();
        $productos_menos_vendidos = $this->estadisticasService->obtenerProductosMenosVendidos();

        // Pasar todo a la vista
        return view('estadisticas.index', compact(
            'productos',
            'ventasData',
            'labels',
            'categorias',
            'clasificaciones',
            'productos_clasificacion',
            'productos_vendidos',
            'productos_menos_vendidos'
        ));
    }
}
