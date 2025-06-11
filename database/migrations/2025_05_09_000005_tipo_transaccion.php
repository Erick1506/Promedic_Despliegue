<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class tipoTransaccion extends Migration
{
    public function up()
    {
        Schema::create('tipo_transaccion', function (Blueprint $table) {
            $table->increments('Id_Tipo_Transaccion');
            $table->string('Tipo_Transaccion', 45)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipo_transaccion');
    }
}
