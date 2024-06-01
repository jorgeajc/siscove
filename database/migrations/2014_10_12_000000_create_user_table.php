<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{ 
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('id', 45)->primary();
            $table->string('primerNombre', 20);
            $table->string('segundoNombre', 20)->nullable();
            $table->string('primerApellido', 20);
            $table->string('segundoApellido', 20);
            $table->string('telefono');
            $table->string('email', 50)->unique();
            $table->timestamp('email_verified_at')->nullable(); 
            $table->string('password');
            $table->string('descripcion', 45); 
            $table->string('estado', 15); 
            $table->rememberToken();
            $table->timestamps(); 
        });
    } 
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
