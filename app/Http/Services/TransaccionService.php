<?php
namespace App\Http\Services;

use App\Models\Transaccion;
use App\Models\Producto;

class TransaccionService
{
    /**
     * Registrar una transacción desde un producto.
     *
     * @param Producto $producto
     * @param array $data
     * @return Transaccion
     */
    public function registrarDesdeProducto(Producto $producto, array $data): Transaccion
    {
        // Crear la transacción relacionada con el producto
        return Transaccion::create([
            'Fecha_Transaccion' => now(),  // Fecha actual de la transacción
            'Cantidad' => $producto->Cantidad_Stock,  // El stock actual del producto
            'Id_Producto' => $producto->Id_Producto,  // Producto relacionado
            'Id_Tipo_Transaccion' => 1,  // Tipo de transacción por defecto (Entrada)
            'Id_Administrador' => $data['Id_Administrador'] ?? 1,  // Administrador, por defecto 1
        ]);
    }

    /**
     * Crear una nueva transacción.
     *
     * @param array $data
     * @return Transaccion
     */
    public function crearTransaccion(array $data): Transaccion
    {
        return Transaccion::create($data);
    }

    /**
     * Listar todas las transacciones.
     *
     * @return \Illuminate\Database\Eloquent\Collection|Transaccion[]
     */
    public function listarTransacciones()
    {
        return Transaccion::all();
    }

    /**
     * Mostrar una transacción por ID.
     *
     * @param int $id
     * @return Transaccion
     */
    public function mostrarTransaccion(int $id): Transaccion
    {
        return Transaccion::findOrFail($id);
    }

    /**
     * Actualizar una transacción existente.
     *
     * @param int $id
     * @param array $data
     * @return Transaccion
     */
    public function actualizarTransaccion(int $id, array $data): Transaccion
    {
        $transaccion = Transaccion::findOrFail($id);
        $transaccion->update($data);

        return $transaccion;
    }

    /**
     * Eliminar una transacción por ID.
     *
     * @param int $id
     * @return void
     */
    public function eliminarTransaccion(int $id): void
    {
        Transaccion::findOrFail($id)->delete();
    }
    
}
