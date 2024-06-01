<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresupuestoMecaMotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presupuesto_meca_motos', function (Blueprint $table) {
            $table->increments('idPMM');
            $table->date('fechaRegistro');
            $table->double('montoEstablecido', 12, 2);
            $table->double('montoRestante', 12, 2);
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
        Schema::dropIfExists('presupuesto_meca_motos');
    }
}
