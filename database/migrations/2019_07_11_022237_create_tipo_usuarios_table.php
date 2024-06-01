<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoUsuariosTable extends Migration
{ 
    public function up()
    {
        Schema::create('tipo_usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 30);
            $table->timestamps();
        });
    } 
    public function down()
    {
        Schema::dropIfExists('tipo_usuarios');
    }
}
