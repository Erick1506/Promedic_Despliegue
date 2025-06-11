<?php

namespace App\Http\Services;

use App\Models\Producto;
use Illuminate\Http\Request;
use App\Http\Services\TransaccionService;
use App\Http\Services\PromocionService;
use Illuminate\Validation\Rule;

class ProductoService
{
    protected $transaccionService;
    protected $promocionService;

    public function __construct(
        TransaccionService $transaccionService,
        PromocionService $promocionService
    ) {
        $this->transaccionService = $transaccionService;
        $this->promocionService = $promocionService;
    }

    public function obtenerTodos()
    {
        return Producto::all();
    }

    public function obtenerPorId($id)
    {
        return Producto::findOrFail($id);
    }

    public function crearProducto(Request $request)
    {
        $data = $request->validate([
            'Nombre_Producto' => 'nullable|string|max:45',
            'Descripcion_Producto' => 'nullable|string|max:2000',
            'Costo_Adquisicion' => 'nullable|numeric',
            'Codigo_Barras' => 'required|integer|unique:producto,Codigo_Barras',
            'Peso' => 'nullable|string|max:55',
            'Precio' => 'nullable|numeric',
            'Cantidad_Stock' => 'required|integer|min:1',
            'Cantidad_Minima' => 'required|integer|min:1',
            'Cantidad_Maxima' => 'nullable|integer',
            'Id_Clasificacion' => 'nullable|integer|exists:clasificacion,Id_Clasificacion',
            'Id_Categoria' => 'nullable|integer|exists:categoria,Id_Categoria',
            'Id_Estado_Producto' => 'nullable|integer|exists:estado_producto,Id_Estado_Producto',
            'Id_Marca' => 'nullable|integer|exists:marca,Id_Marca',
            'Id_Proveedor' => 'nullable|integer|exists:proveedor,Id_Proveedor',
            'Fecha_Vencimiento' => 'nullable|date',
            'Id_Tipo_Promocion' => 'nullable|integer|in:1,2',
            'Fecha_Inicio' => 'nullable|date',
            'Fecha_Fin' => 'nullable|date',
            'Descuento' => 'nullable|integer',
        ]);

        if ($data['Cantidad_Stock'] < $data['Cantidad_Minima']) {
            return ['error' => 'La cantidad en stock está por debajo de la cantidad mínima permitida.'];
        }

        $producto = Producto::create($data);

        try {
            $this->transaccionService->registrarDesdeProducto($producto, $data);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }

        if ($producto->Id_Estado_Producto == 3) {
            try {
                $this->promocionService->crearDesdeProducto($producto, $data);
            } catch (\Exception $e) {
                return ['error' => $e->getMessage()];
            }
        }

        return ['success' => true];
    }

    public function actualizarProducto(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $data = $request->validate([
            'Nombre_Producto' => 'nullable|string|max:45',
            'Descripcion_Producto' => 'nullable|string|max:2000',
            'Costo_Adquisicion' => 'nullable|numeric',
            'Codigo_Barras' => [
                'required',
                'integer',
                Rule::unique('producto', 'Codigo_Barras')->ignore($producto->Id_Producto, 'Id_Producto'),
            ],
            'Peso' => 'nullable|string|max:55',
            'Precio' => 'nullable|numeric',
            'Cantidad_Stock' => 'required|integer|min:1',
            'Cantidad_Minima' => 'required|integer|min:1',
            'Cantidad_Maxima' => 'nullable|integer|min:1',
            'Id_Clasificacion' => 'nullable|integer|exists:clasificacion,Id_Clasificacion',
            'Id_Categoria' => 'nullable|integer|exists:categoria,Id_Categoria',
            'Id_Estado_Producto' => 'nullable|integer|exists:estado_producto,Id_Estado_Producto',
            'Id_Marca' => 'nullable|integer|exists:marca,Id_Marca',
            'Id_Proveedor' => 'nullable|integer|exists:proveedor,Id_Proveedor',
            'Fecha_Vencimiento' => 'nullable|date',
            'Id_Tipo_Promocion' => 'nullable|integer|in:1,2',
            'Fecha_Inicio' => 'nullable|date',
            'Fecha_Fin' => 'nullable|date',
            'Descuento' => 'nullable|integer',
        ]);

        if (!empty($data['Cantidad_Maxima']) && $data['Cantidad_Stock'] > $data['Cantidad_Maxima']) {
            return ['error' => '¡Estás a punto de superar la cantidad máxima permitida! No se puede editar.'];
        }

        // Lógica para estado automático
        if ($data['Cantidad_Stock'] <= 0 || $data['Cantidad_Stock'] < $data['Cantidad_Minima']) {
            $data['Id_Estado_Producto'] = 2; // Agotado
        } else {
            if (isset($data['Id_Estado_Producto']) && in_array($data['Id_Estado_Producto'], [1, 3])) {
                // válido
            } else {
                $data['Id_Estado_Producto'] = 1; // Disponible
            }
        }

        $producto->update($data);
        return ['success' => true];
    }

    public function eliminarProducto($id)
    {
        Producto::findOrFail($id)->delete();
    }

    public function buscarProductos(array $filtros = [])
    {
        $query = Producto::query();

        if (!empty($filtros['Nombre_Producto'])) {
            $query->where('Nombre_Producto', 'like', '%' . $filtros['Nombre_Producto'] . '%');
        }

        if (!empty($filtros['Id_Categoria'])) {
            $query->where('Id_Categoria', $filtros['Id_Categoria']);
        }

        if (!empty($filtros['Id_Estado_Producto'])) {
            $query->where('Id_Estado_Producto', $filtros['Id_Estado_Producto']);
        }

        if (!empty($filtros['Precio_Min'])) {
            $query->where('Precio', '>=', $filtros['Precio_Min']);
        }

        if (!empty($filtros['Precio_Max'])) {
            $query->where('Precio', '<=', $filtros['Precio_Max']);
        }

        if (!empty($filtros['Stock_Min'])) {
            $query->where('Cantidad_Stock', '>=', $filtros['Stock_Min']);
        }

        if (!empty($filtros['Stock_Max'])) {
            $query->where('Cantidad_Stock', '<=', $filtros['Stock_Max']);
        }


        //  obtener los resultados
        return $query->get();
    }

}
