<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturaVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura_ventas', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('comanda_id');
            $table->foreign('comanda_id')->references('id')->on('comandas')->onDelete('cascade');

            $table->unsignedBigInteger('codigo_venta_id')->nullable();
            $table->foreign('codigo_venta_id')->references('id')->on('codigo_ventas')->onDelete('cascade');

            $table->string('codigo_Control')->nullable();
            $table->string('QR')->nullable();
            $table->string('numFactura')->nullable();
            $table->date('fecha_Emision');
            $table->enum('estado', ['VALIDO', 'CANCELADO'])->default('VALIDO');
            $table->date('fecha_limite');
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
        Schema::dropIfExists('factura_ventas');
    }
}
