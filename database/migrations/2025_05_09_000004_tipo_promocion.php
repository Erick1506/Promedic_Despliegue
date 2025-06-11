<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class tipoPromocion extends Migration
{
    public function up()
    {
        Schema::create('tipo_promocion', function (Blueprint $table) {
            $table->increments('Id_Tipo_Promocion');
            $table->string('Tipo_Promocion', 50)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipo_promocion');
    }
}
