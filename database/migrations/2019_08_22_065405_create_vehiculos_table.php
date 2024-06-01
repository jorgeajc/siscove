<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiculosTable extends Migration
{ 
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->string('placa', 15)->primary();
            $table->string('marca', 50);
            $table->string('modelo', 50);
            $table->integer('cantidadAsientos');
            $table->string('tipo', 10);
            $table->string('estado', 50);
            $table->date('marchamo');
            $table->date('riteve');
            $table->timestamps(); 
        });
    } 
    public function down()
    {
        Schema::dropIfExists('vehiculos');
    }
}
