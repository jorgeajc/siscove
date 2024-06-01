<?php

use Illuminate\Database\Seeder;

class usuarios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //usuarios 
        //Administrador
        DB::table('users')->insert([
            'id' => '123',
            'primerNombre' => 'Admin',
            'segundoNombre' => '', 
            'primerApellido' => 'Admin', 
            'segundoApellido' => 'Admin', 
            'telefono' => '0000000', 
            'email' => 'jogealbertojc@Admin.com',
            'password' => Hash::make('abc123'),
            'tipoUsuario' => '4', 
            'descripcion' => '10', 
            'estado' => 'Activo' 
        ]); 
        //jorge
        DB::table('users')->insert([
            'id' => '117220314',
            'primerNombre' => 'Jorge',
            'segundoNombre' => 'Alberto', 
            'primerApellido' => 'Jimenez', 
            'segundoApellido' => 'Carrillo', 
            'telefono' => '61953152', 
            'email' => 'albertop2203@gmail.com',
            'password' => Hash::make('abc123'),
            'tipoUsuario' => '3', 
            'descripcion' => '1', 
            'estado' => 'Activo' 
        ]); 
        //Jimena
        DB::table('users')->insert([
            'id' => '504200697',
            'primerNombre' => 'Kitcha',
            'segundoNombre' => 'Jimena', 
            'primerApellido' => 'Rosales', 
            'segundoApellido' => 'Rosales', 
            'telefono' => '64393206', 
            'email' => 'kitcharosales11@gmail.com',
            'password' => Hash::make('abc123'),
            'tipoUsuario' => '3', 
            'descripcion' => '2',  
            'estado' => 'Activo' 
        ]);
        //Andreina
        DB::table('users')->insert([
            'id' => '504150009',
            'primerNombre' => 'andreina',
            'segundoNombre' => 'de los Angeles ', 
            'primerApellido' => 'Rosales', 
            'segundoApellido' => 'Gomez', 
            'telefono' => '84496571', 
            'email' => 'andreina83893858@gmail.com',
            'password' => Hash::make('abc123'),
            'tipoUsuario' => '3', 
            'descripcion' => '3',  
            'estado' => 'Activo' 
        ]);
        //Damaris
        DB::table('users')->insert([
            'id' => '504070395',
            'primerNombre' => 'Damaris',
            'primerApellido' => 'Matarrita', 
            'segundoApellido' => 'Vasquez', 
            'telefono' => '87429522', 
            'email' => 'damvas1423@gmail.com',
            'password' => Hash::make('abc123'),
            'tipoUsuario' => '3', 
            'descripcion' => '4',  
            'estado' => 'Activo' 
        ]);
    }
}
