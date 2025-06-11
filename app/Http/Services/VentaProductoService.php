<?php

namespace App\Http\Services;

use App\Models\Comprobante;
use App\Models\Transaccion;
use App\Models\Producto;

class VentaProductoService
{
    public function vender(array $data)
    {
        // Obtener el producto
        $producto = Producto::findOrFail($data['idProducto']);

        // Verificar el estado del producto
        if ($producto->Id_Estado_Producto == 3) { // Id de promoción
            // Obtener la promoción activa del producto
            $promocion = $producto->promociones()
                ->where(function ($query) {
                    $query->whereNull('Fecha_Fin')
                        ->orWhere('Fecha_Fin', '>=', now());
                })
                ->first();


            if ($promocion) {
                // Verificar el tipo de promoción
                if ($promocion->Id_Tipo_Promocion == 1) { // Id 1 es el tipo "2x1"
                    // Calcular la cantidad a registrar (2 por cada 1 vendido)
                    $cantidadRegistrada = $data['cantidad'] * 2;
                    $total = $producto->Precio * $data['cantidad']; // Total a cobrar por la cantidad vendida
                } elseif ($promocion->Id_Tipo_Promocion == 2) { // Id 2 es el tipo "Descuento"
                    // Calcular el total con descuento
                    $descuento = $promocion->Descuento; // Porcentaje de descuento
                    // Asegúrate de que el descuento sea un número válido
                    if ($descuento < 0 || $descuento > 100) {
                        throw new \Exception('El porcentaje de descuento no es válido.');
                    }
                    // Calcular el total con el descuento aplicado
                    $total = ($producto->Precio * $data['cantidad']) * (1 - ($descuento / 100));
                    $cantidadRegistrada = $data['cantidad'];
                } else {
                    // Si no es un tipo de promoción válida, se registra normalmente
                    $cantidadRegistrada = $data['cantidad'];
                    $total = $producto->Precio * $data['cantidad'];
                }
            } else {
                // Si no hay promoción activa, se registra normalmente
                $cantidadRegistrada = $data['cantidad'];
                $total = $producto->Precio * $data['cantidad'];
            }
        } else {
            // Si el producto no está en promoción, se registra normalmente
            $cantidadRegistrada = $data['cantidad'];
            $total = $producto->Precio * $data['cantidad'];
        }

        // Verificar si hay suficiente stock
        if ($cantidadRegistrada > $producto->Cantidad_Stock) {
            throw new \Exception('No hay suficiente stock para realizar la venta.');
        }

        // Crear el comprobante
        $comprobante = Comprobante::create([
            'Id_Regente' => $data['id_regente'],
            'Id_Producto' => $producto->Id_Producto,
            'Cantidad' => $cantidadRegistrada,
            'Fecha_Venta' => now(),
            'Total' => $total,
        ]);

        // Registrar la transacción de salida
        Transaccion::create([
            'Fecha_Transaccion' => now(),
            'Cantidad' => $cantidadRegistrada,
            'Id_Administrador' => 1, // Cambia esto según tu lógica
            'Id_Producto' => $producto->Id_Producto,
            'Id_Tipo_Transaccion' => 2, // Tipo de transacción 2 para salida
        ]);

        // Actualizar stock y estado del producto
        $producto->Cantidad_Stock -= $cantidadRegistrada;

        if ($producto->Cantidad_Stock <= 0) {
            $producto->Id_Estado_Producto = 2; // 2 = Agotado
        }
        $producto->save();

        return $comprobante;
    }
}
