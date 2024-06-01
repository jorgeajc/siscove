<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresupuestoCombustiblesTable extends Migration
{ 
    public function up()
    {
        Schema::create('presupuesto_combustibles', function (Blueprint $table) {
            $table->increments('idPC');
            $table->date('fechaRegistro');
            $table->double('montoEstablecido', 12, 2);
            $table->double('montoRestante', 12, 2);
            $table->timestamps();
        });
    } 
    public function down()
    {
        Schema::dropIfExists('presupuesto_combustibles');
    }
}
