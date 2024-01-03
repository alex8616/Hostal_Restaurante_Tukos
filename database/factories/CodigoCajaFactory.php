<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CodigoCajaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Nombre'=> $this->faker->word(),
        ];
    }
}
