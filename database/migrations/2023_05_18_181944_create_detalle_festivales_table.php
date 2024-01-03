<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleFestivalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_festivales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('registrofestival_id');
            $table->foreign('registrofestival_id')->references('id')->on('registro_festivales')->onDelete('cascade');

            $table->unsignedBigInteger('combo_id');
            $table->foreign('combo_id')->references('id')->on('combos')->onDelete('cascade');
            
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
        Schema::dropIfExists('detalle_festivales');
    }
}
