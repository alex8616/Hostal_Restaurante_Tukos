<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('Empresa_Nombre');
            $table->string('Empresa_Descripcion')->nullable();
            $table->string('Empresa_Logo')->nullable();
            $table->string('Empresa_Email')->nullable();
            $table->string('Empresa_Direccion')->nullable();
            $table->string('Empresa_Propietario')->nullable();
            $table->string('Empresa_Nit')->nullable();
            $table->string('Empresa_Telefono')->nullable();            
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
        Schema::dropIfExists('empresas');
    }
}
