<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDireccionTecnicaCombusesTable extends Migration
{ 
    public function up()
    {
        Schema::create('direccion_tecnica_combuses', function (Blueprint $table) {
            $table->increments('idDTC');
            $table->date('fechaRegistro');
            $table->double('montoEstablecido', 12, 2);
            $table->double('montoRestante', 12, 2);
            $table->timestamps();
        });
    } 
    public function down()
    {
        Schema::dropIfExists('direccion_tecnica_combuses');
    }
}
