<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';
    protected $primaryKey = 'Id_Categoria';
    public $timestamps = true;

    protected $fillable = ['Nombre_Categoria', 'Descripcion_Categoria'];

    public function clasificaciones()
    {
        return $this->hasMany(Clasificacion::class, 'Id_Categoria');
    }

    public function productos()
    {
        return $this->hasMany(Producto::class, 'Id_Categoria');
    }
}
