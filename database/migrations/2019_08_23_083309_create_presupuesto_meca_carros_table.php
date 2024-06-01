<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresupuestoMecaCarrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presupuesto_meca_carros', function (Blueprint $table) {
            $table->increments('idPMC');
            $table->date('fechaRegistro');
            $table->double('montoEstablecido',12,2);
            $table->double('montoRestado',12,2);
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
        Schema::dropIfExists('presupuesto_meca_carros');
    }
}
