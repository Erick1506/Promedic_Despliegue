<?php
// app/Services/EstadisticasService.php

namespace App\Http\Services;

use App\Models\Producto;
use App\Models\Comprobante;
use App\Models\Categoria;
use App\Models\Clasificacion;
use Illuminate\Support\Facades\DB;

class EstadisticasService
{
    public function obtenerProductos()
    {
        return Producto::all(); // Verifica que en Producto model tengas: protected $table = 'producto';
    }

    public function obtenerVentasSemanalesPorProducto($productoId)
    {
        $ventasData = [0, 0, 0, 0, 0]; // 5 semanas
        $ventas = Comprobante::selectRaw('WEEK(Fecha_Venta, 1) - WEEK(DATE_FORMAT(NOW(), "%Y-%m-01"), 1) + 1 AS Semana, SUM(Cantidad) AS Total_Ventas')
            ->where('Id_Producto', $productoId)
            ->whereMonth('Fecha_Venta', now()->month)
            ->whereYear('Fecha_Venta', now()->year)
            ->groupBy('Semana')
            ->orderBy('Semana')
            ->get();

        foreach ($ventas as $venta) {
            $index = intval($venta->Semana) - 1;
            if ($index >= 0 && $index < count($ventasData)) {
                $ventasData[$index] = intval($venta->Total_Ventas);
            }
        }

        return $ventasData;
    }

    public function obtenerCategorias()
    {
        return Categoria::all(); // Verifica que el modelo Categoria tenga protected $table = 'categoria';
    }

    public function obtenerClasificacionesPorCategoria($categoriaId)
    {
        return Clasificacion::where('Id_Categoria', $categoriaId)->get(); // Igual para Clasificacion model
    }

    public function obtenerProductosPorClasificacion($clasificacionId)
    {
        return Producto::where('Id_Clasificacion', $clasificacionId)->get();
    }

    public function obtenerProductosMasVendidos($limite = 5)
    {
        return Comprobante::select('producto.Nombre_Producto', DB::raw('SUM(comprobante.Cantidad) as Total_Ventas'))
            ->join('producto', 'comprobante.Id_Producto', '=', 'producto.Id_Producto')
            ->groupBy('comprobante.Id_Producto', 'producto.Nombre_Producto')
            ->orderByDesc('Total_Ventas')
            ->limit($limite)
            ->get();
    }

    public function obtenerProductosMenosVendidos($limite = 5)
    {
        return Comprobante::select('producto.Nombre_Producto', DB::raw('SUM(comprobante.Cantidad) as Total_Ventas'))
            ->join('producto', 'comprobante.Id_Producto', '=', 'producto.Id_Producto')
            ->groupBy('comprobante.Id_Producto', 'producto.Nombre_Producto')
            ->orderBy('Total_Ventas')
            ->limit($limite)
            ->get();
    }
}

