<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArticuloCajaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Nombre_Articulo'=> $this->faker->word(),
            'Codigo_caja'=> $this->faker->word(),
        ];
    }
}
