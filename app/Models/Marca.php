<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table = 'marca';
    protected $primaryKey = 'Id_Marca';
    public $timestamps = true;

    protected $fillable = ['Marca_Producto'];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'Id_Marca');
    }
}
