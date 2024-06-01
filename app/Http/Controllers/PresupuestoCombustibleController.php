<?php

namespace App\Http\Controllers;

use App\presupuestoCombustible;
use App\presupuestoHistoricoC;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class PresupuestoCombustibleController extends Controller
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
        return view('presupuestos.presupuestoCombustible.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'montoEstablecido'  => ['required', 'regex:/(^([0-9]+)(\d+)?$)/u'],
            'fechaRegistro' => ['required'], 
        ],[
            'montoEstablecido.required' => 'El :attribute es obligatorio. ',  
            'montoEstablecido.regex'    => 'El :attribute debe ser solo números. ',   
            'montoEstablecido.max'    => 'El :attribute debe tener máximo 10 digitos.',   

            'fechaRegistro.required'    => 'La :attribute es obligatoria.', 
        ],[
            'montoEstablecido'          => 'monto inicial',
            'fechaRegistro'             => 'fecha de ingreso del monto',           
        ]);   

        if ($validator->passes()) {
            $presuCombustible = new presupuestoCombustible;

            $presuCombustible->fechaRegistro = $request->fechaRegistro; 
            $presuCombustible->montoEstablecido =$request->montoEstablecido;
            $presuCombustible->montoRestante = $request->montoEstablecido;
            $presuCombustible->save();
            return response()->json(['success'=>'Added new records.']);

        } 
    	return response()->json(['errors'=>$validator->errors()->all()]); 
    }
    public function show(presupuestoCombustible $presupuestoCombustible)
    {
        //
    }
    public function edit($idPC)
    {
        $presuCombustible = presupuestoCombustible::find($idPC);
        return view('presupuestos.presupuestoCombustible.edit',compact('presuCombustible'));
    }

    public function update(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'montoEstablecido'  => ['required', 'regex:/(^([0-9]+)(\d+)?$)/u'],
            'fechaRegistro' => ['required'], 
        ],[
            'montoEstablecido.required' => 'El :attribute es obligatorio.',  
            'montoEstablecido.regex'    => 'El :attribute debe ser solo números.',   
            'montoEstablecido.max'    => 'El :attribute debe tener máximo 10 digitos.',   

            'fechaRegistro.required'    => 'La :attribute es obligatoria.', 
        ],[
            'montoEstablecido'          => 'monto inicial',
            'fechaRegistro'             => 'fecha de ingreso del monto',           
        ]);  

        if ($validator->passes()) {
            $presuCombustible = presupuestoCombustible::find($request->idPC);

            $presuCombustible->fechaRegistro = $request->fechaRegistro; 
            $presuCombustible->montoEstablecido =$request->montoEstablecido;
            $presuCombustible->montoRestante = $presuCombustible->montoEstablecido;
            $presuCombustible->save();
            return response()->json(['success'=>'Added new records.']);

        } 
    	return response()->json(['errors'=>$validator->errors()->all()]); 
    }

    public function destroy($idPC)
    {
        $busqueda = \DB::select('select * from presupuesto_historico_cs where idHC = '.$idPC);
        if(count($busqueda)<=0)
        {
            $presupuestoCombustible = presupuestoCombustible::find($idPC);
            $presupuestoCombustible->delete();
            return response()->json(['success'=>'Registro eliminado con éxito']); 
        }
        else 
        {
            return response()->json(['errors'=>'error']);
        } 
    }
}
