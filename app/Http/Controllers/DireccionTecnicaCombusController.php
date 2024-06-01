<?php

namespace App\Http\Controllers;

use App\direccionTecnicaCombus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class DireccionTecnicaCombusController extends Controller
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
        return view('presupuestos.presupuestoCombustible.direccionTecnica.create');
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
            $direccionTecnicaCombus = new direccionTecnicaCombus; 
            $direccionTecnicaCombus->fechaRegistro = $request->fechaRegistro; 
            $direccionTecnicaCombus->montoEstablecido =$request->montoEstablecido;
            $direccionTecnicaCombus->montoRestante = $request->montoEstablecido;
            $direccionTecnicaCombus->save();
            return response()->json(['success'=>'Added new records.']); 
        } 
    	return response()->json(['errors'=>$validator->errors()->all()]); 
    } 
    public function show(direccionTecnicaCombus $direccionTecnicaCombus)
    {
        //
    } 
    public function edit($idDUC)
    {
        $direccionTecnicaCombus = direccionTecnicaCombus::find($idDUC); 
        return view('presupuestos.presupuestoCombustible.direccionTecnica.edit',compact('direccionTecnicaCombus'));
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
            $direccionTecnicaCombus = direccionTecnicaCombus::find($request->idDTC);  
            $direccionTecnicaCombus->fechaRegistro = $request->fechaRegistro; 
            $direccionTecnicaCombus->montoEstablecido =$request->montoEstablecido;
            $direccionTecnicaCombus->montoRestante = $request->montoEstablecido;
            $direccionTecnicaCombus->save();
            return response()->json(['success'=>'Added new records.']); 
        } 
    	return response()->json(['errors'=>$validator->errors()->all()]); 
    } 
    public function destroy($idDTC)
    {
        $busqueda = \DB::select('select * from historico_direccion_tecnica_combuses where direc_tec_combus = '.$idDTC);
        if(count($busqueda)<=0)
        {
            $direccionTecnicaCombus = direccionTecnicaCombus::find($idDTC);
            $direccionTecnicaCombus->delete();
            return response()->json(['success'=>'Registro eliminado con éxito']); 
        }
        else 
        {
            return response()->json(['errors'=>'error']);
        } 
    }
}
