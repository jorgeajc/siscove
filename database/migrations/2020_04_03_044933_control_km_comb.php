<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ControlKmComb extends Migration
{ 
    public function up()
    {
        Schema::create('control_km_combs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idSalidaVehicular'); 
            $table->foreign('idSalidaVehicular')->references('id')->on('salida_vehiculars')->onDelete('cascade');  
            $table->string('dia', 20); 
            $table->date('fecha');  
            $table->time('horaSalida');
            $table->time('horaIngreso');
            $table->double('kmSalida',10);
            $table->double('kmIngreso',10); 
            $table->double('combustibleSalida',10);
            $table->double('combustibleIngreso',10);  
            $table->string('choferSalida',45);  
            $table->foreign('choferSalida')->references('id')->on('users');  
            $table->string('choferIngreso',45); 
            $table->foreign('choferIngreso')->references('id')->on('users'); 
            $table->string('guardaSalida',45);   
            $table->foreign('guardaSalida')->references('id')->on('users'); 
            $table->string('guardaIngreso',45);  
            $table->foreign('guardaIngreso')->references('id')->on('users'); 
            $table->timestamps(); 
        });
    } 
    public function down()
    {
        Schema::dropIfExists('control_km_combs');
    }
}
