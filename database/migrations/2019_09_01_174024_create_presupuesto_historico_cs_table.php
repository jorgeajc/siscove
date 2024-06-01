<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresupuestoHistoricoCsTable extends Migration
{ 
    public function up()
    {
        Schema::create('presupuesto_historico_cs', function (Blueprint $table) {
            $table->increments('idHC');
            $table->date('fechaCreacion');
            $table->string('numeroCupon');
            $table->string('numeroFactura');
            $table->string('cantLitros'); 
            $table->double('montoFactura', 12, 2); 
            $table->timestamps();
        });
    } 
    public function down()
    {
        Schema::dropIfExists('presupuesto_historico_cs');
    }
}
