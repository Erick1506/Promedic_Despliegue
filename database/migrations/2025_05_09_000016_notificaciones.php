<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class notificaciones extends Migration
{
    public function up()
    {
        Schema::create('notificaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->text('mensaje');
            $table->timestamp('fecha_creacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('notificaciones');
    }
}

