<?php

namespace App\Http\Controllers;

use App\desarrUrbanoCombus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DesarrUrbanoCombusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
    } 
    public function create()
    {
        return view('presupuestos.presupuestoCombustible.desarrolloUrbano.create');
    } 
    public function store(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'montoEstablecido'  => ['required', 'min:1', 'numeric'],
            'fechaRegistro' => ['required'], 
        ],[
            'montoEstablecido.required' => 'El :attribute es obligatorio. ',   
            'montoEstablecido.max'      => 'El :attribute debe tener máximo 10 digitos.',   
            'montoEstablecido.min'      => 'El :attribute debe ser mínimo 1',
            'montoEstablecido.numeric'          => 'El :attribute debe contener solo números.',

            'fechaRegistro.required'    => 'La :attribute es obligatoria.', 
        ],[
            'montoEstablecido'          => 'monto inicial',
            'fechaRegistro'             => 'fecha de ingreso del monto',           
        ]);   

        if ($validator->passes()) {
            $desarrUrbanoCombus = new desarrUrbanoCombus; 
            $desarrUrbanoCombus->fechaRegistro = $request->fechaRegistro; 
            $desarrUrbanoCombus->montoEstablecido =$request->montoEstablecido;
            $desarrUrbanoCombus->montoRestante = $request->montoEstablecido;
            $desarrUrbanoCombus->save();
            return response()->json(['success'=>'Added new records.']); 
        } 
    	return response()->json(['errors'=>$validator->errors()->all()]); 
    } 
    public function show(desarrUrbanoCombus $desarrUrbanoCombus)
    {
        //
    } 
    public function edit($idDUC)
    {
        $desarrUrbanoCombus = desarrUrbanoCombus::find($idDUC); 
        return view('presupuestos.presupuestoCombustible.desarrolloUrbano.edit',compact('desarrUrbanoCombus'));
    } 
    public function update(Request $request)
    {  
        $validator = Validator::make($request->all(), [
            'montoEstablecido'  => ['required', 'min:1', 'numeric'],
            'fechaRegistro' => ['required'], 
        ],[
            'montoEstablecido.required' => 'El :attribute es obligatorio.',   
            'montoEstablecido.max'      => 'El :attribute debe tener máximo 10 digitos.',  
            'montoEstablecido.min'      => 'El :attribute debe ser mínimo 1', 
            'montoEstablecido.numeric'          => 'El :attribute debe contener solo números.',

            'fechaRegistro.required'    => 'La :attribute es obligatoria.', 
        ],[
            'montoEstablecido'          => 'monto inicial',
            'fechaRegistro'             => 'fecha de ingreso del monto',           
        ]);   
        if ($validator->passes()) {
            $desarrUrbanoCombus = desarrUrbanoCombus::find($request->idDUC);  
            $desarrUrbanoCombus->fechaRegistro = $request->fechaRegistro; 
            $desarrUrbanoCombus->montoEstablecido =$request->montoEstablecido;
            $desarrUrbanoCombus->montoRestante = $desarrUrbanoCombus->montoEstablecido;
            $desarrUrbanoCombus->save();
            return response()->json(['success'=>'Added new records.']); 
        } 
    	return response()->json(['errors'=>$validator->errors()->all()]); 
    } 
    public function destroy($idDUC)
    {
        $busqueda = \DB::select('select * from historico_desarr_urbano_combuses where desarr_urbano_combus = '.$idDUC);
        if(count($busqueda)<=0)
        {
            $desarrUrbanoCombus = desarrUrbanoCombus::find($idDUC);
            $desarrUrbanoCombus->delete();
            return response()->json(['success'=>'Registro eliminado con éxito']); 
        }
        else 
        {
            return response()->json(['errors'=>'error']);
        } 
    }
}
