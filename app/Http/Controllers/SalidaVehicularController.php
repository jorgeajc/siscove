<?php

namespace App\Http\Controllers;

use App\salidaVehicular;
use App\vehiculos;
use App\departamentos; 
use App\User;
use App\control_accesorios;
use App\control_carroceria;
use App\control_km_comb;

use Illuminate\Http\Request;
use App\Http\Requests\SalidaVehicularRequest;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Session;

class SalidaVehicularController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
    }
    public function vistaInicial($placa)
    {   
        $vehiculo = vehiculos::find($placa); 
        $salidaVehicular = SalidaVehicularController::salidaVehicular($placa); 
        return view('salidaVehicular.index', compact('salidaVehicular', 'vehiculo'));
    }
    public function indexDesactivado($placa)
    {   
        $vehiculo = vehiculos::find($placa); 
        $salidaVehicular = SalidaVehicularController::salidaVehicular($placa); 
        return view('salidaVehicular.indexDesacti', compact('salidaVehicular', 'vehiculo'));
    }
    static  function salidaVehicular($placa){
        return salidaVehicular::select('salida_vehiculars.id', 'salida_vehiculars.fechaAutorizacionSalida','salida_vehiculars.fechaAutorizacionIngreso','salida_vehiculars.totalKm',
                                        'departamentos.nombreDeparta as oficinaSolicitante')
                                ->join('departamentos', 'departamentos.id', '=', 'salida_vehiculars.oficinaSolicitante')
                                ->where('placa', $placa)
                                ->get(); 
    }
    public function create($placa)
    { 
        $oficinas = Departamentos::select()->get();
        $usuarios = User::select('id', 'primerNombre', 'primerApellido', 'segundoApellido')->where('tipoUsuario', '!=', 5)->where('tipoUsuario', '!=', 6)->get(); 
        return view('salidaVehicular.create', compact('placa', 'oficinas', 'usuarios'));
    }
    public function store(Request $request)
    { 
        $validator = validator::make($request->all(),[
            'oficinaSolicitante' => ['required'],
            'fechaAutorizacionSalida' => ['required'],
            'fechaAutorizacionIngreso' => ['required'],
            'totalKm' => ['required'],
            'placa' => ['required'], 
            
        ],[
            'oficinaSolicitante.required' => 'El nombre de la :attribute es obligatoria',
            'fechaAutorizacionSalida.required' => 'La :attribute es obligatoria',
            'fechaAutorizacionIngreso.required' => 'La :attribute es obligatoria',  
            'totalKm' =>  'El :attribute es obligatorio',
            'placa' =>  'El :attribute es obligatorio',
        ],[
            'oficinaSolicitante'        => 'oficina solicitante',
            'fechaAutorizacionSalida'   => 'fecha de autorización de salida',
            'fechaAutorizacionIngreso'  => 'fecha de autorización de Ingreso', 
            'totalKm' => 'total del kilometraje',
            'placa' => 'placa',
        ]); 
        
        if($validator->passes())
        {
            //guardando registro de salida vehicular
            {
                $salidaVehicular = new salidaVehicular; 
                $salidaVehicular->oficinaSolicitante        = $request->oficinaSolicitante;
                $salidaVehicular->fechaAutorizacionSalida   = $request->fechaAutorizacionSalida;
                $salidaVehicular->fechaAutorizacionIngreso  = $request->fechaAutorizacionIngreso; 
                $salidaVehicular->totalKm                   = $request->totalKm;
                $salidaVehicular->placa                     = $request->placa; 
                $salidaVehicular->save();
            } 
            //guardando sub registro de salida vehicular en accesorios
            {
                $control_accesoriosSa = new control_accesorios;
                $control_accesoriosSa->idSalidaVehicular  = $salidaVehicular->id;
                $control_accesoriosSa->radio              = $request->accesoriosSalida['radioSalida'];
                $control_accesoriosSa->encenderdor        = $request->accesoriosSalida['encendedorSalida'];
                $control_accesoriosSa->alfombra           = $request->accesoriosSalida['alfombrasSalida'];
                $control_accesoriosSa->antena             = $request->accesoriosSalida['antenaSalida'];
                $control_accesoriosSa->espejoExterior     = $request->accesoriosSalida['espejoExtSalida'];
                $control_accesoriosSa->espejoInterior     = $request->accesoriosSalida['espejoIntSalida'];
                $control_accesoriosSa->extintor           = $request->accesoriosSalida['extintorSalida'];
                $control_accesoriosSa->gata               = $request->accesoriosSalida['gataSalida'];
                $control_accesoriosSa->llaveRana          = $request->accesoriosSalida['llaveRanaSalida'];
                $control_accesoriosSa->llaveRepuesto      = $request->accesoriosSalida['llaveRepuestoSalida'];
                $control_accesoriosSa->triangulos         = $request->accesoriosSalida['triangulosSalida'];
                $control_accesoriosSa->observaciones      = $request->accesoriosSalida['observacionesSalida'];
                $control_accesoriosSa->estado             = 'Salida';
                $control_accesoriosSa->save();
            }
            //guardando sub registro de salida vehicular en accesorios
            {
                $control_accesoriosEn = new control_accesorios;
                $control_accesoriosEn->idSalidaVehicular  = $salidaVehicular->id;
                $control_accesoriosEn->radio              = $request->accesoriosEntrada['radioEntrada'];
                $control_accesoriosEn->encenderdor        = $request->accesoriosEntrada['encendedorEntrada'];
                $control_accesoriosEn->alfombra           = $request->accesoriosEntrada['alfombrasEntrada'];
                $control_accesoriosEn->antena             = $request->accesoriosEntrada['antenaEntrada'];
                $control_accesoriosEn->espejoExterior     = $request->accesoriosEntrada['espejoExtEntrada'];
                $control_accesoriosEn->espejoInterior     = $request->accesoriosEntrada['espejoIntEntrada'];
                $control_accesoriosEn->extintor           = $request->accesoriosEntrada['extintorEntrada'];
                $control_accesoriosEn->gata               = $request->accesoriosEntrada['gataEntrada'];
                $control_accesoriosEn->llaveRana          = $request->accesoriosEntrada['llaveRanaEntrada'];
                $control_accesoriosEn->llaveRepuesto      = $request->accesoriosEntrada['llaveRepuestoEntrada'];
                $control_accesoriosEn->triangulos         = $request->accesoriosEntrada['triangulosEntrada'];
                $control_accesoriosEn->observaciones      = $request->accesoriosEntrada['observacionesSEntrada'];
                $control_accesoriosEn->estado             = 'Entrada';
               $control_accesoriosEn->save();
            }
            //guardando sub registro de salida vehicular en carroceria
            {
                $control_carroceria = new control_carroceria;
                $control_carroceria->idSalidaVehicular  = $salidaVehicular->id;
                $control_carroceria->bumperTrasero      = $request->carroceria['bumperT'];
                $control_carroceria->bumperDelantero    = $request->carroceria['bumperD'];
                $control_carroceria->guardaBarroDD      = $request->carroceria['guardaBDD'];
                $control_carroceria->guardaBarroDI      = $request->carroceria['guardaBID'];
                $control_carroceria->guardaBarroTD      = $request->carroceria['guardaBDT'];
                $control_carroceria->guardaBarroTI      = $request->carroceria['guardaBIT'];
                $control_carroceria->tapaBaul           = $request->carroceria['tapaBaul'];
                $control_carroceria->tapaMotor          = $request->carroceria['tapaMotor'];
                $control_carroceria->parabrisasTrasero  = $request->carroceria['parabrisasT'];
                $control_carroceria->parabrisasDelantero= $request->carroceria['parabrisasD'];
                $control_carroceria->puertaDD           = $request->carroceria['puertaDD'];
                $control_carroceria->puertaDI           = $request->carroceria['puertaDI'];
                $control_carroceria->puertaTD           = $request->carroceria['puertaTD'];
                $control_carroceria->puertaTI           = $request->carroceria['puertaTI'];
                $control_carroceria->quisioD            = $request->carroceria['quicioD'];
                $control_carroceria->quisioI            = $request->carroceria['quicioI'];
                $control_carroceria->techo              = $request->carroceria['techo'];
                $control_carroceria->observaciones      = $request->carroceria['observacionesCarro'];
                $control_carroceria->save();
            }
            //guardando sub registro por dias del kilometraje y combustible
            {  
                //lunes 
                if($request->dias['lunes']){
                    $conKmCombL = new control_km_comb;
                    $conKmCombL->idSalidaVehicular   = $salidaVehicular->id;
                    $conKmCombL->dia                 = 'lunes';
                    $conKmCombL->fecha               = $request->dias['lunes']['fechaSalida'];
                    $conKmCombL->horaSalida          = $request->dias['lunes']['horaSalida'];
                    $conKmCombL->horaIngreso         = $request->dias['lunes']['horaIngreso'];
                    $conKmCombL->kmSalida            = $request->dias['lunes']['kmSalida'];
                    $conKmCombL->kmIngreso           = $request->dias['lunes']['kmIngreso'];
                    $conKmCombL->combustibleSalida   = $request->dias['lunes']['combustibleSalida'];
                    $conKmCombL->combustibleIngreso  = $request->dias['lunes']['combustibleIngreso'];
                    $conKmCombL->ChoferSalida        = $request->dias['lunes']['choferSalida'];
                    $conKmCombL->ChoferIngreso       = $request->dias['lunes']['choferIngreso'];
                    $conKmCombL->GuardaSalida        = $request->dias['lunes']['guardaSalida'];  
                    $conKmCombL->GuardaIngreso       = $request->dias['lunes']['guardaIngreso']; 
                    $conKmCombL->save();
                } 
                //martes
                if($request->dias['martes']){
                    $conKmCombMA = new control_km_comb;
                    $conKmCombMA->idSalidaVehicular   = $salidaVehicular->id;
                    $conKmCombMA->dia                 = 'martes';
                    $conKmCombMA->fecha               = $request->dias['martes']['fechaSalida'];
                    $conKmCombMA->horaSalida          = $request->dias['martes']['horaSalida'];
                    $conKmCombMA->horaIngreso         = $request->dias['martes']['horaIngreso'];
                    $conKmCombMA->kmSalida            = $request->dias['martes']['kmSalida'];
                    $conKmCombMA->kmIngreso           = $request->dias['martes']['kmIngreso'];
                    $conKmCombMA->combustibleSalida   = $request->dias['martes']['combustibleSalida'];
                    $conKmCombMA->combustibleIngreso  = $request->dias['martes']['combustibleIngreso'];
                    $conKmCombMA->ChoferSalida        = $request->dias['martes']['choferSalida'];
                    $conKmCombMA->ChoferIngreso       = $request->dias['martes']['choferIngreso'];
                    $conKmCombMA->GuardaSalida        = $request->dias['martes']['guardaSalida'];  
                    $conKmCombMA->GuardaIngreso       = $request->dias['martes']['guardaIngreso']; 
                    $conKmCombMA->save();
                }  
                //miercoles 
                if($request->dias['miercoles']){
                    $conKmCombMI = new control_km_comb;
                    $conKmCombMI->idSalidaVehicular   = $salidaVehicular->id;
                    $conKmCombMI->dia                 = 'miercoles';
                    $conKmCombMI->fecha               = $request->dias['miercoles']['fechaSalida'];
                    $conKmCombMI->horaSalida          = $request->dias['miercoles']['horaSalida'];
                    $conKmCombMI->horaIngreso         = $request->dias['miercoles']['horaIngreso'];
                    $conKmCombMI->kmSalida            = $request->dias['miercoles']['kmSalida'];
                    $conKmCombMI->kmIngreso           = $request->dias['miercoles']['kmIngreso'];
                    $conKmCombMI->combustibleSalida   = $request->dias['miercoles']['combustibleSalida'];
                    $conKmCombMI->combustibleIngreso  = $request->dias['miercoles']['combustibleIngreso'];
                    $conKmCombMI->ChoferSalida        = $request->dias['miercoles']['choferSalida'];
                    $conKmCombMI->ChoferIngreso       = $request->dias['miercoles']['choferIngreso'];
                    $conKmCombMI->GuardaSalida        = $request->dias['miercoles']['guardaSalida'];  
                    $conKmCombMI->GuardaIngreso       = $request->dias['miercoles']['guardaIngreso']; 
                    $conKmCombMI->save();
                } 
                //jueves 
                if($request->dias['jueves']){
                    $conKmCombJ = new control_km_comb;
                    $conKmCombJ->idSalidaVehicular   = $salidaVehicular->id;
                    $conKmCombJ->dia                 = 'jueves';
                    $conKmCombJ->fecha               = $request->dias['jueves']['fechaSalida'];
                    $conKmCombJ->horaSalida          = $request->dias['jueves']['horaSalida'];
                    $conKmCombJ->horaIngreso         = $request->dias['jueves']['horaIngreso'];
                    $conKmCombJ->kmSalida            = $request->dias['jueves']['kmSalida'];
                    $conKmCombJ->kmIngreso           = $request->dias['jueves']['kmIngreso'];
                    $conKmCombJ->combustibleSalida   = $request->dias['jueves']['combustibleSalida'];
                    $conKmCombJ->combustibleIngreso  = $request->dias['jueves']['combustibleIngreso'];
                    $conKmCombJ->ChoferSalida        = $request->dias['jueves']['choferSalida'];
                    $conKmCombJ->ChoferIngreso       = $request->dias['jueves']['choferIngreso'];
                    $conKmCombJ->GuardaSalida        = $request->dias['jueves']['guardaSalida'];  
                    $conKmCombJ->GuardaIngreso       = $request->dias['jueves']['guardaIngreso']; 
                    $conKmCombJ->save();
                } 
                //viernes 
                if($request->dias['viernes']){
                    $conKmCombV = new control_km_comb;
                    $conKmCombV->idSalidaVehicular   = $salidaVehicular->id;
                    $conKmCombV->dia                 = 'viernes';
                    $conKmCombV->fecha               = $request->dias['viernes']['fechaSalida'];
                    $conKmCombV->horaSalida          = $request->dias['viernes']['horaSalida'];
                    $conKmCombV->horaIngreso         = $request->dias['viernes']['horaIngreso'];
                    $conKmCombV->kmSalida            = $request->dias['viernes']['kmSalida'];
                    $conKmCombV->kmIngreso           = $request->dias['viernes']['kmIngreso'];
                    $conKmCombV->combustibleSalida   = $request->dias['viernes']['combustibleSalida'];
                    $conKmCombV->combustibleIngreso  = $request->dias['viernes']['combustibleIngreso'];
                    $conKmCombV->ChoferSalida        = $request->dias['viernes']['choferSalida'];
                    $conKmCombV->ChoferIngreso       = $request->dias['viernes']['choferIngreso'];
                    $conKmCombV->GuardaSalida        = $request->dias['viernes']['guardaSalida'];  
                    $conKmCombV->GuardaIngreso       = $request->dias['viernes']['guardaIngreso']; 
                    $conKmCombV->save();
                } 
                //sabado 
                if($request->dias['sabado']){
                    $conKmCombS = new control_km_comb;
                    $conKmCombS->idSalidaVehicular   = $salidaVehicular->id;
                    $conKmCombS->dia                 = 'sabado';
                    $conKmCombS->fecha               = $request->dias['sabado']['fechaSalida'];
                    $conKmCombS->horaSalida          = $request->dias['sabado']['horaSalida'];
                    $conKmCombS->horaIngreso         = $request->dias['sabado']['horaIngreso'];
                    $conKmCombS->kmSalida            = $request->dias['sabado']['kmSalida'];
                    $conKmCombS->kmIngreso           = $request->dias['sabado']['kmIngreso'];
                    $conKmCombS->combustibleSalida   = $request->dias['sabado']['combustibleSalida'];
                    $conKmCombS->combustibleIngreso  = $request->dias['sabado']['combustibleIngreso'];
                    $conKmCombS->ChoferSalida        = $request->dias['sabado']['choferSalida'];
                    $conKmCombS->ChoferIngreso       = $request->dias['sabado']['choferIngreso'];
                    $conKmCombS->GuardaSalida        = $request->dias['sabado']['guardaSalida'];  
                    $conKmCombS->GuardaIngreso       = $request->dias['sabado']['guardaIngreso']; 
                    $conKmCombS->save();
                } 
                //domingo 
                if($request->dias['domingo']){
                    $conKmCombD = new control_km_comb;
                    $conKmCombD->idSalidaVehicular   = $salidaVehicular->id;
                    $conKmCombD->dia                 = 'domingo';
                    $conKmCombD->fecha               = $request->dias['domingo']['fechaSalida'];
                    $conKmCombD->horaSalida          = $request->dias['domingo']['horaSalida'];
                    $conKmCombD->horaIngreso         = $request->dias['domingo']['horaIngreso'];
                    $conKmCombD->kmSalida            = $request->dias['domingo']['kmSalida'];
                    $conKmCombD->kmIngreso           = $request->dias['domingo']['kmIngreso'];
                    $conKmCombD->combustibleSalida   = $request->dias['domingo']['combustibleSalida'];
                    $conKmCombD->combustibleIngreso  = $request->dias['domingo']['combustibleIngreso'];
                    $conKmCombD->ChoferSalida        = $request->dias['domingo']['choferSalida'];
                    $conKmCombD->ChoferIngreso       = $request->dias['domingo']['choferIngreso'];
                    $conKmCombD->GuardaSalida        = $request->dias['domingo']['guardaSalida'];  
                    $conKmCombD->GuardaIngreso       = $request->dias['domingo']['guardaIngreso']; 
                    $conKmCombD->save();
                } 
            }
            return response()->json(['success'=>'Registro Agregado Correctamente']); 
        }
        else{
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
    } 
    public function show($id, $placa)
    {
        //consulta de los usuario
        $usuarios = User::select('id', 'primerNombre', 'primerApellido', 'segundoApellido')->where('tipoUsuario', '!=', 5)->where('tipoUsuario', '!=', 6)->get(); 

        //consulta de salidar vehicular unido con departamento y carrocería
        $resConSVCD = \DB::table('salida_vehiculars as s')
                        ->select('s.id', 's.fechaAutorizacionSalida','s.fechaAutorizacionIngreso','s.totalKm',
                                'dep.nombreDeparta as oficinaSolicitante',
                                'cc.id as idcc', 'cc.idSalidaVehicular as idSalidaVehicularCC', 'cc.bumperTrasero', 'cc.bumperDelantero', 'cc.guardaBarroDD', 'cc.guardaBarroDI', 'cc.guardaBarroTD', 'cc.guardaBarroTI', 'cc.tapaBaul', 'cc.tapaMotor', 'cc.parabrisasTrasero', 'cc.parabrisasDelantero', 'cc.puertaDD', 'cc.puertaDI', 'cc.puertaTD', 'cc.puertaTI', 'cc.quisioD', 'cc.quisioI', 'cc.techo', 'cc.observaciones')
                        ->join('departamentos as dep', 'dep.id', '=', 's.oficinaSolicitante')
                        ->join('control_carrocerias as cc', 'cc.idSalidaVehicular', '=', 's.id')
                        ->where('s.id', $id) 
                        ->get(); 
        $salVehiCarrPrinc = $resConSVCD[0];  
    
        //consulta salida vehicular unido con accesorios
        $resConSVA = \DB::table('salida_vehiculars as s')
                        ->select('ca.id as idca', 'ca.idSalidaVehicular as idSalidaVehicularCA', 'ca.radio', 'ca.encenderdor', 'ca.alfombra', 'ca.antena', 'ca.espejoExterior', 'ca.espejoInterior', 'ca.extintor', 'ca.gata', 'ca.llaveRana', 'ca.llaveRepuesto', 'ca.triangulos', 'ca.observaciones as observacionesCA', 'ca.estado')
                        ->join('control_accesorios as ca', 'ca.idSalidaVehicular', '=', 's.id') 
                        ->where('s.id', $id) 
                        ->get();  
        $salVeAcce = $resConSVA[0];
        $entVeAcce = $resConSVA[1]; 

        //consulta salida vehicular unida con kilometraje y combustible
        $resConSVKC = \DB::table('salida_vehiculars as s')
                        ->select('kc.id', 'kc.idSalidaVehicular', 'kc.dia', 'kc.fecha', 'kc.horaSalida', 'kc.horaIngreso', 'kc.kmSalida', 'kc.kmIngreso', 'kc.combustibleSalida', 'kc.combustibleIngreso', 'kc.choferSalida', 'kc.choferIngreso', 'kc.guardaSalida', 'kc.guardaIngreso')
                        ->join('control_km_combs as kc', 'kc.idSalidaVehicular', 's.id')
                        ->where('s.id', $id)
                        ->get()
                        ->all(); 
        //dd($resConSVKC);      
        $indices=[
                    'lunes' => array_search('lunes', array_column($resConSVKC, 'dia')), 
                    'martes' => array_search('martes', array_column($resConSVKC, 'dia')), 
                    'miercoles' => array_search('miercoles', array_column($resConSVKC, 'dia')), 
                    'jueves' => array_search('jueves', array_column($resConSVKC, 'dia')), 
                    'viernes' => array_search('viernes', array_column($resConSVKC, 'dia')), 
                    'sabado' => array_search('sabado', array_column($resConSVKC, 'dia')), 
                    'domingo' => array_search('domingo', array_column($resConSVKC, 'dia')), 
                ];   
        return view('salidaVehicular.show', compact('salVehiCarrPrinc', 'salVeAcce', 'entVeAcce', 'resConSVKC', 'indices', 'usuarios', 'placa'));
    } 
    public function showDesactivado($id, $placa)
    {
        //consulta de los usuario
        $usuarios = User::select('id', 'primerNombre', 'primerApellido', 'segundoApellido')->where('tipoUsuario', '!=', 5)->where('tipoUsuario', '!=', 6)->get(); 

        //consulta de salidar vehicular unido con departamento y carrocería
        $resConSVCD = \DB::table('salida_vehiculars as s')
                        ->select('s.id', 's.fechaAutorizacionSalida','s.fechaAutorizacionIngreso','s.totalKm',
                                'dep.nombreDeparta as oficinaSolicitante',
                                'cc.id as idcc', 'cc.idSalidaVehicular as idSalidaVehicularCC', 'cc.bumperTrasero', 'cc.bumperDelantero', 'cc.guardaBarroDD', 'cc.guardaBarroDI', 'cc.guardaBarroTD', 'cc.guardaBarroTI', 'cc.tapaBaul', 'cc.tapaMotor', 'cc.parabrisasTrasero', 'cc.parabrisasDelantero', 'cc.puertaDD', 'cc.puertaDI', 'cc.puertaTD', 'cc.puertaTI', 'cc.quisioD', 'cc.quisioI', 'cc.techo', 'cc.observaciones')
                        ->join('departamentos as dep', 'dep.id', '=', 's.oficinaSolicitante')
                        ->join('control_carrocerias as cc', 'cc.idSalidaVehicular', '=', 's.id')
                        ->where('s.id', $id) 
                        ->get(); 
        $salVehiCarrPrinc = $resConSVCD[0];  
    
        //consulta salida vehicular unido con accesorios
        $resConSVA = \DB::table('salida_vehiculars as s')
                        ->select('ca.id as idca', 'ca.idSalidaVehicular as idSalidaVehicularCA', 'ca.radio', 'ca.encenderdor', 'ca.alfombra', 'ca.antena', 'ca.espejoExterior', 'ca.espejoInterior', 'ca.extintor', 'ca.gata', 'ca.llaveRana', 'ca.llaveRepuesto', 'ca.triangulos', 'ca.observaciones as observacionesCA', 'ca.estado')
                        ->join('control_accesorios as ca', 'ca.idSalidaVehicular', '=', 's.id') 
                        ->where('s.id', $id) 
                        ->get();  
        $salVeAcce = $resConSVA[0];
        $entVeAcce = $resConSVA[1]; 

        //consulta salida vehicular unida con kilometraje y combustible
        $resConSVKC = \DB::table('salida_vehiculars as s')
                        ->select('kc.id', 'kc.idSalidaVehicular', 'kc.dia', 'kc.fecha', 'kc.horaSalida', 'kc.horaIngreso', 'kc.kmSalida', 'kc.kmIngreso', 'kc.combustibleSalida', 'kc.combustibleIngreso', 'kc.choferSalida', 'kc.choferIngreso', 'kc.guardaSalida', 'kc.guardaIngreso')
                        ->join('control_km_combs as kc', 'kc.idSalidaVehicular', 's.id')
                        ->where('s.id', $id)
                        ->get()
                        ->all(); 
        //dd($resConSVKC);      
        $indices=[
                    'lunes' => array_search('lunes', array_column($resConSVKC, 'dia')), 
                    'martes' => array_search('martes', array_column($resConSVKC, 'dia')), 
                    'miercoles' => array_search('miercoles', array_column($resConSVKC, 'dia')), 
                    'jueves' => array_search('jueves', array_column($resConSVKC, 'dia')), 
                    'viernes' => array_search('viernes', array_column($resConSVKC, 'dia')), 
                    'sabado' => array_search('sabado', array_column($resConSVKC, 'dia')), 
                    'domingo' => array_search('domingo', array_column($resConSVKC, 'dia')), 
                ];   
        return view('salidaVehicular.showDesacti', compact('salVehiCarrPrinc', 'salVeAcce', 'entVeAcce', 'resConSVKC', 'indices', 'usuarios', 'placa'));
    } 
    public function edit($id, $placa)
    {
        //consulta de los departamentos
        $oficinas = Departamentos::select()->get();

        //consulta de los usuario
        $usuarios = User::select('id', 'primerNombre', 'primerApellido', 'segundoApellido')->where('tipoUsuario', '!=', 5)->where('tipoUsuario', '!=', 6)->get(); 
       
        //consulta de salidar vehicular unido con departamento y carrocería
        $resConSVCD = \DB::table('salida_vehiculars as s')
                        ->select('s.id', 's.fechaAutorizacionSalida','s.fechaAutorizacionIngreso','s.totalKm',
                                'dep.id as idDepartamento', 'dep.nombreDeparta as oficinaSolicitante',
                                'cc.id as idcc', 'cc.idSalidaVehicular as idSalidaVehicularCC', 'cc.bumperTrasero', 'cc.bumperDelantero', 'cc.guardaBarroDD', 'cc.guardaBarroDI', 'cc.guardaBarroTD', 'cc.guardaBarroTI', 'cc.tapaBaul', 'cc.tapaMotor', 'cc.parabrisasTrasero', 'cc.parabrisasDelantero', 'cc.puertaDD', 'cc.puertaDI', 'cc.puertaTD', 'cc.puertaTI', 'cc.quisioD', 'cc.quisioI', 'cc.techo', 'cc.observaciones')
                        ->join('departamentos as dep', 'dep.id', '=', 's.oficinaSolicitante')
                        ->join('control_carrocerias as cc', 'cc.idSalidaVehicular', '=', 's.id')
                        ->where('s.id', $id) 
                        ->get(); 
        $salVehiCarrPrinc = $resConSVCD[0]; 
       
         //consulta salida vehicular unido con accesorios
        $resConSVA = \DB::table('salida_vehiculars as s')
                        ->select('ca.id as idca', 'ca.idSalidaVehicular as idSalidaVehicularCA', 'ca.radio', 'ca.encenderdor', 'ca.alfombra', 'ca.antena', 'ca.espejoExterior', 'ca.espejoInterior', 'ca.extintor', 'ca.gata', 'ca.llaveRana', 'ca.llaveRepuesto', 'ca.triangulos', 'ca.observaciones as observacionesCA', 'ca.estado')
                        ->join('control_accesorios as ca', 'ca.idSalidaVehicular', '=', 's.id') 
                        ->where('s.id', $id) 
                        ->get();  
        $salVeAcce = $resConSVA[0];
        $entVeAcce = $resConSVA[1]; 
         
        //consulta salida vehicular unida con kilometraje y combustible
        $resConSVKC = \DB::table('salida_vehiculars as s')
                        ->select('kc.id', 'kc.idSalidaVehicular', 'kc.dia', 'kc.fecha', 'kc.horaSalida', 'kc.horaIngreso', 'kc.kmSalida', 'kc.kmIngreso', 'kc.combustibleSalida', 'kc.combustibleIngreso', 'kc.choferSalida', 'kc.choferIngreso', 'kc.guardaSalida', 'kc.guardaIngreso')
                        ->join('control_km_combs as kc', 'kc.idSalidaVehicular', 's.id')
                        ->where('s.id', $id)
                        ->get()
                        ->all(); 
        $indices=[
                    'lunes' => array_search('lunes', array_column($resConSVKC, 'dia')), 
                    'martes' => array_search('martes', array_column($resConSVKC, 'dia')), 
                    'miercoles' => array_search('miercoles', array_column($resConSVKC, 'dia')), 
                    'jueves' => array_search('jueves', array_column($resConSVKC, 'dia')), 
                    'viernes' => array_search('viernes', array_column($resConSVKC, 'dia')), 
                    'sabado' => array_search('sabado', array_column($resConSVKC, 'dia')), 
                    'domingo' => array_search('domingo', array_column($resConSVKC, 'dia')), 
        ];    
        //dd($indices);
        return view('salidaVehicular.edit', compact('salVehiCarrPrinc', 'salVeAcce', 'entVeAcce', 'resConSVKC', 'indices', 'oficinas', 'usuarios', 'placa'));
    } 
    public function update(Request $request, $id)
    {
        $validator = validator::make($request->all(),[
            'oficinaSolicitante' => ['required'],
            'fechaAutorizacionSalida' => ['required'],
            'fechaAutorizacionIngreso' => ['required'],
            'totalKm' => ['required'],
            'placa' => ['required'], 
            
        ],[
            'oficinaSolicitante.required' => 'El nombre de la :attribute es obligatoria',
            'fechaAutorizacionSalida.required' => 'La :attribute es obligatoria',
            'fechaAutorizacionIngreso.required' => 'La :attribute es obligatoria',  
            'totalKm' =>  'El :attribute es obligatorio',
            'placa' =>  'El :attribute es obligatorio',
        ],[
            'oficinaSolicitante'        => 'oficina solicitante',
            'fechaAutorizacionSalida'   => 'fecha de autorización de salida',
            'fechaAutorizacionIngreso'  => 'fecha de autorización de Ingreso', 
            'totalKm' => 'total del kilometraje',
            'placa' => 'placa',
        ]); 

        if($validator->passes())
        { 
            //guardando registro de salida vehicular
            {
                $salidaVehicular = salidaVehicular::find($id);  
                $salidaVehicular->oficinaSolicitante        = $request->oficinaSolicitante;
                $salidaVehicular->fechaAutorizacionSalida   = $request->fechaAutorizacionSalida;
                $salidaVehicular->fechaAutorizacionIngreso  = $request->fechaAutorizacionIngreso; 
                $salidaVehicular->totalKm                   = $request->totalKm;
                $salidaVehicular->placa                     = $request->placa; 
                $salidaVehicular->save();
            } 
            //actualizando sub registro por dias del kilometraje y combustible
            {  
                //lunes 
                if($request->dias['lunes']){  
                    $request->dias['lunes']['id'] != null ? $conKmCombL = control_km_comb::find($request->dias['lunes']['id']) : $conKmCombL = new control_km_comb;
                   
                    $conKmCombL->idSalidaVehicular   = $salidaVehicular->id;
                    $conKmCombL->dia                 = 'lunes';
                    $conKmCombL->fecha               = $request->dias['lunes']['fechaSalida'];
                    $conKmCombL->horaSalida          = $request->dias['lunes']['horaSalida'];
                    $conKmCombL->horaIngreso         = $request->dias['lunes']['horaIngreso'];
                    $conKmCombL->kmSalida            = $request->dias['lunes']['kmSalida'];
                    $conKmCombL->kmIngreso           = $request->dias['lunes']['kmIngreso'];
                    $conKmCombL->combustibleSalida   = $request->dias['lunes']['combustibleSalida'];
                    $conKmCombL->combustibleIngreso  = $request->dias['lunes']['combustibleIngreso'];
                    $conKmCombL->ChoferSalida        = $request->dias['lunes']['choferSalida'];
                    $conKmCombL->ChoferIngreso       = $request->dias['lunes']['choferIngreso'];
                    $conKmCombL->GuardaSalida        = $request->dias['lunes']['guardaSalida'];  
                    $conKmCombL->GuardaIngreso       = $request->dias['lunes']['guardaIngreso']; 
                    $conKmCombL->save();
                } 
                //martes
                if($request->dias['martes']){ 
                   
                    $request->dias['martes']['id'] != null ? $conKmCombMA = control_km_comb::find($request->dias['martes']['id']) : $conKmCombMA = new control_km_comb;
                    //dd( $request->dias['martes']);
                    $conKmCombMA->idSalidaVehicular   = $salidaVehicular->id;
                    $conKmCombMA->dia                 = 'martes';
                    $conKmCombMA->fecha               = $request->dias['martes']['fechaSalida'];
                    $conKmCombMA->horaSalida          = $request->dias['martes']['horaSalida'];
                    $conKmCombMA->horaIngreso         = $request->dias['martes']['horaIngreso'];
                    $conKmCombMA->kmSalida            = $request->dias['martes']['kmSalida'];
                    $conKmCombMA->kmIngreso           = $request->dias['martes']['kmIngreso'];
                    $conKmCombMA->combustibleSalida   = $request->dias['martes']['combustibleSalida'];
                    $conKmCombMA->combustibleIngreso  = $request->dias['martes']['combustibleIngreso'];
                    $conKmCombMA->ChoferSalida        = $request->dias['martes']['choferSalida'];
                    $conKmCombMA->ChoferIngreso       = $request->dias['martes']['choferIngreso'];
                    $conKmCombMA->GuardaSalida        = $request->dias['martes']['guardaSalida'];  
                    $conKmCombMA->GuardaIngreso       = $request->dias['martes']['guardaIngreso']; 
                    $conKmCombMA->save();
                }  
                //miercoles 
                if($request->dias['miercoles']){ 
                    $request->dias['miercoles']['id'] != null ? $conKmCombMI = control_km_comb::find($request->dias['miercoles']['id']) : $conKmCombMI = new control_km_comb;
                    $conKmCombMI->idSalidaVehicular   = $salidaVehicular->id;
                    $conKmCombMI->dia                 = 'miercoles';
                    $conKmCombMI->fecha               = $request->dias['miercoles']['fechaSalida'];
                    $conKmCombMI->horaSalida          = $request->dias['miercoles']['horaSalida'];
                    $conKmCombMI->horaIngreso         = $request->dias['miercoles']['horaIngreso'];
                    $conKmCombMI->kmSalida            = $request->dias['miercoles']['kmSalida'];
                    $conKmCombMI->kmIngreso           = $request->dias['miercoles']['kmIngreso'];
                    $conKmCombMI->combustibleSalida   = $request->dias['miercoles']['combustibleSalida'];
                    $conKmCombMI->combustibleIngreso  = $request->dias['miercoles']['combustibleIngreso'];
                    $conKmCombMI->ChoferSalida        = $request->dias['miercoles']['choferSalida'];
                    $conKmCombMI->ChoferIngreso       = $request->dias['miercoles']['choferIngreso'];
                    $conKmCombMI->GuardaSalida        = $request->dias['miercoles']['guardaSalida'];  
                    $conKmCombMI->GuardaIngreso       = $request->dias['miercoles']['guardaIngreso']; 
                    $conKmCombMI->save();
                } 
                //jueves 
                if($request->dias['jueves']){ 
                    $request->dias['jueves']['id'] != null ? $conKmCombJ = control_km_comb::find($request->dias['jueves']['id']) : $conKmCombJ = new control_km_comb;
                    $conKmCombJ->idSalidaVehicular   = $salidaVehicular->id;
                    $conKmCombJ->dia                 = 'jueves';
                    $conKmCombJ->fecha               = $request->dias['jueves']['fechaSalida'];
                    $conKmCombJ->horaSalida          = $request->dias['jueves']['horaSalida'];
                    $conKmCombJ->horaIngreso         = $request->dias['jueves']['horaIngreso'];
                    $conKmCombJ->kmSalida            = $request->dias['jueves']['kmSalida'];
                    $conKmCombJ->kmIngreso           = $request->dias['jueves']['kmIngreso'];
                    $conKmCombJ->combustibleSalida   = $request->dias['jueves']['combustibleSalida'];
                    $conKmCombJ->combustibleIngreso  = $request->dias['jueves']['combustibleIngreso'];
                    $conKmCombJ->ChoferSalida        = $request->dias['jueves']['choferSalida'];
                    $conKmCombJ->ChoferIngreso       = $request->dias['jueves']['choferIngreso'];
                    $conKmCombJ->GuardaSalida        = $request->dias['jueves']['guardaSalida'];  
                    $conKmCombJ->GuardaIngreso       = $request->dias['jueves']['guardaIngreso']; 
                    $conKmCombJ->save();
                } 
                //viernes 
                if($request->dias['viernes']){ 
                    $request->dias['viernes']['id'] != null ? $conKmCombV = control_km_comb::find($request->dias['viernes']['id']) : $conKmCombV = new control_km_comb;  
                    $conKmCombV->idSalidaVehicular   = $salidaVehicular->id;
                    $conKmCombV->dia                 = 'viernes';
                    $conKmCombV->fecha               = $request->dias['viernes']['fechaSalida'];
                    $conKmCombV->horaSalida          = $request->dias['viernes']['horaSalida'];
                    $conKmCombV->horaIngreso         = $request->dias['viernes']['horaIngreso'];
                    $conKmCombV->kmSalida            = $request->dias['viernes']['kmSalida'];
                    $conKmCombV->kmIngreso           = $request->dias['viernes']['kmIngreso'];
                    $conKmCombV->combustibleSalida   = $request->dias['viernes']['combustibleSalida'];
                    $conKmCombV->combustibleIngreso  = $request->dias['viernes']['combustibleIngreso'];
                    $conKmCombV->ChoferSalida        = $request->dias['viernes']['choferSalida'];
                    $conKmCombV->ChoferIngreso       = $request->dias['viernes']['choferIngreso'];
                    $conKmCombV->GuardaSalida        = $request->dias['viernes']['guardaSalida'];  
                    $conKmCombV->GuardaIngreso       = $request->dias['viernes']['guardaIngreso'];  
                    $conKmCombV->save();
                } 
                //sabado 
                if($request->dias['sabado']){ 
                    $request->dias['sabado']['id'] != null ? $conKmCombS = control_km_comb::find($request->dias['sabado']['id']) : $conKmCombS = new control_km_comb; 
                    $conKmCombS->idSalidaVehicular   = $salidaVehicular->id;
                    $conKmCombS->dia                 = 'sabado';
                    $conKmCombS->fecha               = $request->dias['sabado']['fechaSalida'];
                    $conKmCombS->horaSalida          = $request->dias['sabado']['horaSalida'];
                    $conKmCombS->horaIngreso         = $request->dias['sabado']['horaIngreso'];
                    $conKmCombS->kmSalida            = $request->dias['sabado']['kmSalida'];
                    $conKmCombS->kmIngreso           = $request->dias['sabado']['kmIngreso'];
                    $conKmCombS->combustibleSalida   = $request->dias['sabado']['combustibleSalida'];
                    $conKmCombS->combustibleIngreso  = $request->dias['sabado']['combustibleIngreso'];
                    $conKmCombS->ChoferSalida        = $request->dias['sabado']['choferSalida'];
                    $conKmCombS->ChoferIngreso       = $request->dias['sabado']['choferIngreso'];
                    $conKmCombS->GuardaSalida        = $request->dias['sabado']['guardaSalida'];  
                    $conKmCombS->GuardaIngreso       = $request->dias['sabado']['guardaIngreso']; 
                    $conKmCombS->save();
                } 
                //domingo 
                if($request->dias['domingo']){ 
                    $request->dias['domingo']['id'] != null ? $conKmCombD = control_km_comb::find($request->dias['domingo']['id']) : $conKmCombD = new control_km_comb;
                    $conKmCombD->idSalidaVehicular   = $salidaVehicular->id;
                    $conKmCombD->dia                 = 'domingo';
                    $conKmCombD->fecha               = $request->dias['domingo']['fechaSalida'];
                    $conKmCombD->horaSalida          = $request->dias['domingo']['horaSalida'];
                    $conKmCombD->horaIngreso         = $request->dias['domingo']['horaIngreso'];
                    $conKmCombD->kmSalida            = $request->dias['domingo']['kmSalida'];
                    $conKmCombD->kmIngreso           = $request->dias['domingo']['kmIngreso'];
                    $conKmCombD->combustibleSalida   = $request->dias['domingo']['combustibleSalida'];
                    $conKmCombD->combustibleIngreso  = $request->dias['domingo']['combustibleIngreso'];
                    $conKmCombD->ChoferSalida        = $request->dias['domingo']['choferSalida'];
                    $conKmCombD->ChoferIngreso       = $request->dias['domingo']['choferIngreso'];
                    $conKmCombD->GuardaSalida        = $request->dias['domingo']['guardaSalida'];  
                    $conKmCombD->GuardaIngreso       = $request->dias['domingo']['guardaIngreso']; 
                    $conKmCombD->save();
                } 
                
            }
            //guardando sub registro de salida vehicular en accesorios
            { 
                $control_accesoriosSa = control_accesorios::find($request->accesoriosSalida['id']);  
                $control_accesoriosSa->radio              = $request->accesoriosSalida['radioSalida'];
                $control_accesoriosSa->encenderdor        = $request->accesoriosSalida['encendedorSalida'];
                $control_accesoriosSa->alfombra           = $request->accesoriosSalida['alfombrasSalida'];
                $control_accesoriosSa->antena             = $request->accesoriosSalida['antenaSalida'];
                $control_accesoriosSa->espejoExterior     = $request->accesoriosSalida['espejoExtSalida'];
                $control_accesoriosSa->espejoInterior     = $request->accesoriosSalida['espejoIntSalida'];
                $control_accesoriosSa->extintor           = $request->accesoriosSalida['extintorSalida'];
                $control_accesoriosSa->gata               = $request->accesoriosSalida['gataSalida'];
                $control_accesoriosSa->llaveRana          = $request->accesoriosSalida['llaveRanaSalida'];
                $control_accesoriosSa->llaveRepuesto      = $request->accesoriosSalida['llaveRepuestoSalida'];
                $control_accesoriosSa->triangulos         = $request->accesoriosSalida['triangulosSalida'];
                $control_accesoriosSa->observaciones      = $request->accesoriosSalida['observacionesSalida']; 
                $control_accesoriosSa->save();
            }
            //guardando sub registro de salida vehicular en accesorios
            {
                $control_accesoriosEn = control_accesorios::find($request->accesoriosEntrada['id']);
                $control_accesoriosEn->idSalidaVehicular  = $salidaVehicular->id;
                $control_accesoriosEn->radio              = $request->accesoriosEntrada['radioEntrada'];
                $control_accesoriosEn->encenderdor        = $request->accesoriosEntrada['encendedorEntrada'];
                $control_accesoriosEn->alfombra           = $request->accesoriosEntrada['alfombrasEntrada'];
                $control_accesoriosEn->antena             = $request->accesoriosEntrada['antenaEntrada'];
                $control_accesoriosEn->espejoExterior     = $request->accesoriosEntrada['espejoExtEntrada'];
                $control_accesoriosEn->espejoInterior     = $request->accesoriosEntrada['espejoIntEntrada'];
                $control_accesoriosEn->extintor           = $request->accesoriosEntrada['extintorEntrada'];
                $control_accesoriosEn->gata               = $request->accesoriosEntrada['gataEntrada'];
                $control_accesoriosEn->llaveRana          = $request->accesoriosEntrada['llaveRanaEntrada'];
                $control_accesoriosEn->llaveRepuesto      = $request->accesoriosEntrada['llaveRepuestoEntrada'];
                $control_accesoriosEn->triangulos         = $request->accesoriosEntrada['triangulosEntrada'];
                $control_accesoriosEn->observaciones      = $request->accesoriosEntrada['observacionesSEntrada'];
                $control_accesoriosEn->estado             = 'Entrada';
               $control_accesoriosEn->save();
            }
            //guardando sub registro de salida vehicular en carroceria
            {
                $control_carroceria = control_carroceria::find($request->carroceria['id']);
                $control_carroceria->idSalidaVehicular  = $salidaVehicular->id;
                $control_carroceria->bumperTrasero      = $request->carroceria['bumperT'];
                $control_carroceria->bumperDelantero    = $request->carroceria['bumperD'];
                $control_carroceria->guardaBarroDD      = $request->carroceria['guardaBDD'];
                $control_carroceria->guardaBarroDI      = $request->carroceria['guardaBID'];
                $control_carroceria->guardaBarroTD      = $request->carroceria['guardaBDT'];
                $control_carroceria->guardaBarroTI      = $request->carroceria['guardaBIT'];
                $control_carroceria->tapaBaul           = $request->carroceria['tapaBaul'];
                $control_carroceria->tapaMotor          = $request->carroceria['tapaMotor'];
                $control_carroceria->parabrisasTrasero  = $request->carroceria['parabrisasT'];
                $control_carroceria->parabrisasDelantero= $request->carroceria['parabrisasD'];
                $control_carroceria->puertaDD           = $request->carroceria['puertaDD'];
                $control_carroceria->puertaDI           = $request->carroceria['puertaDI'];
                $control_carroceria->puertaTD           = $request->carroceria['puertaTD'];
                $control_carroceria->puertaTI           = $request->carroceria['puertaTI'];
                $control_carroceria->quisioD            = $request->carroceria['quicioD'];
                $control_carroceria->quisioI            = $request->carroceria['quicioI'];
                $control_carroceria->techo              = $request->carroceria['techo'];
                $control_carroceria->observaciones      = $request->carroceria['observacionesCarro'];
                $control_carroceria->save();
            }
            return response()->json(['success'=>'Registro Agregado Correctamente']); 
        }
        else{
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
    } 
    public function destroy($id)
    {
        $eliminacionSV = salidaVehicular::find($id); 
        $eliminacionSV->delete();
        return response()->json(['success'=>'Registro eliminado con éxito']);
    }
}
