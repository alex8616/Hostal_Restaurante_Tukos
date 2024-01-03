<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleDeliverisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_deliveris', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('deliveri_id');
            $table->foreign('deliveri_id')->references('id')->on('deliveris')->onDelete('cascade');

            $table->unsignedBigInteger('comanda_id');
            $table->foreign('comanda_id')->references('id')->on('comandas')->onDelete('cascade');

            $table->enum('estado', ['TRUE', 'FALSE'])->default('FALSE');

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
        Schema::dropIfExists('detalle_deliveris');
    }
}
