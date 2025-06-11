<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class clasificacion extends Migration
{
    public function up()
    {
        Schema::create('clasificacion', function (Blueprint $table) {
            $table->increments('Id_Clasificacion');
            $table->string('Nombre_Clasificacion', 45)->nullable();
            $table->string('Descripcion_Clasificacion', 2000)->nullable();
            $table->unsignedInteger('Id_Categoria')->nullable();
            $table->foreign('Id_Categoria')->references('Id_Categoria')->on('categoria')->onDelete('set null');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('clasificacion');
    }
}