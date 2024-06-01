<?php

namespace App\Http\Controllers;

use App\vehiculos;
use App\mantenimientoVehicular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VehiculosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
    }
    public function index()
    {   
        $vehiculos  =   $this->consultaIndex("Activo", "Reservado");
        $carros     =   $vehiculos->where('tipo','carro')->count();   
        $motos      =   $vehiculos->where('tipo','moto')->count();  
        return view('vehiculos.index',compact("motos", "carros", 'vehiculos')); 
    }
    public function vistaDesactivados()
    { 
        $vehiculos  =   $this->consultaIndex("Inactivo", "");
        $carros     =   $vehiculos->where('tipo','carro')->count();   
        $motos      =   $vehiculos->where('tipo','moto')->count();  
        return view('vehiculos.vistaDesactivados',compact("motos", "carros", 'vehiculos'));
    }  
    public function consultaIndex($estado, $estado2){
        return  DB::table('vehiculos as v')
                    ->select('v.placa', 'v.marca', 'v.modelo', 'v.cantidadAsientos', 'v.estado', 'v.riteve', 'v.marchamo', 'v.tipo',
                            Db::raw('(select IFNULL(count(mantenimiento_vehiculars.placa), 0)
                                            FROM mantenimiento_vehiculars 
                                            WHERE v.placa = mantenimiento_vehiculars.placa) as count'),
                            Db::raw('(select IFNULL(sum(phc.cantLitros), 0)
                                            from presupuesto_historico_cs as phc
                                            where phc.placa = v.placa) as cantGas')
                    )
                    ->leftjoin('mantenimiento_vehiculars as mv', 'v.placa','mv.placa')
                    ->leftjoin('presupuesto_historico_cs as phc', 'v.placa', 'phc.placa')
                 //   ->where('v.tipo',$tipo)
                    ->where(function($query) use ($estado, $estado2){
                        return $query->where('v.estado',$estado)
                            ->orwhere('v.estado',$estado2);
                    }) 
                   // ->groupBy('v.placa', 'v.marca', 'v.modelo', 'v.cantidadAsientos', 'v.estado', 'v.riteve', 'v.marchamo')
                    ->get(); 
    }
    public function desactivar($placa){
        $vehiculo = vehiculos::where('placa','=',$placa)->firstOrFail(); 
        $vehiculo->estado = "Inactivo";
        $vehiculo->save();
        return response()->json(['success'=>'Added new records.']); 
    }
    public function activar($placa){
        $vehiculo = vehiculos::where('placa','=',$placa)->firstOrFail(); 
        $vehiculo->estado = "Activo";
        $vehiculo->save();
        return response()->json(['success'=>'Added new records.']); 
    }
    public function create()
    {
        return view('vehiculos.create');
    } 
    public function store(Request $request)
    {      
        $validator = Validator::make($request->all(), [
            'placa'             => ['required', 'max:15', 'unique:vehiculos'],
            'marca'             => ['required', 'max:50', 'regex:(^[\pL\s\-]+$)'],
            'modelo'            => ['required', 'max:50'],
            'cantidadAsientos'  => ['required',  'integer', 'max:8', 'numeric'],
            'tipo'              => ['required'], 
            'riteve'            => ['required'], 
            'marchamo'          => ['required'], 
        ],[
            'placa.required'    => 'La :attribute es obligatoria. ', 
            'placa.max'         => 'La :attribute debe contener de un máximo de 15 caracteres. ', 
            'placa.unique'      => 'La :attribute que desea ingresar ya existe. ', 

            'marca.required'    => 'La :attribute es obligatoria. ', 
            'marca.max'         => 'La :attribute debe contener un máximo de 9 caracteres. ', 
            'marca.regex'       => 'La :attribute no debe contener numeros. ',

            'modelo.required'    => 'El :attribute es obligatorio.', 
            'modelo.max'         => 'El :attribute debe contener un máximo de 9 caracteres. ', 
            
            'cantidadAsientos.required'    => 'La :attribute es obligatorio. ', 
            'cantidadAsientos.max'         => 'La :attribute debe contener un  máximo de 8 caracteres. ', 
            'cantidadAsientos.numeric'     => 'La :attribute debe ser de forma numérica. ', 
            'cantidadAsientos.integer'     => 'La :attribute debe contener solo números enteros. ', 

            'tipo.required'     => 'El :attribute es obligatorio.', 

            'riteve.required'   => 'La :attribute es obligatoria.', 

            'marchamo.required' => 'La :attribute es obligatoria.', 
        ],[
            'placa'             => 'placa del vehículo', 
            'marca'             => 'marca del vehículo',
            'modelo'            => 'modelo del vehículo',
            'cantidadAsientos'  => 'cantidad de asientos',   
            'tipo'              => 'tipo de vehículo',
            'riteve'            => 'fecha de riteve',
            'marchamo'          => 'fecha de marchamo',
        ]); 
        if ($validator->passes()) {
            $vehiculo = new vehiculos;
             
            $vehiculo->placa = $request->placa;
            $vehiculo->marca = $request->marca;
            $vehiculo->modelo = $request->modelo;
            $vehiculo->cantidadAsientos = $request->cantidadAsientos; 
            $vehiculo->tipo = $request->tipo; 
            
            $vehiculo->riteve = Carbon::createFromFormat('d/m/Y', $request->riteve); 
            $vehiculo->marchamo = Carbon::createFromFormat('d/m/Y', $request->marchamo);
            $vehiculo->estado = "Activo";
            $vehiculo->save();
            return response()->json(['success'=>'Added new records.']);

        } 
    	return response()->json(['errors'=>$validator->errors()->all()]); 
    }
    public function show(vehiculos $vehiculos)
    { 
        //
    } 
    public function edit($placa)
    {
        $vehiculo = vehiculos::find($placa);  
        return view('vehiculos.edit',compact("vehiculo"));
    } 
    public function update(Request $request)
    {            
        $validator = Validator::make($request->all(), [ 
            'marca'             => ['required', 'max:50', 'regex:(^[\pL\s\-]+$)'],
            'modelo'            => ['required', 'max:50'],
            'cantidadAsientos'  => ['required',  'integer', 'max:8', 'numeric'],
            'tipo'              => ['required'],
            'riteve'            => ['required'], 
            'marchamo'          => ['required'], 
        ],[ 

            'marca.required'    => 'La :attribute es obligatoria. ', 
            'marca.max'         => 'La :attribute debe contener un máximo de 9 caracteres. ', 
            'marca.string'      => 'La :attribute no debe contener numeros. ', 

            'modelo.required'    => 'El :attribute es obligatorio. ', 
            'modelo.max'         => 'El :attribute debe contener un máximo de 9 caracteres. ', 
            
            'cantidadAsientos.required'    => 'La :attribute es obligatorio. ', 
            'cantidadAsientos.max'         => 'La :attribute debe contener un  máximo de 8 caracteres. ', 
            'cantidadAsientos.numeric'     => 'La :attribute debe ser de forma numérica. ', 
            'cantidadAsientos.integer'     => 'La :attribute debe contener solo números enteros. ', 

            'tipo.required'     => 'El :attribute es obligatorio.', 

            'riteve.required'   => 'La :attribute es obligatoria.', 

            'marchamo.required' => 'La :attribute es obligatoria.', 
        ],[  
            'marca'             => 'marca del vehículo',
            'modelo'            => 'modelo del vehículo',
            'cantidadAsientos'  => 'cantidad de asientos',   
            'tipo'              => 'tipo de vehículo',
            'riteve'            => 'fecha de riteve',
            'marchamo'          => 'fecha de marchamo',
        ]);   
        if ($validator->passes()) {
            $vehiculo =  vehiculos::find($request->placa); 
            $vehiculo->placa = $request->placa;
            $vehiculo->marca = $request->marca;
            $vehiculo->modelo = $request->modelo;
            $vehiculo->cantidadAsientos = $request->cantidadAsientos; 
            $vehiculo->tipo = $request->tipo;  
            $vehiculo->riteve = Carbon::createFromFormat('d/m/Y', $request->riteve); 
            $vehiculo->marchamo = Carbon::createFromFormat('d/m/Y', $request->marchamo);
            $vehiculo->save();
            return response()->json(['success'=>'Added new records.']); 
        } 
    	return response()->json(['errors'=>$validator->errors()->all()]); 
    } 
    public function destroy($placa)
    {
        $mantenimientoV = mantenimientoVehicular::where('placa', $placa);
        if($mantenimientoV->count() <=0){
            $vehiculo = vehiculos::find($placa); 
            $vehiculo->delete();
            return response()->json(['success'=>['Registro eliminado con éxito']]); 
        }else{
            return response()->json(['errors'=>['Verifique que no tenga registros enlazados a este registo']]);
        }

    } 
}
