<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Administrador extends Model
{
    protected $table = 'administrador';
    protected $primaryKey = 'Id_Administrador';
    public $timestamps = true;

    protected $fillable = [
        'Nombre',
        'Apellido',
        'Correo',
        'Telefono',
        'token_recuperacion',
        'token_expiracion',
        'Contraseña'
    ];

      // Mutator para encriptar automáticamente la contraseña
    public function setContraseñaAttribute($value)
    {
        if (!Hash::needsRehash($value)) {
            $value = Hash::make($value);
        }

        $this->attributes['Contraseña'] = $value;
    }
    public function formulasMedicas()
    {
        return $this->hasMany(FormulaMedica::class, 'Id_Administrador');
    }

    public function proveedores()
    {
        return $this->hasMany(Proveedor::class, 'Id_Administrador');
    }

    public function promociones()
    {
        return $this->hasMany(Promocion::class, 'Id_Administrador');
    }

    public function transacciones()
    {
        return $this->hasMany(Transaccion::class, 'Id_Administrador');
    }

}
