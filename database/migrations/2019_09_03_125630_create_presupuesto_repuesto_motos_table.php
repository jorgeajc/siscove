<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresupuestoRepuestoMotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presupuesto_repuesto_motos', function (Blueprint $table) {
            $table->increments('idPRM');
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
        Schema::dropIfExists('presupuesto_repuesto_motos');
    }
}
