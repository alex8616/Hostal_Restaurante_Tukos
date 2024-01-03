<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodigoVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codigo_ventas', function (Blueprint $table) {
            $table->id();

            $table->string('autorizacion')->nullable();
            $table->string('clave')->nullable();
            $table->dateTime('fecInicio');
            $table->dateTime('fecFinal');

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
        Schema::dropIfExists('codigo_ventas');
    }
}
