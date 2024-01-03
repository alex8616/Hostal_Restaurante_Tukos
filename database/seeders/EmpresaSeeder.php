<?php

namespace Database\Seeders;

use App\Models\Empresa;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empresa::create([
            'Empresa_Nombre'=>'RESTAURANTE TUKOS',
            'Empresa_Descripcion'=>'Venta De Comidas Rapidas y Almuerzos Familiares',
            'Empresa_Logo'=>'logo.jpg',
            'Empresa_Email'=>'RestauranteTukos@gmail.com',
            'Empresa_Direccion'=>'Calle Hoyos Nª25',
            'Empresa_Telefono'  =>'26230689',  
            'Empresa_Propietario'=>'Antonio Alejandro Flores',
            'Empresa_Nit'=>'368490618',
        ]);
    }
}
