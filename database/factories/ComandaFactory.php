<?php

namespace Database\Factories;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComandaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cliente_id'=> Cliente::all()->random()->id,
            'user_id'=> User::all()->random()->id,
            'fecha_venta'=> $this->faker->date(),
            'total'=> $this->faker->numberBetween(10, 1000),
            'estado' => $this->faker->randomElement(['VALIDO','CANCELADO']),
        ];
    }
}
