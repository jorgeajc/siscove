<?php

namespace App\Http\Controllers;

use App\presupuestoAireAcond;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Validator;
use App\presupuestoHistoricoAA;
class PresupuestoAireAcondController extends Controller
{ 
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        
    } 
    public function create()
    {
        return view('presupuestos.presupuestoAA.create');
    } 
    public function store(Request $request)
    {    
        $validator = Validator::make($request->all(), [
            'montoEstablecido'  => ['required', 'min:1', 'numeric'],
            'fechaRegistro' => ['required'], 
        ],[
            'montoEstablecido.required'     => 'El :attribute es obligatorio. ',   
            'montoEstablecido.max'    => 'El :attribute debe tener máximo 10 digitos.',  
            'montoEstablecido.min'      => 'El :attribute debe ser mínimo 1',
            'montoEstablecido.numeric'          => 'El :attribute debe contener solo números.',

            'fechaRegistro.required'        => 'La :attribute es obligatoria. ', 
        ],[
            'montoEstablecido'              => 'monto inicial',
            'fechaRegistro'                 => 'fecha de ingreso del monto',           
        ]);  

        if ($validator->passes()) {
            $presuAA = new presupuestoAireAcond;

            $presuAA->montoEstablecido =$request->montoEstablecido;
            $presuAA->fechaRegistro = $request->fechaRegistro; 
            $presuAA->montoRestante = $request->montoEstablecido;
            $presuAA->save();
            return response()->json(['success'=>'Added new records.']);

        } 
    	return response()->json(['errors'=>$validator->errors()->all()]); 
    }  
    public function show(presupuestoAireAcond $presupuestoAireAcond)
    {
        //
    } 
    public function edit($idPAA)
    {
        $presupuestoAA = presupuestoAireAcond::find($idPAA);
        return view('presupuestos.presupuestoAA.edit',compact('presupuestoAA'));
    } 
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'montoEstablecido'  => ['required', 'min:1', 'numeric'],
            'fechaRegistro' => ['required'], 
        ],[
            'montoEstablecido.required'     => 'El :attribute es obligatorio.',  
            'montoEstablecido.regex'        => 'El :attribute debe ser solo números.',   
            'montoEstablecido.max'    => 'El :attribute debe tener máximo 10 digitos.',  
            'montoEstablecido.min'      => 'El :attribute debe ser mínimo 1',
            
            'fechaRegistro.required'        => 'La :attribute es obligatoria.', 
        ],[
            'montoEstablecido'              => 'monto inicial',
            'fechaRegistro'                 => 'fecha de ingreso del monto',           
        ]);  

        if ($validator->passes()) {
            $presuAA = presupuestoAireAcond::find($request->idPAA); 
            $presuAA->fechaRegistro = $request->fechaRegistro; 
            $presuAA->montoEstablecido =$request->montoEstablecido;
            $presuAA->montoRestante = $request->montoEstablecido;
            $presuAA->save();
            return response()->json(['success'=>'Added new records.']);

        } 
    	return response()->json(['errors'=>$validator->errors()->all()]); 
    } 
    public function destroy($idPAA)
    { 
        $presupuestoHAA = presupuestoHistoricoAA::where('presupuesto_aire_acond',$idPAA); 
        if($presupuestoHAA->count() <=0)
        { 
            $presuAA = presupuestoAireAcond::find($idPAA);
            $presuAA->delete();
            return response()->json(['success'=>'Registro eliminado con éxito']); 
        } 
        else{
            return response()->json(['errors'=>'error']);   
        } 
    }
}