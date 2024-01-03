<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservaFestivalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserva_festivales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('festivale_id');
            $table->foreign('festivale_id')->references('id')->on('festivales')->onDelete('cascade');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->unsignedBigInteger('mesa_id');
            $table->foreign('mesa_id')->references('id')->on('mesa_festivales')->onDelete('cascade');

            $table->string('Nombre_reserva');
            $table->string('Celular_reserva');
            $table->string('Hora_reserva');
            $table->dateTime('Fecha_registro');
            $table->string('Cantidad_persona');
            $table->decimal('Adeltanto_reserva');
            $table->decimal('Deuda_reserva');
            $table->decimal('Total_reserva');
            $table->enum('tipopago', ['EFECTIVO','TARJETA', 'DEPOSITO'])->default('EFECTIVO');
            $table->enum('estado', ['TRUE','FALSE'])->default('FALSE'); 
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
        Schema::dropIfExists('reserva_festivales');
    }
}
