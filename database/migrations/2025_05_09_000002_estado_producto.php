<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class estadoProducto extends Migration
{
    public function up()
    {
        Schema::create('estado_producto', function (Blueprint $table) {
            $table->increments('Id_Estado_Producto');
            $table->integer('Tipo_Estado_Producto')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('estado_producto');
    }
}
