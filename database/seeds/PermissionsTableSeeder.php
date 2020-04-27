<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;


class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Computer
        Permission::create([
            'name' => 'Navegar usuarios',
            'slug' => 'users.index',
            'description' => 'Lista y navega los usuarios del sistema',
        ]);

        Permission::create([
            'name' => 'Ver detalle de usuario',
            'slug' => 'users.show',
            'description' => 'Ver en detalle cada usuario del sistema',
        ]);

        Permission::create([
            'name' => 'Crear usuarios',
            'slug' => 'users.create',
            'description' => 'Crear un usuario del sistema',
        ]);

        Permission::create([
            'name' => 'Edicion de  usuarios',
            'slug' => 'users.edit',
            'description' => 'Editar cualquier dato de un usuario del sistema',
        ]);

        Permission::create([
            'name' => 'Eliminar usuario',
            'slug' => 'users.destroy',
            'description' => 'Eliminar cualquier usuario del sistema',
        ]);

        //Company
          Permission::create([
            'name' => 'Navegar compañias',
            'slug' => 'companies.index',
            'description' => 'Lista y navega las compañias del sistema',
        ]);

        Permission::create([
            'name' => 'Ver detalle de compañia',
            'slug' => 'companies.show',
            'description' => 'Ver en detalle cada compañia del sistema',
        ]);

        Permission::create([
            'name' => 'Crear compañias',
            'slug' => 'companies.create',
            'description' => 'Crear una compañia del sistema',
        ]);

        Permission::create([
            'name' => 'Edicion de compañias',
            'slug' => 'companies.edit',
            'description' => 'Editar cualquier dato de una compañia del sistema',
        ]);

        Permission::create([
            'name' => 'Eliminar compañia',
            'slug' => 'companies.destroy',
            'description' => 'Eliminar cualquier compañia del sistema',
        ]);
   
    }
}
