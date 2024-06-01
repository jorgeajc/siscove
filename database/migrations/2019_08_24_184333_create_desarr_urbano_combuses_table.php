<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDesarrUrbanoCombusesTable extends Migration
{ 
    public function up()
    {
        Schema::create('desarr_urbano_combuses', function (Blueprint $table) {
            $table->increments('idDUC');
            $table->date('fechaRegistro');
            $table->double('montoEstablecido', 12, 2);
            $table->double('montoRestante', 12, 2);
            $table->timestamps();
        });
    } 
    public function down()
    {
        Schema::dropIfExists('desarr_urbano_combuses');
    }
}
