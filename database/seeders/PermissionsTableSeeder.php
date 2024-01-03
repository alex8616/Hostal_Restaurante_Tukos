<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    
    public function run()
    {

        //dash init
        Permission::create([
            'name'          => 'home-dashboard',
            'description'   => 'Puede ver las estadísticas de las ventas y productos mas vendidos.',
        ]);
       
        //Users
        Permission::create([
            // 'name'          => 'Navegar usuarios',
            'name'          => 'users.index',
            'description'   => 'Lista y navega todos los usuarios del sistema.',
        ]);

        Permission::create([
            // 'name'          => 'Creación de usuarios',
            'name'          => 'users.create',
            'description'   => 'Crea nuevos usuarios en el sistema.',
        ]);

        Permission::create([
            // 'name'          => 'Ver detalle de usuario',
            'name'          => 'users.show',
            'description'   => 'Ve el detalle de cada usuario del sistema.',            
        ]);
        
        Permission::create([
            // 'name'          => 'Edición de usuarios',
            'name'          => 'users.edit',
            'description'   => 'Edita cualquier dato de un usuario del sistema.',
        ]);
        
        Permission::create([
            // 'name'          => 'Elimina usuario',
            'name'          => 'users.destroy',
            'description'   => 'Elimina cualquier usuario del sistema.',      
        ]);

        //Roles
        Permission::create([
            // 'name'          => 'Navegar roles',
            'name'          => 'roles.index',
            'description'   => 'Lista y navega todos los roles del sistema.',
        ]);

        Permission::create([
            // 'name'          => 'Ver detalle de un rol',
            'name'          => 'roles.show',
            'description'   => 'Ve el detalle de cada rol del sistema.',            
        ]);
        
        Permission::create([
            // 'name'          => 'Creación de roles',
            'name'          => 'roles.create',
            'description'   => 'Crea nuevos roles en el sistema.',
        ]);
        
        Permission::create([
            // 'name'          => 'Edición de roles',
            'name'          => 'roles.edit',
            'description'   => 'Edita cualquier dato de un rol del sistema.',
        ]);
        
        Permission::create([
            // 'name'          => 'Elimina roles',
            'name'          => 'roles.destroy',
            'description'   => 'Elimina cualquier rol del sistema.',      
        ]);


        // Categorias
        Permission::create([
            // 'name'=>'Navegar categorías',
            'name'          =>'categorias.index',
            'description'   =>'Lista y navega en las categorías del sistema.',
        ]);
        // Permission::create([
        //     // 'name'=>'Ver detalle de categoría',
        //     'name'          =>'categorias.show',
        //     'description'   =>'Ver el detalle de cada categoría del sistema.',
        // ]);
        Permission::create([
            // 'name'=>'Edición de categorías',
            'name'          =>'categorias.edit',
            'description'   =>'Edita cualquier dato de una categoría del sistema.',
        ]);
        Permission::create([
            // 'name'=>'Creación de categorías',
            'name'          =>'categorias.create',
            'description'   =>'Crea cualquier dato de una categoría del sistema.',
        ]);
        Permission::create([
            // 'name'=>'Elimina categorías',
            'name'          =>'categorias.destroy',
            'description'   =>'Elimina cualquier dato de una categoría del sistema.',
        ]);

        // Clientes
        Permission::create([
            // 'name'=>'Navegar por clientes',
            'name'=>'clientes.index',
            'description'=>'Lista y navega por todos los clientes del sistema.',
        ]);
        Permission::create([
            // 'name'=>'Ver detalle de cliente',
            'name'=>'clientes.show',
            'description'=>'Ve el detalle de cada cliente del sistema.',
        ]);
        Permission::create([
            // 'name'=>'Edición de clientes',
            'name'=>'clientes.edit',
            'description'=>'Edita cualquier dato de un cliente del sistema.',
        ]);
        Permission::create([
            // 'name'=>'Creación de clientes',
            'name'=>'clientes.create',
            'description'=>'Crea cualquier dato de un cliente del sistema.',
        ]);
        Permission::create([
            // 'name'=>'Elimina clientes',
            'name'=>'clientes.destroy',
            'description'=>'Elimina cualquier dato de un cliente del sistema.',
        ]);

          
        // Platos
        Permission::create([
            // 'name'=>'Navegar por artículos',
            'name'=>'platos.index',
            'description'=>'Lista y navega por todos los platos del sistema.',
        ]);
        Permission::create([
            // 'name'=>'Ver detalle de platos',
            'name'=>'platos.show',
            'description'=>'Ve en detalle de cada plato del sistema.',
        ]);
        Permission::create([
            // 'name'=>'Edición de artículos',
            'name'=>'platos.edit',
            'description'=>'Edita cualquier dato de un plato del sistema.',
        ]);
        Permission::create([
            // 'name'=>'Creación de artículos',
            'name'=>'platos.create',
            'description'=>'Registra un plato en el sistema.',
        ]);

        // Menus
        Permission::create([
            // 'name'=>'Navegar por artículos',
            'name'=>'menus.index',
            'description'=>'Lista y navega por todos los Menus de platos del sistema.',
        ]);
        Permission::create([
            // 'name'=>'Ver detalle de platos',
            'name'=>'menus.show',
            'description'=>'Ve en detalle de cada Menu de platos del sistema.',
        ]);
        Permission::create([
            // 'name'=>'Creación de artículos',
            'name'=>'menus.create',
            'description'=>'Registra a un Menu en el sistema.',
        ]);
        Permission::create([
            // 'name'=>'Creación de artículos',
            'name'=>'menus.pdf',
            'description'=>'Descarga o verifica el Menu en formato PDF.',
        ]);

        // Pensionados
        Permission::create([
            // 'name'=>'Navegar por artículos',
            'name'=>'tipoclientes.index',
            'description'=>'Lista y navega por todos los clientes Pensionados  del sistema.',
        ]);
        Permission::create([
            // 'name'=>'Ver detalle de platos',
            'name'=>'tipoclientes.listpensionados',
            'description'=>'Ve en detalle de cada cliente Pensionado del sistema.',
        ]);
        Permission::create([
            // 'name'=>'Creación de artículos',
            'name'=>'tipoclientes.create',
            'description'=>'Registra a un cliente para pensionarse en el sistema.',
        ]);

         // Comandas
        Permission::create([
            // 'name'=>'Navegar por ventas',
            'name'=>'Comandas.index',
            'description'=>'Lista y navega por todos los Comandas del sistema.',
        ]);
        Permission::create([
            // 'name'=>'Ver detalle de venta',
            'name'=>'Comandas.show',
            'description'=>'Ver en detalle cada Comandas del sistema.',
        ]);
        Permission::create([
            // 'name'=>'Creación de ventas',
            'name'=>'Comandas.create',
            'description'=>'Crea cualquier dato de un Comandas del sistema.',
        ]);

        // Ventas pdf
        Permission::create([
            // 'name'=>'Descargar PDF reporte de ventas',
            'name'=>'Comandas.pdf',
            'description'=>'Puede imprimir todos los reportes de las ventas en PDF.',
        ]);


        // Cambiar estado de la Comanda
        Permission::create([
            // 'name'=>'Cambiar estado de venta',
            'name'=>'cambio.estado.comandas',
            'description'=>'Permite cambiar el estado de un venta si confirma o NO.',
        ]);

        // Reporte del día 
        Permission::create([
            // 'name'=>'Reporte por día',
            'name'=>'reports.reportes',
            'description'=>'Permite ver los reportes de las ventas por día y por rango de fecha.',
        ]);


        // Reporte por Fecha 
        Permission::create([
            // 'name'=>'Reporte por fechas',
            'name'=>'reporte.pdf',
            'description'=>'Permite descargar los reportes en un archivo pdf.',
        ]);
    }
}
