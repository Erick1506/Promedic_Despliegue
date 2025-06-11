<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaccion;
use App\Models\Producto;
use App\Models\Comprobante;
use App\Models\Categoria;
use App\Models\Clasificacion;
use Illuminate\Support\Facades\DB;
use TCPDF;



class ReporteController extends Controller
{
    // Mostrar la vista con transacciones, productos y cmprobantes
    public function index()
    {
        $transacciones = Transaccion::with([
            'producto.marca',
            'producto.proveedor',
            'tipoTransaccion'

        ])
            ->orderBy('fecha_transaccion', 'desc')
            ->get();

        $productos = Producto::with(['marca', 'proveedor', 'EstadoProducto'])->get();

        $comprobantes = Comprobante::with(['regente', 'producto'])->get();

        $categorias = Categoria::all();

        $clasificaciones = Clasificacion::all();

        return view('informes.inventario', compact(
            'transacciones',
            'productos',
            'comprobantes',
            'categorias',
            'clasificaciones'
        ));
    }

    // Generar el PDF filtrando por fechas y tipo de informe
    public function generarPDF(Request $request)
    {
        $fecha_inicio = $request->input('fecha_inicio');
        $fecha_fin = $request->input('fecha_fin');
        $filtro = $request->input('tipo_informe');
        $categoria_id = $request->input('categoria_id');
        $clasificacion_id = $request->input('clasificacion_id');
        $producto_id = $request->input('producto_id');

        $data = compact('fecha_inicio', 'fecha_fin', 'filtro');

        if ($filtro === 'producto' && $producto_id) {
            $producto = Producto::with(['categoria', 'clasificacion', 'marca', 'proveedor'])->find($producto_id);

            $ventas = DB::table('transacciones')->where('Id_Producto', $producto_id)->where('Id_Tipo_Transaccion', 2)->whereBetween('Fecha_Transaccion', [$fecha_inicio, $fecha_fin])->sum('Cantidad');
            $entradas = DB::table('transacciones')->where('Id_Producto', $producto_id)->where('Id_Tipo_Transaccion', 1)->whereBetween('Fecha_Transaccion', [$fecha_inicio, $fecha_fin])->sum('Cantidad');

            $data += compact('producto', 'ventas', 'entradas');

        } elseif ($filtro === 'categoria' && $categoria_id) {
            $categoria = Categoria::find($categoria_id);
            $productos = Producto::where('Id_Categoria', $categoria_id)->get();

            foreach ($productos as $producto) {
                $producto->ventas = DB::table('transacciones')->where('Id_Producto', $producto->Id_Producto)->where('Id_Tipo_Transaccion', 2)->whereBetween('Fecha_Transaccion', [$fecha_inicio, $fecha_fin])->sum('Cantidad');
                $producto->entradas = DB::table('transacciones')->where('Id_Producto', $producto->Id_Producto)->where('Id_Tipo_Transaccion', 1)->whereBetween('Fecha_Transaccion', [$fecha_inicio, $fecha_fin])->sum('Cantidad');
            }

            $data += compact('categoria', 'productos');

        } elseif ($filtro === 'clasificacion' && $clasificacion_id) {
            $clasificacion = Clasificacion::find($clasificacion_id);
            $productos = Producto::where('Id_Clasificacion', $clasificacion_id)->get();

            foreach ($productos as $producto) {
                $producto->ventas = DB::table('transacciones')->where('Id_Producto', $producto->Id_Producto)->where('Id_Tipo_Transaccion', 2)->whereBetween('Fecha_Transaccion', [$fecha_inicio, $fecha_fin])->sum('Cantidad');
                $producto->entradas = DB::table('transacciones')->where('Id_Producto', $producto->Id_Producto)->where('Id_Tipo_Transaccion', 1)->whereBetween('Fecha_Transaccion', [$fecha_inicio, $fecha_fin])->sum('Cantidad');
            }

            $data += compact('clasificacion', 'productos');
        }

        // Cargar la vista Blade con los datos
        $html = view('informes.pdf_inventario', $data)->render();

        // Generar PDF desde HTML
        $pdf = new TCPDF();
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 10);
        $pdf->writeHTML($html, true, false, true, false, '');

        return response($pdf->Output('informe.pdf', 'S'), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="informe.pdf"');
    }
}
