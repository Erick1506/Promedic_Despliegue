<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class producto extends Migration
{
    public function up()
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->increments('Id_Producto');
            $table->string('Nombre_Producto', 45)->nullable();
            $table->string('Descripcion_Producto', 2000)->nullable();
            $table->double('Costo_Adquisicion')->nullable();
            $table->integer('Codigo_Barras')->nullable();
            $table->string('Peso', 55)->nullable();
            $table->double('Precio')->nullable();
            $table->integer('Cantidad_Stock')->nullable();
            $table->unsignedInteger('Id_Clasificacion')->nullable();
            $table->unsignedInteger('Id_Categoria')->nullable();
            $table->unsignedInteger('Id_Estado_Producto')->nullable();
            $table->unsignedInteger('Id_Marca')->nullable();
            $table->unsignedInteger('Id_Proveedor')->nullable();
            $table->date('Fecha_Vencimiento')->nullable();
            $table->integer('Cantidad_Minima')->nullable();
            $table->integer('Cantidad_Maxima')->nullable();
            $table->foreign('Id_Clasificacion')->references('Id_Clasificacion')->on('clasificacion')->onDelete('set null');
            $table->foreign('Id_Categoria')->references('Id_Categoria')->on('categoria')->onDelete('set null');
            $table->foreign('Id_Estado_Producto')->references('Id_Estado_Producto')->on('estado_producto')->onDelete('set null');
            $table->foreign('Id_Marca')->references('Id_Marca')->on('marca')->onDelete('set null');
            $table->foreign('Id_Proveedor')->references('Id_Proveedor')->on('proveedor')->onDelete('set null');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('producto');
    }
}