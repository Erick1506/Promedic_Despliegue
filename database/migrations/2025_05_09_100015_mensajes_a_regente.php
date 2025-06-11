<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class MensajesARegente extends Migration
{
    public function up()
    {
        Schema::create('mensajes_a_regente', function (Blueprint $table) {
            $table->increments('id');
            $table->text('mensaje');
            $table->timestamp('fecha')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('mensajes_a_regente');
    }
}
