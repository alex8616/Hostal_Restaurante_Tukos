<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControlCamareriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('control_camarerias', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('habitacion_id');
            $table->foreign('habitacion_id')->references('id')->on('habitacions')->onDelete('cascade');
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('actividad');

            $table->string('observacion');

            $table->dateTime('fecha_registro');
            
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
        Schema::dropIfExists('control_camarerias');
    }
}
