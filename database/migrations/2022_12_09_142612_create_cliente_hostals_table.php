<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteHostalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente_hostals', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre_cliente');
            $table->string('Apellido_cliente');
            $table->string('Documento_cliente');
            $table->string('Nacionalidad_cliente');
            $table->string('Profesion_cliente');
            $table->string('Edad_cliente');
            $table->string('EstadoCivil_cliente');
            $table->string('Celular_cliente')->nullable();
            $table->string('imagenes')->nullable();
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
        Schema::dropIfExists('cliente_hostals');
    }
}
