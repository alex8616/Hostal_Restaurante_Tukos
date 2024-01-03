<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleComandasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_comandas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('comanda_id');
            $table->foreign('comanda_id')->references('id')->on('comandas')->onDelete('cascade');
            
            $table->unsignedBigInteger('plato_id');
            $table->foreign('plato_id')->references('id')->on('platos')->onDelete('cascade');

            $table->integer('cantidad');
            $table->decimal('precio_venta');

            $table->decimal('descuento')->default('0');

            $table->string('comentario')->nullable();
            

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
        Schema::dropIfExists('detalle_comandas');
    }
}
