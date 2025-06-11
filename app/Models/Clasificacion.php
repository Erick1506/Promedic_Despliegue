<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clasificacion extends Model
{
    protected $table = 'clasificacion';
    protected $primaryKey = 'Id_Clasificacion';
    public $timestamps = true;

    protected $fillable = [
        'Nombre_Clasificacion',
        'Descripcion_Clasificacion',
        'Id_Categoria'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'Id_Categoria');
    }

    public function productos()
    {
        return $this->hasMany(Producto::class, 'Id_Clasificacion');
    }
}
