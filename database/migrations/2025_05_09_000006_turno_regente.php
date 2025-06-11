<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class turnoRegente extends Migration
{
    public function up()
    {
        Schema::create('turno_regente', function (Blueprint $table) {
            $table->increments('Id_Turno');
            $table->string('turno', 50)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('turno_regente');
    }
}
