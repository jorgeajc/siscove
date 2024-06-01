<?php

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
        //$this->call(tiposDeUsuario::class);
        //for($i=0; $i<=; $i++){
          //  $this->call(prueba::class); 
        //}
        $this->call(permisos::class);
        $this->call('prueba'); 
    }
}
