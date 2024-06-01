<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalidaVehicularsTable extends Migration
{ 
    public function up()
    {
        Schema::create('salida_vehiculars', function (Blueprint $table) {
            $table->increments('id');  
            $table->date('fechaAutorizacionSalida');
            $table->date('fechaAutorizacionIngreso'); 
            $table->double('totalKm',40);
            
            $table->timestamps();

            $table->string('placa', 15)->index();
            $table->foreign('placa')->references('placa')->on('vehiculos');  

            $table->unsignedInteger('oficinaSolicitante'); 
            $table->foreign('oficinaSolicitante')->references('id')->on('departamentos'); 
        });
    } 
    public function down()
    {
        Schema::dropIfExists('salida_vehiculars');
    }
}
