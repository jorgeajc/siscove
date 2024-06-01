<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresupuestoHistoricoMCsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presupuesto_historico_m_cs', function (Blueprint $table) {
            $table->increments('idHMC');
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
        Schema::dropIfExists('presupuesto_historico_m_cs');
    }
}
