<?php

namespace App\Http\Controllers;

use App\presupuestoLavaVehi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PresupuestoLavaVehiController extends Controller
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
        return view('presupuestos.presupuestoLV.create');
    } 
    public function store(Request $request)
    {
       $validator = validator::make($request->all(),[
            'monto'                 =>['required', 'min:1', 'numeric'], 
            'fecha'                 =>['required'], 
        ],[
            'monto.required'        =>'El :attribute es obligatorio. ', 
            'monto.regex'           => 'El :attribute debe ser solo numeros. ',  
            'monto.max'             => 'El :attribute debe tener máximo 10 digitos.',  
            'monto.min'      => 'El :attribute debe ser mínimo 1',
            'monto.numeric'          => 'El :attribute debe contener solo números.',

            'fecha.required'        =>'La :attribute es obligatoria. ',  
        ],[
            'monto'                 => 'monto inicial',
            'fecha'                 => 'fecha de ingreso del monto',  
        ]);

        if($validator->passes())
        {
            $presuLV = new presupuestoLavaVehi;

            $presuLV ->fecha = $request->fecha;
            $presuLV ->monto = $request->monto;
            $presuLV ->montoRestante = $request->monto;
            //$presuLV ->presupuestoGeneral = $request->presupuestoGeneral;
            $presuLV->save();
            return response()->json(['success'=>'Added new records.']);
        }
        return response()->json(['errors'=>$validator->errors()->all()]);
    } 
    public function show(presupuestoLavaVehi $presupuestoLavaVehi)
    {
        //
    } 
    public function edit($idPLV)
    {
        $presupuestoLV = presupuestoLavaVehi::find($idPLV);
        return view('presupuestos.presupuestoLV.edit',compact('presupuestoLV'));
    } 
    public function update(Request $request)
    {
        $validator = validator::make($request->all(),[
            'monto'                 =>['required', 'min:1', 'numeric'], 
            'fecha'                 =>['required'], 
        ],[
            'monto.required'        =>'El :attribute es obligatorio. ', 
            'monto.max'    => 'El :attribute debe tener máximo 10 digitos.',   
            'monto.min'      => 'El :attribute debe ser mínimo 1',
            'monto.numeric'          => 'El :attribute debe contener solo números.',

            'fecha.required'        =>'La :attribute es obligatoria. ',  
        ],[
            'monto'                 => 'monto inicial', 
            'fecha'                 => 'fecha de ingreso del monto',   
        ]);  
    
        if ($validator->passes()) {
            $presuLV = presupuestoLavaVehi::find($request->idPLV);

            $presuLV->monto =$request->monto;
            $presuLV->montoRestante =$request->monto;
            $presuLV->fecha = $request->fecha;  
            $presuLV->save();
            return response()->json(['success'=>'Added new records.']); 
        } 
        return response()->json(['errors'=>$validator->errors()->all()]);  
    } 
    public function destroy($idPLV)
    {
        $presuLV = presupuestoLavaVehi::find($idPLV);
        $presuLV->delete();
        return response()->json(['success'=>'Added new records.']);
    }
}
