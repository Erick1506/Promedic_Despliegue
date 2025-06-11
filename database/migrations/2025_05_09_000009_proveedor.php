<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class proveedor extends Migration
{
    public function up()
    {
        Schema::create('proveedor', function (Blueprint $table) {
            $table->increments('Id_Proveedor');
            $table->string('Nombre_Proveedor', 45)->nullable();
            $table->string('Direccion_Proveedor', 45)->nullable();
            $table->string('Correo', 45)->nullable();
            $table->float('Telefono')->nullable();
            $table->unsignedInteger('Id_Administrador')->nullable();
            $table->foreign('Id_Administrador')->references('Id_Administrador')->on('administrador')->onDelete('set null');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('proveedor');
    }
}
