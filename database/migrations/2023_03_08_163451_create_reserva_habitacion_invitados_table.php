<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservaHabitacionInvitadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserva_habitacion_invitados', function (Blueprint $table) {
            $table->id();
            $table->datetime('invitado_ingreso_reserva');
            $table->datetime('invitado_salida_reserva');
            $table->decimal('invitado_Total', 12, 2);
            $table->decimal('invitado_dias_reserva');
            $table->enum('Pagado', ['SI', 'NO'])->default('NO');
            
            $table->unsignedBigInteger('reserva_habitacion_id');
            $table->foreign('reserva_habitacion_id')->references('id')->on('reserva_habitacions')->onDelete('cascade');
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
        Schema::dropIfExists('reserva_habitacion_invitados');
    }
}
