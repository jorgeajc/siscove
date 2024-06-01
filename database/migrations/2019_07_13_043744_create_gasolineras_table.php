<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGasolinerasTable extends Migration
{
    public function up()
    {
        Schema::create('gasolineras', function (Blueprint $table) {
            $table->string('cedulaJuridica', 45)->primary();
            $table->string('nombre', 45);
            $table->string('ubicacion');
            $table->string('contacto', 45);
            $table->string('correo', 45);
            $table->string('estado', 50);
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('gasolineras');
    }
}
