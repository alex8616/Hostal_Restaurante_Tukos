<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospedajeHabitacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospedaje_habitacions', function (Blueprint $table) {
            $table->id();
            $table->datetime('ingreso_hospedaje');
            $table->datetime('salida_hospedaje');
            $table->string('procedencia_hospedaje');
            $table->string('destino_hospedaje');
            $table->decimal('dias_hospedarse', 12, 2);
            $table->decimal('Precio_habitacion', 12, 2);
            $table->decimal('PrecioRestante', 12, 2);
            $table->decimal('Adelanto', 12, 2);
            $table->decimal('Total', 12, 2);
            $table->decimal('TotalProducto', 12, 2);
            $table->decimal('TotalServicio', 12, 2);
            $table->decimal('TotalGeneralHospedaje', 12, 2);
            $table->string('CategoriaHabitacion');
            $table->string('CamaraHotelera');
            $table->string('TipoPago');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('habitacion_id')->nullable();
            $table->foreign('habitacion_id')->references('id')->on('habitacions')->onDelete('cascade');
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
        Schema::dropIfExists('hospedaje_habitacions');
    }
}
