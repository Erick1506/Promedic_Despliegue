<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comprobante extends Model
{
    protected $table = 'comprobante';
    protected $primaryKey = 'Id_Comprobante';
    public $timestamps = true;

    protected $fillable = [
        'Id_Regente',
        'Id_Producto',
        'Cantidad',
        'Fecha_Venta',
        'Total'
    ];

    public function regente()
    {
        return $this->belongsTo(Regente::class, 'Id_Regente');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'Id_Producto');
    }
}
