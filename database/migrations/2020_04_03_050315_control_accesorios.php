<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ControlAccesorios extends Migration
{ 
    public function up()
    {
        Schema::create('control_accesorios', function (Blueprint $table) {
            $table->increments('id'); 
            $table->unsignedInteger('idSalidaVehicular'); 
            $table->foreign('idSalidaVehicular')->references('id')->on('salida_vehiculars')->onDelete('cascade'); 

            $table->string('radio', 10);  
            $table->string('encenderdor', 10);  
            $table->string('alfombra', 10);  
            $table->string('antena', 10);  
            $table->string('espejoExterior', 10);  
            $table->string('espejoInterior', 10);  
            $table->string('extintor', 10);  
            $table->string('gata', 10);  
            $table->string('llaveRana', 10);  
            $table->string('llaveRepuesto', 10);  
            $table->string('triangulos', 10);  
            $table->string('observaciones')->nullable();  
            $table->string('estado', 20);    
            $table->timestamps(); 
        });
    } 
    public function down()
    {
        Schema::dropIfExists('control_accesorios');
    }
}
