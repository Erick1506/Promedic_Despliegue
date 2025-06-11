<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Producto extends Model
{   
    protected $table = 'producto';
    protected $primaryKey = 'Id_Producto';
    public $timestamps = true;

    protected $fillable = [
        'Nombre_Producto', 'Descripcion_Producto', 'Costo_Adquisicion', 'Codigo_Barras',
        'Peso', 'Precio', 'Cantidad_Stock', 'Id_Clasificacion', 'Id_Categoria',
        'Id_Estado_Producto', 'Id_Marca', 'Id_Proveedor', 'Fecha_Vencimiento',
        'Cantidad_Minima', 'Cantidad_Maxima'
    ];

    public function clasificacion()
    {
        return $this->belongsTo(Clasificacion::class, 'Id_Clasificacion');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'Id_Categoria');
    }

    public function estadoProducto()
    {
        return $this->belongsTo(EstadoProducto::class, 'Id_Estado_Producto');
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'Id_Marca');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'Id_Proveedor');
    }

    public function comprobantes()
    {
        return $this->hasMany(Comprobante::class, 'Id_Producto');
    }

    public function promociones()
    {
        return $this->hasMany(Promocion::class, 'Id_Producto', 'Id_Producto');
    }

    public function transacciones()
    {
        return $this->hasMany(Transaccion::class, 'Id_Producto');
    }
    public function promocionActiva()
{
    return $this->hasOne(Promocion::class, 'id_producto', 'Id_Producto')
                ->where('fecha_inicio', '<=', now())
                ->where('fecha_fin', '>=', now());
}
}
