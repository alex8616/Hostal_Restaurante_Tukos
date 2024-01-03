<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServicioHostal;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $servicio = ServicioHostal::create([
            'Nombre_servicio'=>'DESAYUNO',
        ]);

        $servicio = ServicioHostal::create([
            'Nombre_servicio'=>'ALMUERZO FAMILIAR',
        ]);

        $servicio = ServicioHostal::create([
            'Nombre_servicio'=>'LIMPIEZA',
        ]);
    }
}
