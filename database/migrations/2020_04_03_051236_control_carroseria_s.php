<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ControlCarroseriaS extends Migration
{ 
    public function up()
    {
        Schema::create('control_carrocerias', function (Blueprint $table) {
            $table->increments('id'); 
            $table->unsignedInteger('idSalidaVehicular');
            $table->foreign('idSalidaVehicular')->references('id')->on('salida_vehiculars')->onDelete('cascade'); 

            $table->string('bumperTrasero', 10);  
            $table->string('bumperDelantero', 10);  
            $table->string('guardaBarroDD', 10);  
            $table->string('guardaBarroDI', 10);  
            $table->string('guardaBarroTD', 10);  
            $table->string('guardaBarroTI', 10);  
            $table->string('tapaBaul', 10);  
            $table->string('tapaMotor', 10);  
            $table->string('parabrisasTrasero', 10);  
            $table->string('parabrisasDelantero', 10);  
            $table->string('puertaDD', 10);  
            $table->string('puertaDI');  
            $table->string('puertaTD', 10);   
            $table->string('puertaTI', 10);  
            $table->string('quisioD', 10);  
            $table->string('quisioI', 10);
            $table->string('techo', 10);   
            $table->string('observaciones')->nullable();   
            $table->timestamps(); 
        });
    }
 
    public function down()
    {      
        Schema::dropIfExists('control_carroceria_s');
    }
}
