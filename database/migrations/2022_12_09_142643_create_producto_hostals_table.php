<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoHostalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_hostals', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre_producto');
            $table->string('Detalle_producto');
            $table->string('Precio_producto');
            $table->string('Stock_producto');
            $table->enum('Estado_producto', ['FULL', 'AGOTADO'])->default('FULL');
            $table->datetime('FechaRegistro_producto');
            $table->datetime('ActualizarStock_producto');
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
        Schema::dropIfExists('producto_hostals');
    }
}
