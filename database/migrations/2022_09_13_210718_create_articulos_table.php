<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre_articulo');
            $table->longText('Descripcion_articulo');
            $table->integer('Total_articulo');
            $table->integer('Buen_Estado');
            $table->integer('Mal_Estado');
            $table->integer('Daniado_Estado');
            $table->string('photos_articulo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articulos');
    }
}
