<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class administrador extends Migration // Cambia el nombre aquí
{
    public function up()
    {
        Schema::create('administrador', function (Blueprint $table) {
            $table->increments('Id_Administrador');
            $table->string('Nombre', 45)->nullable();
            $table->string('Apellido', 45)->nullable();
            $table->string('Correo', 45)->nullable();
            $table->float('Telefono')->nullable();
            $table->string('token_recuperacion', 255)->nullable();
            $table->dateTime('token_expiracion')->nullable();
            $table->string('Contraseña', 255);
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('administrador');
    }
}
