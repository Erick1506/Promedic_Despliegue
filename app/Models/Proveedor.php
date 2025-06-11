<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedor';
    protected $primaryKey = 'Id_Proveedor';
    public $timestamps = true;

    protected $fillable = [
        'Nombre_Proveedor',
        'Direccion_Proveedor',
        'Correo',
        'Telefono',
        'Id_Administrador'
    ];

    public function administrador()
    {
        return $this->belongsTo(Administrador::class, 'Id_Administrador');
    }

    public function productos()
    {
        return $this->hasMany(Producto::class, 'Id_Proveedor');
    }
}
