<?php

namespace App\Http\Controllers;

use App\PresupuestoRC;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PresupuestoRCController extends Controller
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
        return view('presupuestos.presupuestoRC.create'); 
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
            $nuevoRepuestoC = new PresupuestoRC;
            $nuevoRepuestoC ->fechaRegistro = $request->fechaRegistro;
            $nuevoRepuestoC ->montoEstablecido = $request->montoEstablecido;
            $nuevoRepuestoC ->montoRestado = $request->montoEstablecido;
            $nuevoRepuestoC->save();
            return response()->json(['success'=>'Added new records.']);
        }
        return response()->json(['errors'=>$validator->errors()->all()]); 
    } 
    public function show(PresupuestoRC $presupuestoRC)
    {
        //
    } 
    public function edit($idPRC)
    {
        $presupuestoRC = PresupuestoRC::find($idPRC);
        return view('presupuestos.presupuestoRC.edit',compact('presupuestoRC')); 
    } 
    public function update(Request $request)
    {
        $validator = validator::make($request->all(),[
            'fechaRegistro'                 => ['required'],
            'montoEstablecido'              => ['required', 'min:1', 'numeric'],
        ],[
            'fechaRegistro.required'        =>'La :attribute es obligatoria. ',

            'montoEstablecido.required'     =>'El :attribute es obligatorio. ',
            'montoEstablecido.regex'        => 'El :attribute debe ser solo números.',   
            'montoEstablecido.max'    => 'El :attribute debe tener máximo 10 digitos.',   
            'montoEstablecido.min'      => 'El :attribute debe ser mínimo 1',
            'montoEstablecido.numeric'          => 'El :attribute debe contener solo números.',
        ],[
            'fechaRegistro'                 =>'fecha de ingreso del monto',
            'montoEstablecido'              =>'monto inicial',
        ]); 

        if ($validator->passes()) {
            $presuRC = PresupuestoRC::find($request->idPRC);

            $presuRC->fechaRegistro = $request->fechaRegistro; 
            $presuRC->montoEstablecido = $request->montoEstablecido;
            $presuRC->montoRestado = $presuRC->montoEstablecido;
            $presuRC->save();
            return response()->json(['success'=>'Added new records.']); 
        } 
    	return response()->json(['errors'=>$validator->errors()->all()]);    
    } 
    public function destroy($idPRC)
    {
        $nuevoRepuestoC = PresupuestoRC::find($idPRC);
        $nuevoRepuestoC->delete();
        return response()->json(['success'=>'Registro eliminado con éxito']);
    }
}
