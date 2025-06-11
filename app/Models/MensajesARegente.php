<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MensajesARegente extends Model
{
    protected $table = 'mensajes_a_regente';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['mensaje', 'fecha'];
}
