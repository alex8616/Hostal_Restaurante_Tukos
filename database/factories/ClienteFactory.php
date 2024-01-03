<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Nombre_cliente'=> $this->faker->word(),
            'Apellidop_cliente'=> $this->faker->word(),
            'Direccion_cliente'=> $this->faker->name(),
            'Celular_cliente'=> $this->faker->phoneNumber(),
            'FechaNacimiento_cliente'=> $this->faker->dateTime(),
            'Correo_cliente'=> $this->faker->email(),
            'Nit_cliente'=> $this->faker->phoneNumber(),
            'latidud'=> $this->faker->phoneNumber(),
            'longitud'=> $this->faker->phoneNumber(),
        ];
    }
}
