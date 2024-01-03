<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliverisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveris', function (Blueprint $table) {
            $table->id();
            $table->string('Observacion');
            $table->dateTime('Fecha_inicio');
            $table->dateTime('Fecha_fin');
            $table->decimal('Cambio', 12, 2);
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
        Schema::dropIfExists('deliveris');
    }
}
