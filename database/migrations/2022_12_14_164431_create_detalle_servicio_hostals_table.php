<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleServicioHostalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_servicio_hostals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hospedaje_habitacion_id')->nullable();
            $table->foreign('hospedaje_habitacion_id')->references('id')->on('hospedaje_habitacions')->onDelete('cascade');
            
            $table->unsignedBigInteger('reserva_habitacion_id')->nullable();
            $table->foreign('reserva_habitacion_id')->references('id')->on('reserva_habitacions')->onDelete('cascade');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->unsignedBigInteger('servicio_hostals_id')->nullable();
            $table->foreign('servicio_hostals_id')->references('id')->on('servicio_hostals')->onDelete('cascade');
            $table->integer('cantidad_servicio');
            $table->decimal('Precio_servicio');
            $table->datetime('FechaRegistro_servicio');
            $table->enum('Incluye_servicio', ['SI', 'NO'])->default('NO');
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
        Schema::dropIfExists('detalle_servicio_hostals');
    }
}
