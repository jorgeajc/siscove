<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class prueba extends Seeder
{ 
    public function run()
    { 
            //Talleres
        DB::table('talleres')->insert([
            'cedulaJuridica' => '5-222-469216',
            'nombre' => 'Repuestos la peninsula',
            'ubicacion' => 'Nicoya',
            'contacto' => '2685-5791',
            'correo' => 'sepa@gmail.com', 
            'estado' => 'Activo'
        ]);
        DB::table('talleres')->insert([
            'cedulaJuridica' => '22-22-2222',
            'nombre' => 'La gran via',
            'ubicacion' => 'Nicoya',
            'contacto' => '2222-2222',
            'correo' => 'quiensabe@gmail.com', 
            'estado' => 'Activo'
        ]);
            //Gasolineras
        DB::table('gasolineras')->insert([
            'cedulaJuridica' => '3-101-469516',
            'nombre' => 'La alianza, S.A.',
            'ubicacion' => 'Contiguo Agencia Coca Cola, Nicoya, Guanacaste.',
            'contacto' => '2685-6325',
            'correo' => 'nose@gmail.com', 
            'estado' => 'Activo'
        ]);
        DB::table('gasolineras')->insert([
            'cedulaJuridica' => '1-222-123456',
            'nombre' => 'G.S.M',
            'ubicacion' => 'Nicoya, Guanacaste.',
            'contacto' => '2222-3333',
            'correo' => 'quiensabe@gmail.com', 
            'estado' => 'Activo'
        ]);
        //lista de presupuestos 
            //presupuesto general
        DB::table('presupuesto_generals')->insert([
            'fechaRegistro' => '2019-01-01',
            'montoEstablecido' => '0',
            'montoRestante' => '0', 
        ]);
            //presupuesto combustible
        DB::table('presupuesto_combustibles')->insert([
            'fechaRegistro' => '2019-02-02',
            'montoEstablecido' => '600000',
            'montoRestante' => '600000', 
        ]);
            //presupuesto mecanica de carros 
        DB::table('presupuesto_meca_carros')->insert([
            'fechaRegistro' => '2019-02-02',
            'montoEstablecido' => '8000000',
            'montoRestado' => '8000000', 
        ]);
             //presupuesto repuesto de carros 
        DB::table('presupuesto_r_cs')->insert([
            'fechaRegistro' => '2019-02-02',
            'montoEstablecido' => '4000000',
            'montoRestado' => '4000000', 
        ]);
            //presupuesto mecanica de motos
        DB::table('presupuesto_meca_motos')->insert([
            'fechaRegistro' => '2019-02-02',
            'montoEstablecido' => '2500000',
            'montoRestante' => '2500000', 
        ]); 
            //presupuesto repuesto motos 
        DB::table('presupuesto_repuesto_motos')->insert([
                'fechaRegistro' => '2019-02-02',
                'montoEstablecido' => '1000000',
                'montoRestante' => '1000000', 
        ]); 
            //presupuesto aire acondicionado  
        DB::table('presupuesto_aire_aconds')->insert([
            'fechaRegistro' => '2018-02-02',
            'montoEstablecido' => '1000000',
            'montoRestante' => '1000000',  
        ]);   
            //presupuesto lavado
        DB::table('presupuesto_lava_vehis')->insert([
            'monto' => '100000',
            'fecha' => '2018-02-02',
            'montoRestante' => '100000',   
        ]);  
            //presupuesto administracion combustible
        DB::table('administracion_combuses')->insert([
            'fechaRegistro' => '2019-01-01',
            'montoEstablecido' => '600000',
            'montoRestante' => '600000',  
        ]); 
            //presupuesto desarrollo urbano combustible
        DB::table('desarr_urbano_combuses')->insert([
            'fechaRegistro' => '2019-01-01',
            'montoEstablecido' => '500000',
            'montoRestante' => '500000',  
        ]); 
            //presupuesto direccion tecnica combustible
        DB::table('direccion_tecnica_combuses')->insert([
            'fechaRegistro' => '2019-01-01',
            'montoEstablecido' => '500000',
            'montoRestante' => '500000', 
        ]);
        //
        //
        //dependencias
            //Departamentos
        DB::table('departamentos')->insert([ 
            'nombreDeparta' => ' Bienes Inmuebles', 
        ]);
        DB::table('departamentos')->insert([ 
            'nombreDeparta' => ' Cobro Administrativo', 
        ]);
        DB::table('departamentos')->insert([ 
            'nombreDeparta' => ' Comercial', 
        ]);
        DB::table('departamentos')->insert([ 
            'nombreDeparta' => ' Estacionómetros', 
        ]);
        DB::table('departamentos')->insert([ 
            'nombreDeparta' => ' Patentes', 
        ]);
        DB::table('departamentos')->insert([ 
            'nombreDeparta' => ' Plataforma Servicios', 
        ]);
        DB::table('departamentos')->insert([ 
            'nombreDeparta' => ' Planificación Urbana', 
        ]);
        DB::table('departamentos')->insert([ 
            'nombreDeparta' => ' Urbanismo', 
        ]);
        DB::table('departamentos')->insert([ 
            'nombreDeparta' => ' comunicación ', 
        ]);
        DB::table('departamentos')->insert([ 
            'nombreDeparta' => ' servicios generales', 
        ]); 
        DB::table('departamentos')->insert([ 
            'nombreDeparta' => 'Tesorería', 
        ]);
        DB::table('departamentos')->insert([ 
            'nombreDeparta' => 'Recursos Humanos', 
        ]);  
            //Vehiculos
        DB::table('vehiculos')->insert([
            'placa' => 'SM5900',
            'marca' => 'Toyota',
            'modelo' => 'Rav4 2013', 
            'cantidadAsientos' => '5', 
            'tipo' => 'carro', 
            'estado' => 'Activo',
            'marchamo' => Carbon::now(),
            'riteve' => Carbon::now(), 
        ]);
        DB::table('vehiculos')->insert([
            'placa' => 'SM0872',
            'marca' => 'Toyota',
            'modelo' => 'Hilux 2013', 
            'cantidadAsientos' => '4', 
            'tipo' => 'carro', 
            'estado' => 'Activo', 
            'marchamo' => Carbon::now(),
            'riteve' => Carbon::now(), 
        ]); 
        DB::table('vehiculos')->insert([
            'placa' => 'SM4862',
            'marca' => 'Mitsubishi',
            'modelo' => 'Montero 2009', 
            'cantidadAsientos' => '5', 
            'tipo' => 'carro', 
            'estado' => 'Activo',
            'marchamo' => Carbon::now(),
            'riteve' => Carbon::now(), 
        ]);
        DB::table('vehiculos')->insert([
            'placa' => 'SM5029',
            'marca' => 'Mitsubishi',
            'modelo' => 'Sport 2009', 
            'cantidadAsientos' => '4', 
            'tipo' => 'carro', 
            'estado' => 'Activo', 
            'marchamo' => Carbon::now(),
            'riteve' => Carbon::now(), 
        ]);
        DB::table('vehiculos')->insert([
            'placa' => 'SM5027',
            'marca' => 'Mitsubishi',
            'modelo' => 'Sport 2009', 
            'cantidadAsientos' => '5', 
            'tipo' => 'carro', 
            'estado' => 'Activo',
            'marchamo' => Carbon::now(),
            'riteve' => Carbon::now(), 
        ]);
        DB::table('vehiculos')->insert([
            'placa' => 'SM6029',
            'marca' => 'Toyota',
            'modelo' => 'Terios Bego 2015', 
            'cantidadAsientos' => '4', 
            'tipo' => 'carro', 
            'estado' => 'Activo', 
            'marchamo' => Carbon::now(),
            'riteve' => Carbon::now(), 
        ]); 
        DB::table('vehiculos')->insert([
            'placa' => 'SM3623',
            'marca' => 'Toyota',
            'modelo' => 'Terios Bego 2001', 
            'cantidadAsientos' => '4', 
            'tipo' => 'carro', 
            'estado' => 'Activo', 
            'marchamo' => Carbon::now(),
            'riteve' => Carbon::now(), 
        ]); 
        DB::table('vehiculos')->insert([
            'placa' => 'SM6144',
            'marca' => 'Toyota',
            'modelo' => 'Hilux 2015', 
            'cantidadAsientos' => '4', 
            'tipo' => 'carro', 
            'estado' => 'Activo', 
            'marchamo' => Carbon::now(),
            'riteve' => Carbon::now(), 
        ]); 
        //mantenimiento vehicular
        
        /* //desglose de presupuestos
            //historico aire acondicionado
        DB::table('presupuesto_historico_a_as')->insert([
            'fechaCreacion' => '2018-02-02',
            'numFactura' => '1010000001716',
            'montoFactura' => '68558', 
            'placa' => 'SM5900' ,
            'presupuesto_aire_acond'=>1,
        ]);
        DB::table('presupuesto_historico_a_as')->insert([
            'fechaCreacion' => '2018-02-02',
            'numFactura' => '1010000002296',
            'montoFactura' => '58356',
            'placa' => 'SM5900',  
            'presupuesto_aire_acond'=>1,
        ]);
        //historico mecanica de carros
        DB::table('presupuesto_historico_m_cs')->insert([
            'fechaCreacion' => '2018-02-02',
            'numFactura' => '1010000001714',
            'montoFactura' => '371653',
            'placa' => 'SM5900',  
            'presupuesto_meca_carro'=>1,
        ]); 
        DB::table('presupuesto_historico_m_cs')->insert([
            'fechaCreacion' => '2018-02-02',
            'numFactura' => '1010000001715',
            'montoFactura' => '735161.65',
            'placa' => 'SM5900',  
            'presupuesto_meca_carro'=>1,
        ]); 
        DB::table('presupuesto_historico_m_cs')->insert([
            'fechaCreacion' => '2018-02-02',
            'numFactura' => '1010000001869',
            'montoFactura' => '151947',
            'placa' => 'SM5900',  
            'presupuesto_meca_carro'=>1,
        ]); 
        DB::table('presupuesto_historico_m_cs')->insert([
            'fechaCreacion' => '2018-02-02',
            'numFactura' => '1010000001942',
            'montoFactura' => '55850',
            'placa' => 'SM5900',  
            'presupuesto_meca_carro'=>1,
        ]); 
        DB::table('presupuesto_historico_m_cs')->insert([
            'fechaCreacion' => '2018-02-02',
            'numFactura' => '1010000001954',
            'montoFactura' => '323714.56',
            'placa' => 'SM5900',  
            'presupuesto_meca_carro'=>1,
        ]); 
        DB::table('presupuesto_historico_m_cs')->insert([
            'fechaCreacion' => '2018-02-02',
            'numFactura' => '1010000001955',
            'montoFactura' => '968761',
            'placa' => 'SM5900',  
            'presupuesto_meca_carro'=>1,
        ]); 
        DB::table('presupuesto_historico_m_cs')->insert([
            'fechaCreacion' => '2018-02-02',
            'numFactura' => '1010000001956',
            'montoFactura' => '85051.04',
            'placa' => 'SM5900',  
            'presupuesto_meca_carro'=>1,
        ]); 
        DB::table('presupuesto_historico_m_cs')->insert([
            'fechaCreacion' => '2018-02-02',
            'numFactura' => '1010000002297',
            'montoFactura' => '485000',
            'placa' => 'SM5900',  
            'presupuesto_meca_carro'=>1,
        ]); 
        DB::table('presupuesto_historico_m_cs')->insert([
            'fechaCreacion' => '2018-02-02',
            'numFactura' => '1010000002298',
            'montoFactura' => '598110.99',
            'placa' => 'SM5900',  
            'presupuesto_meca_carro'=>1,
        ]); 
        DB::table('presupuesto_historico_m_cs')->insert([
            'fechaCreacion' => '2018-02-02',
            'numFactura' => '1010000002293',
            'montoFactura' => '67373',
            'placa' => 'SM5900',  
            'presupuesto_meca_carro'=>1,
        ]); 
        //historico repuesto de carros   
        DB::table('presupuesto_historico_r_cs')->insert([
            'fechaCreacion' => '2018-02-02',
            'numFactura' => '1010000001844',
            'montoFactura' => '92148',
            'placa' => 'SM5900',  
            'presupuesto_R_C'=>1,
        ]); 
        DB::table('presupuesto_historico_r_cs')->insert([
            'fechaCreacion' => '2018-02-02',
            'numFactura' => '1010000001859',
            'montoFactura' => '5375',
            'placa' => 'SM5900',  
            'presupuesto_R_C'=>1,
        ]); 
        DB::table('presupuesto_historico_r_cs')->insert([
            'fechaCreacion' => '2018-02-02',
            'numFactura' => '1010000001865',
            'montoFactura' => '195000',
            'placa' => 'SM5900',  
            'presupuesto_R_C'=>1,
        ]); 
        DB::table('presupuesto_historico_r_cs')->insert([
            'fechaCreacion' => '2018-02-02',
            'numFactura' => '1010000002295',
            'montoFactura' => '187229',
            'placa' => 'SM5900',  
            'presupuesto_R_C'=>1,
        ]); 
        DB::table('presupuesto_historico_r_cs')->insert([
            'fechaCreacion' => '2018-02-02',
            'numFactura' => '1010000002301',
            'montoFactura' => '200163.36',
            'placa' => 'SM5900',  
            'presupuesto_R_C'=>1,
        ]); 
        DB::table('presupuesto_historico_r_cs')->insert([
            'fechaCreacion' => '2018-02-02',
            'numFactura' => '1010000002302',
            'montoFactura' => '380913',
            'placa' => 'SM5900',  
            'presupuesto_R_C'=>1,
        ]); 
        //historico mecanica de motos 
        DB::table('presupuesto_historico_m_ms')->insert([
            'fechaCreacion' => '2018-02-02',
            'numFactura' => '1010000001972',
            'montoFactura' => '108000',
            'placa' => 'SM5900',  
            'presupuesto_meca_moto'=>1,
        ]);  
        DB::table('presupuesto_historico_m_ms')->insert([
            'fechaCreacion' => '2018-02-02',
            'numFactura' => '1010000002281',
            'montoFactura' => '236664.02',
            'placa' => 'SM5900',  
            'presupuesto_meca_moto'=>1,
        ]);
        DB::table('presupuesto_historico_m_ms')->insert([
            'fechaCreacion' => '2018-02-02',
            'numFactura' => '1010000002318',
            'montoFactura' => '73137',
            'placa' => 'SM5900',  
            'presupuesto_meca_moto'=>1,
        ]); 
        //historico repuesto de motos 
        DB::table('presupuesto_historico_rep_motos')->insert([
            'fechaCreacion' => '2018-02-02',
            'numFactura' => '10100000001971',
            'montoFactura' => '108777',
            'placa' => 'SM5900',  
            'presu_rep_moto'=>1,
        ]);   
        DB::table('presupuesto_historico_rep_motos')->insert([
            'fechaCreacion' => '2018-02-02',
            'numFactura' => '1010000002282',
            'montoFactura' => '12497',
            'placa' => 'SM5900',  
            'presu_rep_moto'=>1,
        ]);   
        //historico lavado
        DB::table('presupuesto_historico_l_vs')->insert([
            'fechaCreacion' => '2018-02-02',
            'numFactura' => '1040000000189',
            'montoFactura' => '12000',
            'placa' => 'SM5900',  
            'presupuesto_lava_vehi'=>1,
        ]);  
        DB::table('presupuesto_historico_l_vs')->insert([
            'fechaCreacion' => '2018-02-02',
            'numFactura' => '1040000000197',
            'montoFactura' => '8000',
            'placa' => 'SM5900',  
            'presupuesto_lava_vehi'=>1,
        ]);  
        DB::table('presupuesto_historico_l_vs')->insert([
            'fechaCreacion' => '2018-02-02',
            'numFactura' => '1040000000310',
            'montoFactura' => '16000',
            'placa' => 'SM5900',  
            'presupuesto_lava_vehi'=>1,
        ]);  
        DB::table('presupuesto_historico_l_vs')->insert([
            'fechaCreacion' => '2018-02-02',
            'numFactura' => '1040000000310',
            'montoFactura' => '12000',
            'placa' => 'SM5900',  
            'presupuesto_lava_vehi'=>1,
        ]);  
        DB::table('presupuesto_historico_l_vs')->insert([
            'fechaCreacion' => '2018-02-02',
            'numFactura' => '1010000006324',
            'montoFactura' => '12000',
            'placa' => 'SM5900',  
            'presupuesto_lava_vehi'=>1,
        ]);   
          */

    }
}
