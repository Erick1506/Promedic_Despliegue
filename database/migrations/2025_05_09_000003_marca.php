<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class marca extends Migration
{
    public function up()
    {
        Schema::create('marca', function (Blueprint $table) {
            $table->increments('Id_Marca');
            $table->string('Marca_Producto', 45)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('marca');
    }
}
