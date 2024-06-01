<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class tiposDeUsuario extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {  
        DB::table('roles')->insert([
            'name' => 'Conductor',
            'created_at' =>  Carbon::now(),
            'updated_at' => Carbon::now(),
            'guard_name' => 'web'
        ]);
        DB::table('roles')->insert([
            'name' => 'Inspector',
            'created_at' =>  Carbon::now(),
            'updated_at' => Carbon::now(),
            'guard_name' => 'web'
        ]);
        DB::table('roles')->insert([
            'name' => 'Coordinador',
            'created_at' =>  Carbon::now(),
            'updated_at' => Carbon::now(),
            'guard_name' => 'web'
        ]);
        DB::table('roles')->insert([
            'name' => 'Administrador',
            'created_at' =>  Carbon::now(),
            'updated_at' => Carbon::now(),
            'guard_name' => 'web'
        ]);
        DB::table('roles')->insert([
            'name' => 'Contacto Gasolinera',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'guard_name' => 'web'
        ]);
        DB::table('roles')->insert([
            'name' => 'Contacto Taller',
            'created_at' =>  Carbon::now(),
            'updated_at' => Carbon::now(),
            'guard_name' => 'web'        
        ]);
        DB::table('roles')->insert([
            'name' => 'Guarda',
            'created_at' =>  Carbon::now(),
            'updated_at' => Carbon::now(),
            'guard_name' => 'web'
        ]);
        DB::table('roles')->insert([
            'name' => 'Alcalde',
            'created_at' =>  Carbon::now(),
            'updated_at' => Carbon::now(),
            'guard_name' => 'web'
        ]);
    }
}
