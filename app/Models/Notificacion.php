<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    protected $table = 'notificaciones';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['mensaje', 'fecha_creacion'];
}
