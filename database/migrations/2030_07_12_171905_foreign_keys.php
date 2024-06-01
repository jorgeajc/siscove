<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForeignKeys extends Migration
{
    public function up()
    {
        //usuarios
        Schema::table('users', function (Blueprint $table) {
            $table->integer('tipoUsuario')->unsigned();
            $table->foreign('tipoUsuario')->references('id')->on('roles');  
        });

        //historico
        Schema::table('presupuesto_historico_a_as', function (Blueprint $table) {  
            $table->integer('presupuesto_aire_acond')->unsigned();
            $table->foreign('presupuesto_aire_acond')->references('idPAA')->on('presupuesto_aire_aconds');  
        }); 

        Schema::table('presupuesto_historico_r_cs', function (Blueprint $table) {  
            $table->integer('presupuesto_R_C')->unsigned();
            $table->foreign('presupuesto_R_C')->references('idPRC')->on('presupuesto_r_cs');  
        });

        Schema::table('presupuesto_historico_m_cs', function (Blueprint $table) {  
            $table->integer('presupuesto_meca_carro')->unsigned();
            $table->foreign('presupuesto_meca_carro')->references('idPMC')->on('presupuesto_meca_carros');  
        }); 

        Schema::table('presupuesto_historico_cs', function (Blueprint $table) {  
            $table->integer('presupuesto_combustible')->unsigned();
            $table->foreign('presupuesto_combustible')->references('idPC')->on('presupuesto_combustibles');  
        }); 
        Schema::table('historico_admini_combuses', function (Blueprint $table) {  
            $table->integer('administracion_combus')->unsigned();
            $table->foreign('administracion_combus')->references('idAC')->on('administracion_combuses');  
        });
        Schema::table('historico_desarr_urbano_combuses', function (Blueprint $table) {  
            $table->integer('desarr_urbano_combus')->unsigned();
            $table->foreign('desarr_urbano_combus')->references('idDUC')->on('desarr_urbano_combuses');  
        });
        Schema::table('historico_direccion_tecnica_combuses', function (Blueprint $table) {  
            $table->integer('direc_tec_combus')->unsigned();
            $table->foreign('direc_tec_combus')->references('idDTC')->on('direccion_tecnica_combuses');  
        });
        Schema::table('presupuesto_historico_m_ms', function (Blueprint $table) {  
            $table->integer('presupuesto_meca_moto')->unsigned();
            $table->foreign('presupuesto_meca_moto')->references('idPMM')->on('presupuesto_meca_motos');  
        });
        Schema::table('presupuesto_historico_rep_motos', function (Blueprint $table) {  
            $table->integer('presu_rep_moto')->unsigned();
            $table->foreign('presu_rep_moto')->references('idPRM')->on('presupuesto_repuesto_motos');  
        });
        Schema::table('presupuesto_historico_l_vs', function (Blueprint $table) {  
            $table->integer('presupuesto_lava_vehi')->unsigned();
            $table->foreign('presupuesto_lava_vehi')->references('idPLV')->on('presupuesto_lava_vehis');  
        });

        //mantenimiento vehicular - vehiculos
        Schema::table('mantenimiento_vehiculars', function (Blueprint $table) {  
            $table->string('placa', 15)->index();
            $table->foreign('placa')->references('placa')->on('vehiculos');  
        }); 
        //historico presupuesto - vehiculos
        Schema::table('presupuesto_historico_a_as', function (Blueprint $table) {  
            $table->string('placa', 15)->index();
            $table->foreign('placa')->references('placa')->on('vehiculos');  
        });
        //
        Schema::table('presupuesto_historico_cs', function (Blueprint $table) {  
            $table->string('placa', 15)->index();
            $table->foreign('placa')->references('placa')->on('vehiculos');  
        });
        Schema::table('historico_admini_combuses', function (Blueprint $table) {  
            $table->string('placa', 15)->index();
            $table->foreign('placa')->references('placa')->on('vehiculos');  
        });
        Schema::table('historico_desarr_urbano_combuses', function (Blueprint $table) {  
            $table->string('placa', 15)->index();
            $table->foreign('placa')->references('placa')->on('vehiculos');  
        });
        Schema::table('historico_direccion_tecnica_combuses', function (Blueprint $table) {  
            $table->string('placa', 15)->index();
            $table->foreign('placa')->references('placa')->on('vehiculos');  
        });
        Schema::table('presupuesto_historico_m_cs', function (Blueprint $table) {  
            $table->string('placa', 15)->index();
            $table->foreign('placa')->references('placa')->on('vehiculos');  
        });
        Schema::table('presupuesto_historico_m_ms', function (Blueprint $table) {  
            $table->string('placa', 15)->index();
            $table->foreign('placa')->references('placa')->on('vehiculos');  
        });
        Schema::table('presupuesto_historico_r_cs', function (Blueprint $table) {  
            $table->string('placa', 15)->index();
            $table->foreign('placa')->references('placa')->on('vehiculos');  
        }); 
        Schema::table('presupuesto_historico_rep_motos', function (Blueprint $table) {  
            $table->string('placa', 15)->index();
            $table->foreign('placa')->references('placa')->on('vehiculos');  
        });
        Schema::table('presupuesto_historico_l_vs', function (Blueprint $table) {  
            $table->string('placa', 15)->index();
            $table->foreign('placa')->references('placa')->on('vehiculos');  
        });

        Schema::table('solicituds', function (Blueprint $table) {
            $table->string('placa', 15)->index()->nullable();
            $table->foreign('placa')->references('placa')->on('vehiculos');  
        });
        Schema::table('solicituds', function (Blueprint $table) {  
            $table->string('conductor', 45)->nullable();
            $table->foreign('conductor')->references('id')->on('users');  
        });
        Schema::table('licencias', function (Blueprint $table) {
            $table->string('user', 45)->nullable();
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');;  
        }); 

        Schema::table('historico_admini_combuses', function (Blueprint $table) {   
            $table->string('gasFK', 45)->nullable();
            $table->foreign('gasFK')
                  ->references('cedulaJuridica')
                  ->on('gasolineras');
        });
        Schema::table('historico_desarr_urbano_combuses', function (Blueprint $table) {  
            $table->string('gasFK', 45)->nullable();
            $table->foreign('gasFK')->references('cedulaJuridica')->on('gasolineras');  
        });
        Schema::table('historico_direccion_tecnica_combuses', function (Blueprint $table) {  
            $table->string('gasFK', 45)->nullable();
            $table->foreign('gasFK')->references('cedulaJuridica')->on('gasolineras');  
        });

    } 
    public function down()
    {
        //
    }
}
