<?php

namespace Database\Factories;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Plato;
use App\Models\Comanda;
use App\Models\DetalleComanda;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetalleComandaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'comanda_id'=> Comanda::all()->random()->id,
            'plato_id'=> Plato::all()->random()->id,
            'cantidad'=> $this->faker->numberBetween(1, 10),
            'precio_venta'=> $this->faker->numberBetween(20, 100),
            'descuento'=> $this->faker->numberBetween(1, 10),
            'comentario' => $this->faker->word(),
        ];
    }
}
