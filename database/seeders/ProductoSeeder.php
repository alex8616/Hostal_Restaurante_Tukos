<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductoHostal;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $producto = ProductoHostal::create([
            'Nombre_producto'=>'Galletas',
            'Detalle_producto'=>'Galletas Dulces y Saladas',
            'Precio_producto'=>'25',
            'Stock_producto'=>'99',
            'Estado_producto'=>'FULL',
            'FechaRegistro_producto'=>'12/21/2022',
        ]);

        $producto = ProductoHostal::create([
            'Nombre_producto'=>'Coca Cola',
            'Detalle_producto'=>'Coca Cola de 2ltrs',
            'Precio_producto'=>'20',
            'Stock_producto'=>'99',
            'Estado_producto'=>'FULL',
            'FechaRegistro_producto'=>'12/21/2022',
        ]);

        $producto = ProductoHostal::create([
            'Nombre_producto'=>'Dulces',
            'Detalle_producto'=>'Dulces o Chocolates',
            'Precio_producto'=>'30',
            'Stock_producto'=>'99',
            'Estado_producto'=>'FULL',
            'FechaRegistro_producto'=>'12/21/2022',
        ]);
    }
}
