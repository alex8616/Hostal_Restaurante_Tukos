<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservaHabitacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserva_habitacions', function (Blueprint $table) {
            $table->id();
            $table->datetime('ingreso_reserva');
            $table->datetime('salida_reserva');
            $table->string('procedencia_reserva')->nullable();
            $table->string('destino_reserva')->nullable();
            $table->decimal('dias_reserva');
            $table->decimal('Precio_habitacion_reserva', 12, 2);
            $table->decimal('TotalHospedaje_reserva', 12, 2)->nullable();
            $table->decimal('PrecioRestante_reserva', 12, 2)->nullable();
            $table->decimal('Adelanto_reserva', 12, 2)->nullable();
            $table->decimal('Total_reserva', 12, 2);
            $table->decimal('TotalServicio_reserva', 12, 2)->nullable();
            $table->decimal('TotalProducto_reserva', 12, 2)->nullable();
            $table->decimal('TotalGeneralHospedaje_reserva', 12, 2)->nullable();
            $table->enum('Estado_reserva', ['ESPERA', 'INGRESO', 'CONCLUIDO', 'ELIMINADO'])->default('ESPERA');
            $table->datetime('EliminadoIngreso');
            $table->datetime('EliminadoSalida');
            $table->string('CategoriaHabitacion_reserva');
            $table->string('CamaraHotelera');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('habitacion_id')->nullable();
            $table->foreign('habitacion_id')->references('id')->on('habitacions')->onDelete('cascade');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('reserva_habitacions');
    }
}
