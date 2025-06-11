<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\PromocionService;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\TipoPromocion;
use App\Models\Clasificacion;
use App\Models\Promocion;

class PromocionController extends Controller
{
    protected $promocionService;

    public function __construct(PromocionService $promocionService)
    {
        $this->promocionService = $promocionService;
    }

    public function index(Request $request)
    {
        $query = Promocion::with(['producto', 'tipoPromocion']);

        if ($request->filled('tipo_promocion')) {
            $query->whereHas('tipoPromocion', function ($q) use ($request) {
                $q->where('Tipo_Promocion', 'like', '%' . $request->tipo_promocion . '%');
            });
        }

        $promociones = $query->get();

        return view('promociones.index', [
            'promociones' => $promociones,
            'searchTerm' => $request->tipo_promocion,
        ]);
    }

    public function create()
    {
        $categorias = Categoria::all();
        $clasificaciones = Clasificacion::all();
        $tipos = TipoPromocion::all();
        $productos = Producto::all();

        return view('promociones.create', compact('categorias', 'tipos', 'clasificaciones', 'productos'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'Id_Administrador' => 'nullable|integer|exists:administrador,Id_Administrador',
            'Id_Producto' => 'required|integer|exists:producto,Id_Producto',
            'Id_Tipo_Promocion' => 'required|integer|exists:tipo_promocion,Id_Tipo_Promocion',
            'Fecha_Inicio' => 'nullable|date',
            'Fecha_Fin' => 'nullable|date',
            'Descuento' => 'required_if:Id_Tipo_Promocion,2|integer',
        ]);

        if (!isset($data['Id_Administrador'])) {
            $data['Id_Administrador'] = 1;
        }
        ;

        if (!empty($data['Fecha_Inicio']) && !empty($data['Fecha_Fin'])) {
            if ($data['Fecha_Fin'] < $data['Fecha_Inicio']) {
                return redirect()->back()->withInput()->withErrors([
                    'Fecha_Fin' => 'La fecha de fin no puede ser anterior a la fecha de inicio.',
                ]);
            }
        }

        $resultado = $this->promocionService->crear($data);

        if ($resultado['status'] === 'error') {
            return redirect()->back()->withInput()->withErrors(['msg' => $resultado['message']]);
        }

        return redirect()->route('promociones.index')->with('msg', 'Promoción creada exitosamente.');
    }

    public function show($id)
    {
        return response()->json($this->promocionService->mostrar($id));
    }

    public function edit($id)
    {
        $promocion = $this->promocionService->mostrar($id);
        $categorias = Categoria::all();
        $clasificaciones = Clasificacion::all();
        $tipos = TipoPromocion::all();
        $productos = Producto::all();

        return view('promociones.edit', compact('promocion', 'categorias', 'tipos', 'clasificaciones', 'productos'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'Id_Administrador' => 'nullable|integer|exists:administrador,Id_Administrador',
            'Id_Producto' => 'nullable|integer|exists:producto,Id_Producto',
            'Id_Tipo_Promocion' => 'nullable|integer|exists:tipo_promocion,Id_Tipo_Promocion',
            'Fecha_Inicio' => 'nullable|date',
            'Fecha_Fin' => 'nullable|date',
            'Descuento' => 'required_if:Id_Tipo_Promocion,2|integer',
        ]);

        $promocion = $this->promocionService->actualizar($id, $data);

        return redirect()->route('promociones.index')->with('msg', 'Promoción actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $this->promocionService->eliminar($id);

        return redirect()->route('promociones.index')->with('msg', 'Promoción eliminada exitosamente.');
    }
}
