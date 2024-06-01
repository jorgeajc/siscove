<?php

namespace App\Http\Controllers;

use App\presupuestoRepuestoMoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PresupuestoRepuestoMotoController extends Controller
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
        return view('presupuestos.presupuestoRM.create');
    }
    public function store(Request $request)
    {
        $validator = validator::make($request->all(),[
            'fechaRegistro'                 => ['required'],
            'montoEstablecido'              => ['required', 'min:1', 'numeric'],
        ],[
            'fechaRegistro.required'        =>'La :attribute es obligatoria. ',

            'montoEstablecido.required'     =>'El :attribute es obligatorio. ',
            'montoEstablecido.regex'        => 'El :attribute debe ser solo números. ',   
            'montoEstablecido.max'          => 'El :attribute debe tener máximo 10 digitos.',  
            'montoEstablecido.min'      => 'El :attribute debe ser mínimo 1',
            'montoEstablecido.numeric'          => 'El :attribute debe contener solo números.',
        ],[
            'fechaRegistro'                 =>'fecha de ingreso del monto',
            'montoEstablecido'              =>'monto inicial',
        ]);

        if($validator->passes())
        {
            $nuevoRM = new presupuestoRepuestoMoto;
            $nuevoRM ->fechaRegistro = $request->fechaRegistro;
            $nuevoRM ->montoEstablecido = $request->montoEstablecido;
            $nuevoRM ->montoRestante = $request->montoEstablecido;
            $nuevoRM->save();
            return response()->json(['success'=>'Added new records.']);
        }
        return response()->json(['errors'=>$validator->errors()->all()]); 
   
    } 
    public function show(presupuestoRepuestoMoto $presupuestoRepuestoMoto)
    {
        //
    } 
    public function edit($idPRM)
    {
        $presupuestoRM = presupuestoRepuestoMoto::find($idPRM);
        return view('presupuestos.presupuestoRM.edit', compact('presupuestoRM'));
    } 
    public function update(Request $request, presupuestoRepuestoMoto $presupuestoRepuestoMoto)
    {
        $validator = validator::make($request->all(),[
            'fechaRegistro'                 => ['required'],
            'montoEstablecido'              => ['required', 'min:1', 'numeric'],
        ],[
            'fechaRegistro.required'        =>'La :attribute es obligatoria. ',

            'montoEstablecido.required'     =>'El :attribute es obligatorio',
            'montoEstablecido.regex'        => 'El :attribute debe ser solo números.',   
            'montoEstablecido.max'    => 'El :attribute debe tener máximo 10 digitos.',   
            'montoEstablecido.min'      => 'El :attribute debe ser mínimo 1',
            'montoEstablecido.numeric'          => 'El :attribute debe contener solo números.',
        ],[
            'fechaRegistro'                 =>'fecha de ingreso del monto',
            'montoEstablecido'              =>'monto inicial',
        ]);  

        if ($validator->passes()) {
            $presupuestoRM = presupuestoRepuestoMoto::find($request->idPRM);

            $presupuestoRM->fechaRegistro = $request->fechaRegistro; 
            $presupuestoRM->montoEstablecido = $request->montoEstablecido;
            $presupuestoRM->montoRestante = $presupuestoRM->montoEstablecido;
            $presupuestoRM->save();
            return response()->json(['success'=>'Added new records.']); 
        } 
    	return response()->json(['errors'=>$validator->errors()->all()]);  
    } 
    public function destroy($idPRM)
    {
        $nuevoRM = presupuestoRepuestoMoto::find($idPRM);
        $nuevoRM->delete();
        return response()->json(['success'=>'Registro eliminado con éxito']);
        
    }
}
