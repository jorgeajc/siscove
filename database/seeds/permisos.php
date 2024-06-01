<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class permisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //lista permisos
        Permission::create(['name' => 'admin.index']);
        Permission::create(['name' => 'admin.edit']);
        Permission::create(['name' => 'admin.show']);
        Permission::create(['name' => 'admin.create']);
        Permission::create(['name' => 'admin.destroy']);

        Permission::create(['name' => 'clientes.index']);
        Permission::create(['name' => 'clientes.edit']);
        Permission::create(['name' => 'clientes.show']);
        Permission::create(['name' => 'clientes.create']);
        Permission::create(['name' => 'clientes.destroy']);

        //Lista roles
        $Conductor = Role::create(['name' => 'Conductor']);
        $Inspector = Role::create(['name' => 'Inspector']);
        $Coordinador = Role::create(['name' => 'Coordinador']);
        $Administrador = Role::create(['name' => 'Administrador']);
        $Contacto_Gasolinera = Role::create(['name' => 'Contacto Gasolinera']);
        $Contacto_Taller = Role::create(['name' => 'Contacto Taller']);
        $Guarda = Role::create(['name' => 'Guarda']);
        $Alcalde = Role::create(['name' => 'Alcalde']); 

        //Asignar permisos
        $Administrador->givePermissionTo([
            'admin.index',
            'admin.edit', 
            'admin.show',
            'admin.create',
            'admin.destroy',
            'clientes.index',
            'clientes.edit', 
            'clientes.show',
            'clientes.create',
            'clientes.destroy'
        ]); 
        $Coordinador->givePermissionTo([
            'clientes.index',
            'clientes.edit', 
            'clientes.show',
            'clientes.create',
            'clientes.destroy'
        ]);
        $Alcalde->givePermissionTo([
            'clientes.index',
            'clientes.edit', 
            'clientes.show',
            'clientes.create',
            'clientes.destroy'
        ]);

        $this->call(usuarios::class);

        //asignando roles 
        $user = User::find(123); 
        $user->assignRole('Administrador'); 
        
        $user = User::find(117220314); 
        $user->assignRole('Coordinador'); 

        $user = User::find(504200697); 
        $user->assignRole('Coordinador'); 

        $user = User::find(504150009); 
        $user->assignRole('Coordinador'); 

        $user = User::find(504070395); 
        $user->assignRole('Coordinador');  
    }
}