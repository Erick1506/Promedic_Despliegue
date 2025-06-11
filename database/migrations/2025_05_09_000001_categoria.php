<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class categoria extends Migration
{
    public function up()
    {
        Schema::create('categoria', function (Blueprint $table) {
            $table->increments('Id_Categoria');
            $table->string('Nombre_Categoria', 45)->nullable();
            $table->string('Descripcion_Categoria', 200)->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('categoria');
    }
}
