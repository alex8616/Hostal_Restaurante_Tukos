<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre_cliente');
            $table->string('Apellidop_cliente');
            $table->string('Celular_cliente');
            $table->string('FechaNacimiento_cliente')->nullable();
            $table->string('Correo_cliente')->nullable();
            $table->string('Nit_cliente')->nullable();

            $table->string('Ubicacion_cliente');
            $table->String('latidud')->nullable();
            $table->String('longitud')->nullable();
            $table->string('Direccion_cliente');
            $table->string('Zona_cliente');
            $table->string('NDireccion_cliente');
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
        Schema::dropIfExists('clientes');
    }
}
