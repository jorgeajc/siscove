<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresupuestoLavaVehisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presupuesto_lava_vehis', function (Blueprint $table) {
            $table->increments('idPLV');
            $table->double('monto', 12, 2);
            $table->double('montoRestante', 12,2);
            $table->date('fecha'); 
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
        Schema::dropIfExists('presupuesto_lava_vehis');
    }
}
