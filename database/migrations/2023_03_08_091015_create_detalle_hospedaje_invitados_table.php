<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleHospedajeInvitadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_hospedaje_invitados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hos_habitacion_invitado_id');
            $table->foreign('hos_habitacion_invitado_id')->references('id')->on('hospedaje_habitacion_invitados')->onDelete('cascade');
            
            $table->unsignedBigInteger('cliente_id')->nullable();
            $table->foreign('cliente_id')->references('id')->on('cliente_hostals')->onDelete('cascade');
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
        Schema::dropIfExists('detalle_hospedaje_invitados');
    }
}
