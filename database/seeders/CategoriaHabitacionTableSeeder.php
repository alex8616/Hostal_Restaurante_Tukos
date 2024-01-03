<?php

namespace Database\Seeders;

use App\Models\CategoriaHabitacion;
use Illuminate\Database\Seeder;

class CategoriaHabitacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoria = CategoriaHabitacion::create([
            'Nombre_categoria'=>'Simple',
            'Descripcion_categoria'=>'Una habitacion para una personas',
        ]);

        $categoria = CategoriaHabitacion::create([
            'Nombre_categoria'=>'Doble',
            'Descripcion_categoria'=>'Una habitacion para dos personas',
        ]);

        $categoria = CategoriaHabitacion::create([
            'Nombre_categoria'=>'Triple',
            'Descripcion_categoria'=>'Una habitacion para tres personas',
        ]);

        $categoria = CategoriaHabitacion::create([
            'Nombre_categoria'=>'Matrimonial',
            'Descripcion_categoria'=>'Una habitacion con una cama',
        ]);

        $categoria = CategoriaHabitacion::create([
            'Nombre_categoria'=>'Cuadruple',
            'Descripcion_categoria'=>'Una habitacion para tres personas',
        ]);
    }
    /*
        php artisan db:seed --class=ProfessionSeeder
    */
}
