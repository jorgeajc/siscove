<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTalleresTable extends Migration
{ 
    public function up()
    {
        Schema::create('talleres', function (Blueprint $table) { 
            $table->string('CedulaJuridica', 30);
            $table->string('nombre', 50);
            $table->string('Ubicacion', 200);
            $table->string('Contacto', 50);
            $table->string('Correo', 200);
            $table->string('Estado', 50);
            $table->timestamps();
        });
    } 
    public function down()
    {
        Schema::dropIfExists('talleres');
    }
}
