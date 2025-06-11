<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TurnoRegente extends Model
{
    protected $table = 'turno_regente';
    protected $primaryKey = 'Id_Turno';
    public $timestamps = true;

    protected $fillable = ['turno'];

    public function regentes()
    {
        return $this->hasMany(Regente::class, 'Id_Turno');
    }
}
