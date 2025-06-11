<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class comprobante extends Migration
{
    public function up()
    {
        Schema::create('comprobante', function (Blueprint $table) {
            $table->increments('Id_Comprobante');
            $table->unsignedInteger('Id_Regente')->nullable();
            $table->unsignedInteger('Id_Producto')->nullable();
            $table->integer('Cantidad')->nullable();
            $table->date('Fecha_Venta')->nullable();
            $table->integer('Total')->nullable();
            $table->foreign('Id_Regente')->references('Id_Regente')->on('regente')->onDelete('set null');
            $table->foreign('Id_Producto')->references('Id_Producto')->on('producto')->onDelete('set null');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('comprobante');
    }
}

