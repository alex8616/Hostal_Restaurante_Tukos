<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMesaFestivalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mesa_festivales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('festivale_id');
            $table->foreign('festivale_id')->references('id')->on('festivales')->onDelete('cascade');
            
            $table->string('Nombre_mesa');
            $table->string('posicion_x');
            $table->string('posicion_y');
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
        Schema::dropIfExists('mesa_festivales');
    }
}
