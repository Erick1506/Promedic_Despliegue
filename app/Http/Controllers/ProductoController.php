<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Services\ProductoService;
use App\Http\Services\TransaccionService;
use App\Http\Services\PromocionService;
use App\Http\Services\VentaProductoService;
use App\Models\Marca;
use App\Models\Categoria;
use App\Models\Clasificacion;
use App\Models\EstadoProducto;
use App\Models\Proveedor;
use App\Models\TipoPromocion;

class ProductoController extends Controller
{
    protected $productoService;
    protected $ventaProductoService;

    public function __construct(
        ProductoService $productoService,
        VentaProductoService $ventaProductoService
    ) {
        $this->productoService = $productoService;
        $this->ventaProductoService = $ventaProductoService;
    }

    public function index()
    {
        $productos = $this->productoService->obtenerTodos();
        return view('dashboard', compact('productos'));
    }

    public function create()
    {
        $marcas = Marca::all();
        $categorias = Categoria::all();
        $clasificaciones = Clasificacion::all();
        $estados = EstadoProducto::all();
        $proveedores = Proveedor::all();
        $tiposPromociones = TipoPromocion::all();

        return view('productos.create', compact(
            'marcas', 'categorias', 'clasificaciones', 'estados', 'proveedores', 'tiposPromociones'
        ));
    }

    public function store(Request $request)
    {
        $result = $this->productoService->crearProducto($request);

        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']], 500);
        }

        return redirect()->route('dashboard')->with('success', 'Producto creado exitosamente.');
    }

    public function show($id)
    {
        return $this->productoService->obtenerPorId($id);
    }

    public function edit($id)
    {
        $producto = $this->productoService->obtenerPorId($id);
        $marcas = Marca::all();
        $categorias = Categoria::all();
        $clasificaciones = Clasificacion::all();
        $estados = EstadoProducto::all();
        $proveedores = Proveedor::all();
        $tiposPromociones = TipoPromocion::all();

        return view('productos.edit', compact(
            'producto', 'marcas', 'categorias', 'clasificaciones', 'estados', 'proveedores', 'tiposPromociones'
        ));
    }

    public function update(Request $request, $id)
    {
        $result = $this->productoService->actualizarProducto($request, $id);

        if (isset($result['error'])) {
            return redirect()->back()->withErrors(['Cantidad_Stock' => $result['error']]);
        }

        return redirect()->route('dashboard')->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $this->productoService->eliminarProducto($id);
        return response()->json(null, 204);
    }

    public function vender(Request $request)
    {
        $validated = $request->validate([
            'idProducto' => 'required|exists:producto,Id_Producto',
            'cantidad' => 'required|integer|min:1',
            'id_regente' => 'required|exists:regente,Id_Regente',
        ]);

        try {
            $comprobante = $this->ventaProductoService->vender($validated);
            session()->flash('venta_success', 'Venta realizada correctamente. Comprobante ID: ' . $comprobante->Id_Comprobante);
        } catch (\Throwable $e) {
            session()->flash('venta_error', 'Error al vender producto: ' . $e->getMessage());
        }

        return back();
    }
}
