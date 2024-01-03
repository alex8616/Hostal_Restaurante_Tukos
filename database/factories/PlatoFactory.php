<?php

namespace Database\Factories;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlatoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Nombre_plato'=> $this->faker->word(),
            'Precio_plato'=> $this->faker->numberBetween(10, 100),
            'Caracteristicas_plato'=> $this->faker->word(),
            'imagen'=> $this->faker->imageUrl(640, 480, 'animals', true),
            'categoria_id'=> Categoria::all()->random()->id,
            'tipo' => $this->faker->randomElement(['Semanal','Dominical']),
        ];
    }
}
