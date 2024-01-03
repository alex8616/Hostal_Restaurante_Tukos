<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospedajeHabitacionInvitadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospedaje_habitacion_invitados', function (Blueprint $table) {
            $table->id();
            $table->datetime('invitado_ingreso_hospedaje');
            $table->datetime('invitado_salida_hospedaje');
            $table->decimal('invitado_Total', 12, 2);
            $table->decimal('invitado_dias_hospedaje');
            $table->enum('Pagado', ['SI', 'NO'])->default('NO');
            
            $table->unsignedBigInteger('hospedaje_habitacion_id');
            $table->foreign('hospedaje_habitacion_id')->references('id')->on('hospedaje_habitacions')->onDelete('cascade');
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
        Schema::dropIfExists('hospedaje_habitacion_invitados');
    }
}
