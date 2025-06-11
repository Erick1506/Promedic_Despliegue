<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class formulaMedica extends Migration
{
    public function up()
    {
        Schema::create('formula_medica', function (Blueprint $table) {
            $table->increments('Id_Formula');
            $table->string('Nombre_Paciente', 45)->nullable();
            $table->integer('Identificacion_Paciente')->nullable();
            $table->date('Fecha_Insercion')->nullable();
            $table->unsignedInteger('Id_Administrador')->nullable();
            $table->string('Imagen', 500);
            $table->foreign('Id_Administrador')->references('Id_Administrador')->on('administrador')->onDelete('set null');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('formula_medica');
    }
}
