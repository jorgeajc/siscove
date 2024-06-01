<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicituds', function (Blueprint $table) {
            $table->increments('idSolicitud');
            $table->string('id', 45);
            $table->string('primerNombre', 20);
            $table->string('segundoNombre', 20)->nullable();
            $table->string('primerApellido', 20);
            $table->string('segundoApellido', 20);
            $table->string('departamento',100);
            $table->string('telefono');
            $table->string('email', 50); 

            $table->string('descripcion');  
            $table->string('destino');
            $table->integer('numPersonas');

            $table->date('fechaEntrega');
            $table->time('horaEntrega');
            $table->date('fechaDevolucion');
            $table->time('horaDevolucion');

            $table->string('estado', 50);

            $table->boolean('NecesitaConduc');
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
        Schema::dropIfExists('solicituds');
    }
}
