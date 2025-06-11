<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Promocion extends Migration
{
    public function up()
    {
        Schema::create('promocion', function (Blueprint $table) {
            $table->increments('Id_Promocion');
            $table->unsignedInteger('Id_Administrador')->nullable();
            $table->unsignedInteger('Id_Producto')->nullable();
            $table->unsignedInteger('Id_Tipo_Promocion')->nullable();
            $table->date('Fecha_Inicio')->nullable();
            $table->date('Fecha_Fin')->nullable();
            $table->integer('Descuento');
            
            $table->foreign('Id_Administrador')->references('Id_Administrador')->on('administrador')->onDelete('set null');
            $table->foreign('Id_Producto')->references('Id_Producto')->on('producto')->onDelete('set null');
            $table->foreign('Id_Tipo_Promocion')->references('Id_Tipo_Promocion')->on('tipo_promocion')->onDelete('set null');
            
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('promocion');
    }
}
