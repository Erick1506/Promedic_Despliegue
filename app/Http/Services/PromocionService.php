<?php

namespace App\Http\Services;

use App\Models\Producto;
use App\Models\Promocion;

class PromocionService
{
    // Crea una promoción desde un producto si cumple ciertas condiciones
    public function crearDesdeProducto(Producto $producto, array $data): ?Promocion
    {
        if (($data['Id_Tipo_Promocion'] ?? null) && $producto->Id_Estado_Producto == 3) {
            return Promocion::updateOrCreate(
                ['Id_Producto' => $producto->Id_Producto],
                [
                    'Id_Administrador' => auth()->id() ?? 1,
                    'Id_Tipo_Promocion' => $data['Id_Tipo_Promocion'],
                    'Fecha_Inicio' => $data['Fecha_Inicio'] ?? now(),
                    'Fecha_Fin' => $data['Fecha_Fin'] ?? now()->addDays(30),
                    'Descuento' => $data['Descuento'] ?? 0,
                ]
            );
        }

        return null;
    }

    // Crea una promoción con validación básica
    public function crear(array $data)
    {
        $producto = Producto::find($data['Id_Producto']);

        if (!$producto) {
            return ['status' => 'error', 'message' => 'Producto no encontrado.'];
        }

        // Verificar si ya tiene promoción activa
        $existePromocion = $producto->promociones() // Cambiado a promociones()
            ->where(function ($query) {
                $query->whereNull('Fecha_Fin')
                    ->orWhere('Fecha_Fin', '>=', now());
            })->exists();

        if ($existePromocion) {
            return ['status' => 'error', 'message' => 'El producto ya tiene una promoción activa.'];
        }

        // Crear la promoción
        $promocion = $producto->promociones()->create($data); // Cambiado a promociones()

        // Cambiar estado del producto a 3 (Promoción)
        $producto->update(['Id_Estado_Producto' => 3]);

        return ['status' => 'success', 'data' => $promocion];
    }

    // Listar todas las promociones
    public function listar()
    {
        return Promocion::with('producto')->get(); // Cargar el producto relacionado
    }

    // Mostrar una promoción por ID
    public function mostrar(int $id): Promocion
    {
        return Promocion::findOrFail($id);
    }

    // Actualizar una promoción
    public function actualizar(int $id, array $data): Promocion
    {
        $promocion = Promocion::findOrFail($id);
        $promocion->update($data);
        return $promocion;
    }

    // Eliminar una promoción
    public function eliminar(int $id): void
    {
        Promocion::findOrFail($id)->delete();
    }
}
