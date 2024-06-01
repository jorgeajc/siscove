<?php

namespace App\Http\Controllers;

use App\mantenimientoVehicular;
use Illuminate\Http\Request;
use App\vehiculos;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
class MantenimientoVehicularController extends Controller
{ 
    public function index()
    {  
    }
    public function vistaInicio($placa)
    {  
        session(['placa' => $placa]);
        $vehiculo = vehiculos::find($placa); 
        $mantenimiento = mantenimientoVehicular::orderBy('idMV','DESC')->where('placa', $placa)->paginate(5);
        return view('mantenimientoVehicular.index', compact('mantenimiento', 'vehiculo'));
    }
    public function index_desactivados($placa)
    {  
        session(['placa' => $placa]);
        $vehiculo = vehiculos::find($placa); 
        $mantenimiento = mantenimientoVehicular::orderBy('idMV','DESC')->where('placa', $placa)->paginate(5);
        return view('mantenimientoVehicular.index_desactivados', compact('mantenimiento', 'vehiculo'));
    }
    public function create()
    { 
    } 
    public function crear($placa)
    {
        $vehiculo = vehiculos::find($placa);  
        return view('mantenimientoVehicular.create', compact('vehiculo')); 
    } 
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'tipoVehiculo'  => ['required', 'string'],
            'motor'         => ['required'],      
            'fechaIngreso'  => ['required'],     
            'kilometros'    => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],      
            'descripcion'   => ['required'],
            'propietario'   => ['required'],       
        ],[  
            'tipoVehiculo.required'     => 'El :attribute es obligatorio. ', 
            'tipoVehiculo.string'       => 'El :attribute debe contener solo caracteres. ',

            'motor.required'            => 'El :attribute es obligatorio. ',   

            'fechaIngreso.required'     => 'La :attribute es obligatoria. ', 

            'kilometros.required'       => 'Los :attribute son obligatorios. ', 
            'kilometros.regex'          => 'Los :attribute deben ser solo números. ',

            'descripcion.required'      => 'La :attribute es obligatoria. ', 
            
            'propietario.required'      => 'El :attribute es obligatorio. ', 
        ],[
            'tipoVehiculo'  => 'tipo de vehículo',
            'motor'         => 'número del motor',       
            'fechaIngreso' => 'fecha de ingreso',       
            'kilometros'    => 'kilómetros',      
            'descripcion'   => 'descripción',
            'propietario'   => 'propietario',      
        ]);  

        if ($validator->passes()) {
            $mantenimientoVehicular = new mantenimientoVehicular;

            $mantenimientoVehicular->tipoVehiculo =$request->tipoVehiculo;
            $mantenimientoVehicular->Motor = $request->motor; 
            $mantenimientoVehicular->placa = $request->placa;
            $mantenimientoVehicular->modelo = $request->modelo;
            $mantenimientoVehicular->kilometros = $request->kilometros;
            $mantenimientoVehicular->fechaIngreso = $request->fechaIngreso;
            $mantenimientoVehicular->propietario = $request->propietario;
            $mantenimientoVehicular->descripcion = $request->descripcion;
            $mantenimientoVehicular->save();
            return response()->json(['success'=>'Added new records.']);

        } 
        return response()->json(['errors'=>$validator->errors()->all()]);   
    } 
    public function show(mantenimientoVehicular $mantenimientoVehicular)
    {
        //
    } 
    public function edit($idMV)
    {
        $placa = Session::get('placa');
        $vehiculo = vehiculos::find($placa);  
        $ManVe = mantenimientoVehicular::find($idMV);
    
        return view('mantenimientoVehicular.edit', compact('ManVe', 'vehiculo'));
    } 
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'tipoVehiculo'  => ['required', 'string'],
            'motor'         => ['required'],      
            'fechaIngreso'  => ['required'],     
            'kilometros'    => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],      
            'descripcion'   => ['required'],
            'propietario'   => ['required'],       
        ],[  
            'tipoVehiculo.required'     => 'El :attribute es obligatorio. ', 
            'motor.required'            => 'El :attribute es obligatorio. ',     
            'fechaIngreso.required'     => 'La :attribute es obligatoria. ', 
            'kilometros.required'       => 'Los :attribute son obligatorios. ', 
            'descripcion.required'      => 'La :attribute es obligatoria. ', 
            'propietario.required'      => 'El :attribute es obligatorio. ', 
        ],[
            'tipoVehiculo'  => 'tipo de vehículo',
            'motor'         => 'número del motor',       
            'fechaIngreso' => 'fecha de ingreso',       
            'kilometros'    => 'kilómetros',      
            'descripcion'   => 'descripción',
            'propietario'   => 'propietario',      
        ]);  

        if ($validator->passes()) { 
            $mantenimientoVehicular = mantenimientoVehicular::find($request->idMV);

            $mantenimientoVehicular->tipoVehiculo =$request->tipoVehiculo;
            $mantenimientoVehicular->Motor = $request->motor; 
            $mantenimientoVehicular->placa = $request->placa;
            $mantenimientoVehicular->modelo = $request->modelo;
            $mantenimientoVehicular->kilometros = $request->kilometros;
            $mantenimientoVehicular->fechaIngreso = $request->fechaIngreso;
            $mantenimientoVehicular->propietario = $request->propietario;
            $mantenimientoVehicular->descripcion = $request->descripcion;
            $mantenimientoVehicular->save(); 
            return response()->json(['success'=>'Added new records.']);

        } 
        return response()->json(['errors'=>$validator->errors()->all()]);   
    } 
    public function destroy($idMV)
    {
        $mantenimientoVehicular = mantenimientoVehicular::find($idMV);
        $mantenimientoVehicular->delete();
        return response()->json(['success'=>'Registro eliminado con éxito']);
    }
}
