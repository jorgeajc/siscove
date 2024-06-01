<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdministracionCombusesTable extends Migration
{ 
    public function up()
    {
        Schema::create('administracion_combuses', function (Blueprint $table) {
            $table->increments('idAC');
            $table->date('fechaRegistro');
            $table->double('montoEstablecido', 12, 2);
            $table->double('montoRestante', 12, 2);
            $table->timestamps();
        });
    } 
    public function down()
    {
        Schema::dropIfExists('administracion_combuses');
    }
}
