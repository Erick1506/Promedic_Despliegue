<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoPromocion extends Model
{
    protected $table = 'tipo_promocion';
    protected $primaryKey = 'Id_Tipo_Promocion';
    public $timestamps = true;

    protected $fillable = ['Tipo_Promocion'];

    public function promociones()
    {
        return $this->hasMany(Promocion::class, 'Id_Tipo_Promocion');
    }
}
