<?php

namespace Database\Factories;

use App\Models\ArticuloCaja;
use App\Models\Caja;
use App\Models\CodigoCaja;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetalleCajaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'caja_id'=> Caja::all()->random()->id,
            'codigo_caja_id'=> CodigoCaja::all()->random()->id,
            'articulo_caja_id'=> ArticuloCaja::all()->random()->id,
            'Articulo_description'=> $this->faker->word(),
            'Ingreso'=> $this->faker->numberBetween(10, 9999),
            'Egreso'=> $this->faker->numberBetween(0, 150),
            'Fecha_registro'=> $this->faker->date(),
            'Factura' => $this->faker->randomElement(['Sin_Factura','Con_Factura']),
        ];
    }
}
