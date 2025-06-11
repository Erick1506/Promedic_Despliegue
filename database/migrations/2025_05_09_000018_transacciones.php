<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class transacciones extends Migration
{
    public function up()
    {
        Schema::create('transacciones', function (Blueprint $table) {
            $table->increments('Id_Transacciones');
            $table->date('Fecha_Transaccion')->nullable();
            $table->integer('Cantidad')->nullable();
            $table->unsignedInteger('Id_Administrador')->nullable();
            $table->unsignedInteger('Id_Producto')->nullable();
            $table->unsignedInteger('Id_Tipo_Transaccion')->nullable();

            $table->foreign('Id_Administrador')->references('Id_Administrador')->on('administrador')->onDelete('set null');
            $table->foreign('Id_Producto')->references('Id_Producto')->on('producto')->onDelete('set null');
            $table->foreign('Id_Tipo_Transaccion')->references('Id_Tipo_Transaccion')->on('tipo_transaccion')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transacciones');
    }
}
