<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;


class Regente extends Model
{
    protected $table = 'regente';
    protected $primaryKey = 'Id_Regente';
    public $timestamps = true;

    protected $fillable = [
        'Nombre',
        'Apellido',
        'DNI',
        'Fecha_Contratacion',
        'Licencia',
        'Correo',
        'Telefono',
        'Contraseña_Encriptada',
        'Id_Turno',
        'token_recuperacion',
        'token_expiracion',
    ];

    public function turno()
    {
        return $this->belongsTo(TurnoRegente::class, 'Id_Turno');
    }

    public function comprobantes()
    {
        return $this->hasMany(Comprobante::class, 'Id_Regente');
    }
    public function setContraseñaEncriptadaAttribute($value)
    {
        if ($value) {
            $this->attributes['Contraseña_Encriptada'] = Hash::make($value);
        }
    }

    public function actualizarConPassword(array $data)
    {
        // Si llega la contraseña y no está vacía, la asigna para que se encripte con el mutator
        if (!empty($data['Contraseña_Encriptada'])) {
            $this->Contraseña_Encriptada = $data['Contraseña_Encriptada'];
            unset($data['Contraseña_Encriptada']); // la quitamos para que no se actualice directo
        }

        // Actualizamos los otros campos
        $this->fill($data);

        // Guardamos el modelo
        $this->save();
    }

}
