<?php

namespace Database\Seeders;

use App\Models\ArticuloCaja;
use App\Models\Caja;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\CodigoCaja;
use App\Models\Plato;
use App\Models\Comanda;
use App\Models\DetalleCaja;
use App\Models\DetalleComanda;
use App\Models\PisoHabitacion;
use App\Models\CategoriaHabitacion;
use App\Models\Habitacion;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EmpresaSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(HabitacionSeeder::class);
        $this->call(ProductoSeeder::class);
        $this->call(ServicioSeeder::class);
        Categoria::factory(20)->create();
        Cliente::factory(20)->create();
        Plato::factory(20)->create();
        Caja::factory(2)->create();
        CodigoCaja::factory(3)->create();
        ArticuloCaja::factory(15)->create();
        DetalleCaja::factory(9000)->create();
        
    }
}
