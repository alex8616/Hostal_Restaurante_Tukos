<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleCajasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_cajas', function (Blueprint $table) {
            $table->id();
   
            $table->unsignedBigInteger('caja_id');
            $table->foreign('caja_id')->references('id')->on('cajas')->onDelete('cascade');
            
            $table->unsignedBigInteger('codigo_caja_id');
            $table->foreign('codigo_caja_id')->references('id')->on('codigo_cajas')->onDelete('cascade');

            $table->unsignedBigInteger('articulo_caja_id');
            $table->foreign('articulo_caja_id')->references('id')->on('articulo_cajas')->onDelete('cascade');

            $table->string('Articulo_description');

            $table->decimal('Ingreso', 12, 2)->nullable();

            $table->decimal('Egreso', 12, 2)->nullable();

            $table->dateTime('Fecha_registro');

            $table->enum('Factura', ['Con_Factura', 'Sin_Factura'])->default('Sin_Factura');

            $table->integer('NFactura')->nullable();

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
        Schema::dropIfExists('detalle_cajas');
    }
}
