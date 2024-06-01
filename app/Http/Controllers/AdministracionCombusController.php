<?php

namespace App\Http\Controllers;

use App\administracionCombus;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Validator;
class AdministracionCombusController extends Controller
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
        return view('presupuestos.presupuestoCombustible.administracion.create');
    } 
    public function store(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'montoEstablecido'  => ['required', 'min:1', 'numeric'],
            'fechaRegistro' => ['required'], 
        ],[
            'montoEstablecido.required' => 'El :attribute es obligatorio. ',   
            'montoEstablecido.max'    => 'El :attribute debe tener máximo 10 digitos.',  
            'montoEstablecido.min'      => 'El :attribute debe ser mínimo 1', 
            'montoEstablecido.numeric'          => 'El :attribute debe contener solo números.',

            'fechaRegistro.required'    => 'La :attribute es obligatoria.', 
        ],[
            'montoEstablecido'          => 'monto inicial',
            'fechaRegistro'             => 'fecha de ingreso del monto',           
        ]);   

        if ($validator->passes()) {
            $administracionCombus = new administracionCombus; 
            $administracionCombus->fechaRegistro = $request->fechaRegistro; 
            $administracionCombus->montoEstablecido =$request->montoEstablecido;
            $administracionCombus->montoRestante = $request->montoEstablecido;
            $administracionCombus->save();
            return response()->json(['success'=>'Added new records.']); 
        } 
    	return response()->json(['errors'=>$validator->errors()->all()]); 
    } 
    public function show(administracionCombus $administracionCombus)
    {
        //
    } 
    public function edit($idAC)
    {
        $adminiCombustible = administracionCombus::find($idAC); 
        return view('presupuestos.presupuestoCombustible.administracion.edit',compact('adminiCombustible'));
    } 
    public function update(Request $request)
    {  
        $validator = Validator::make($request->all(), [
            'montoEstablecido'  => ['required', 'min:1', 'numeric'],
            'fechaRegistro' => ['required'], 
        ],[
            'montoEstablecido.required' => 'El :attribute es obligatorio.',   
            'montoEstablecido.max'    => 'El :attribute debe tener máximo 10 digitos.',   
            'montoEstablecido.min'      => 'El :attribute debe ser mínimo 1',
            'montoEstablecido.numeric'          => 'El :attribute debe contener solo números.',

            'fechaRegistro.required'    => 'La :attribute es obligatoria.', 
        ],[
            'montoEstablecido'          => 'monto inicial',
            'fechaRegistro'             => 'fecha de ingreso del monto',           
        ]);   
        if ($validator->passes()) {
            $administracionCombus = administracionCombus::find($request->idAC);  
            $administracionCombus->fechaRegistro = $request->fechaRegistro; 
            $administracionCombus->montoEstablecido =$request->montoEstablecido;
            $administracionCombus->montoRestante = $administracionCombus->montoEstablecido;
            $administracionCombus->save();
            return response()->json(['success'=>'Added new records.']); 
        } 
    	return response()->json(['errors'=>$validator->errors()->all()]); 
    } 
    public function destroy($idAC)
    {
        $busqueda = \DB::select('select * from historico_admini_combuses where administracion_combus = '.$idAC);
        if(count($busqueda)<=0)
        {
            $administracionCombus = administracionCombus::find($idAC);
            $administracionCombus->delete();
            return response()->json(['success'=>'Registro eliminado con éxito']); 
        }
        else 
        {
            return response()->json(['errors'=>'error']);
        } 
    }
}
