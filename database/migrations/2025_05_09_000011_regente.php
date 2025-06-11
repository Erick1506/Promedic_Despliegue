<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class regente extends Migration
{
    public function up()
    {
        Schema::create('regente', function (Blueprint $table) {
            $table->increments('Id_Regente');
            $table->string('Nombre', 45)->nullable();
            $table->string('Apellido', 45)->nullable();
            $table->integer('DNI')->nullable();
            $table->date('Fecha_Contratacion')->nullable();
            $table->integer('Licencia')->nullable();
            $table->string('Correo', 45)->nullable();
            $table->float('Telefono')->nullable();
            $table->binary('Contraseña_Encriptada');
            $table->unsignedInteger('Id_Turno')->nullable();
            $table->string('token_recuperacion', 255)->nullable();
            $table->dateTime('token_expiracion')->nullable();
            $table->foreign('Id_Turno')->references('Id_Turno')->on('turno_regente')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('regente');
    }
}
