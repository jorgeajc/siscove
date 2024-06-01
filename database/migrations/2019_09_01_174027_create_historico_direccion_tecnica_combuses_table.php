<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoricoDireccionTecnicaCombusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico_direccion_tecnica_combuses', function (Blueprint $table) {
            $table->increments('idHDTC');
            $table->date('fechaCreacion');
            $table->string('numeroCupon');
            $table->string('numeroFactura');
            $table->string('cantLitros'); 
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
        Schema::dropIfExists('historico_direccion_tecnica_combuses');
    }
}
