<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    protected $table = 'transacciones';
    protected $primaryKey = 'Id_Transacciones';
    public $timestamps = true;

    protected $fillable = [
        'Fecha_Transaccion',
        'Cantidad',
        'Id_Administrador',
        'Id_Producto',
        'Id_Tipo_Transaccion'
    ];

    public function administrador()
    {
        return $this->belongsTo(Administrador::class, 'Id_Administrador');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'Id_Producto');
    }

    public function tipoTransaccion()
    {
        return $this->belongsTo(TipoTransaccion::class, 'Id_Tipo_Transaccion');
    }
}
