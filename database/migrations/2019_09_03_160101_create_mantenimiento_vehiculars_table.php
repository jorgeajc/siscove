<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMantenimientoVehicularsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mantenimiento_vehiculars', function (Blueprint $table) {
            $table->increments('idMV');
            //outomovil, pickap etc
            $table->string('tipoVehiculo', 100);
            $table->string('Motor', 50); 
            $table->string('modelo', 50);
            $table->double('kilometros',10);
            $table->date('fechaIngreso');
            $table->string('propietario', 100); 
            $table->string('descripcion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mantenimiento_vehiculars');
    }
}
