<?php

namespace App\Http\Controllers;

use App\presupuestoMecaCarro;
use App\presupuestoHistoricoMC;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PresupuestoMecaCarroController extends Controller
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
        return view('presupuestos.presupuestoMC.create');
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
            $nuevaMecanica = new presupuestoMecaCarro;
            $nuevaMecanica ->fechaRegistro = $request->fechaRegistro;
            $nuevaMecanica ->montoEstablecido = $request->montoEstablecido;
            $nuevaMecanica ->montoRestado = $request->montoEstablecido;
            $nuevaMecanica->save();
            return response()->json(['success'=>'Added new records.']);
        }
        return response()->json(['errors'=>$validator->errors()->all()]); 
    } 
    public function show(presupuestoMecaCarro $presupuestoMecaCarro)
    {
        //
    } 
    public function edit($idPMC)
    {
        $presupuestoMC = presupuestoMecaCarro::find($idPMC);
        return view('presupuestos.presupuestoMC.edit',compact('presupuestoMC')); 
    } 
    public function update(Request $request)
    {
        $validator = validator::make($request->all(),[
            'fechaRegistro'                 => ['required'],
            'montoEstablecido'              => ['required', 'min:1', 'numeric'],
        ],[
            'fechaRegistro.required'        =>'La :attribute es obligatoria. ',

            'montoEstablecido.required'     =>'El :attribute es obligatorio. ',
            'montoEstablecido.max'    => 'El :attribute debe tener máximo 10 digitos.',    
            'montoEstablecido.min'      => 'El :attribute debe ser mínimo 1',
            'montoEstablecido.numeric'          => 'El :attribute debe contener solo números.',
        ],[
            'fechaRegistro'                 =>'fecha de ingreso del monto',
            'montoEstablecido'              =>'monto inicial',
        ]);  
        if ($validator->passes()) {
            $presuMC = presupuestoMecaCarro::find($request->idPMC);

            $presuMC->fechaRegistro = $request->fechaRegistro; 
            $presuMC->montoEstablecido = $request->montoEstablecido;
            $presuMC->montoRestado = $presuMC->montoEstablecido;
            $presuMC->save();
            return response()->json(['success'=>'Added new records.']); 
        } 
    	return response()->json(['errors'=>$validator->errors()->all()]); 
    } 
    public function destroy($idPMC)
    {
        $busqueda = presupuestoHistoricoMC::where('idHMC',$idPMC)->get(); 
        if($busqueda->count()<=0)
        {
            $nuevaMecanica = presupuestoMecaCarro::find($idPMC);
            $nuevaMecanica->delete();
            return response()->json(['success'=>'Registro eliminado con éxito']); 
        }
        else
        {
            return response()->json(['errors'=>'error']);
        }
    }
}
