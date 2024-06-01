<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresupuestoHistoricoAAsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presupuesto_historico_a_as', function (Blueprint $table) {
            $table->increments('idHAA');
            $table->date('fechaCreacion'); 
            $table->string('numFactura');
            $table->double('montoFactura', 12, 2); 
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
        Schema::dropIfExists('presupuesto_historico_a_as');
    }
}
