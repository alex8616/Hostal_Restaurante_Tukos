<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->string('motivo');
            $table->string('cliente');
            $table->decimal('precio', 12, 2);
            $table->decimal('adelanto', 12, 2);
            $table->decimal('deuda_pagar', 12, 2);
            $table->decimal('total', 12, 2);
            $table->unsignedBigInteger('ambiente_id');
            $table->foreign('ambiente_id')->references('id')->on('ambientes')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('reservas');
    }
}
