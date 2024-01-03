<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProblemasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problemas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->string('titulo');
            $table->text('description');
            $table->dateTime('asignado_fecha');
            $table->dateTime('resuelto_fecha');
            $table->text('solution');
            $table->enum('estado', ['INICIO', 'PROGRESO', 'CONCLUIDO'])->default('INICIO');
            $table->enum('tipoproblema', ['CRITICO', 'MEDIO', 'LEVE'])->default('LEVE');

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
        Schema::dropIfExists('problemas');
    }
}
