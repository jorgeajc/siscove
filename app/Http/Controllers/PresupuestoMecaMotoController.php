<?php

namespace App\Http\Controllers;

use App\presupuestoMecaMoto;
use App\presupuestoHistoricoMM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PresupuestoMecaMotoController extends Controller
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
        return view('presupuestos.presupuestoMM.create');
    }
    public function store(Request $request)
    {
        $validator = validator::make($request->all(),[
            'fechaRegistro'                 => ['required'],
            'montoEstablecido'              => ['required', 'min:1', 'numeric'],
        ],[
            'fechaRegistro.required'        =>'La :attribute es obligatoria. ',

            'montoEstablecido.required'     =>'El :attribute es obligatorio. ',
            'montoEstablecido.max'          => 'El :attribute debe tener máximo 10 digitos.',  
            'montoEstablecido.min'      => 'El :attribute debe ser mínimo 1',
            'montoEstablecido.numeric'          => 'El :attribute debe contener solo números.',
        ],[
            'fechaRegistro'                 =>'fecha de ingreso del monto',
            'montoEstablecido'              =>'monto inicial',
        ]);

        if($validator->passes())
        {
            $nuevaMM = new presupuestoMecaMoto;
            $nuevaMM ->fechaRegistro = $request->fechaRegistro;
            $nuevaMM ->montoEstablecido = $request->montoEstablecido;
            $nuevaMM ->montoRestante = $request->montoEstablecido;
            $nuevaMM->save();
            return response()->json(['success'=>'Added new records.']);
        }
        return response()->json(['errors'=>$validator->errors()->all()]); 
   
    } 
    public function show(presupuestoMecaMoto $presupuestoMecaMoto)
    {
        //
    } 
    public function edit($idPMM)
    {
        $presupuestoMM = presupuestoMecaMoto::find($idPMM);
        return view('presupuestos.presupuestoMM.edit',compact('presupuestoMM'));
    } 
    public function update(Request $request)
    {
        $validator = validator::make($request->all(),[
            'fechaRegistro'                 => ['required'],
            'montoEstablecido'              => ['required', 'min:1', 'numeric'],
        ],[
            'fechaRegistro.required'        =>'La :attribute es obligatoria. ',

            'montoEstablecido.required'     =>'El :attribute es obligatorio',
            'montoEstablecido.max'    => 'El :attribute debe tener máximo 10 digitos.',   
            'montoEstablecido.min'      => 'El :attribute debe ser mínimo 1',
            'montoEstablecido.numeric'          => 'El :attribute debe contener solo números.',
        ],[
            'fechaRegistro'                 =>'fecha de ingreso del monto',
            'montoEstablecido'              =>'monto inicial',
        ]); 

        if ($validator->passes()) {
            $presuMM = presupuestoMecaMoto::find($request->idPMM);

            $presuMM->fechaRegistro = $request->fechaRegistro; 
            $presuMM->montoEstablecido = $request->montoEstablecido;
            $presuMM->montoRestante = $request->montoEstablecido;
            $presuMM->save();
            return response()->json(['success'=>'Added new records.']); 
        } 
    	return response()->json(['errors'=>$validator->errors()->all()]);  
    } 
    public function destroy($idPMM)
    {
        $busqueda = presupuestoHistoricoMM::where('idHMM',$idPMM);
        if($busqueda->count()<=0)
        {
            $nuevaMM = presupuestoMecaMoto::find($idPMM);
            $nuevaMM->delete();
            return response()->json(['success'=>'Registro eliminado con éxito']); 
        }
        else
        {
            return response()->json(['errors'=>'error']);
        }
        
    }
}
