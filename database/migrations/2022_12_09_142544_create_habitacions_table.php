<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHabitacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habitacions', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre_habitacion');
            $table->string('Detalle_habitacion');
            $table->string('Precio_habitacion');
            $table->string('imagen')->nullable();
            $table->string('color_habitacion');
            $table->enum('Estado_habitacion', ['DISPONIBLE', 'OCUPADO', 'LIMPIEZA'])->default('DISPONIBLE');
            $table->enum('Reserva_habitacion', ['SI', 'NO'])->default('NO');
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
        Schema::dropIfExists('habitacions');
    }
}
