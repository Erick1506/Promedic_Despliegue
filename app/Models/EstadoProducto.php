<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoProducto extends Model
{
    protected $table = 'estado_producto';
    protected $primaryKey = 'Id_Estado_Producto';
    public $timestamps = true;

    protected $fillable = ['Tipo_Estado_Producto'];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'Id_Estado_Producto');
    }
}
