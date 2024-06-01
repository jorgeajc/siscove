<?php

namespace App\Http\Controllers;

use App\presupuestoHistoricoC;
use Illuminate\Http\Request;
use App\presupuestoCombustible;
use App\vehiculos;
use Illuminate\Support\Facades\Validator;
class PresupuestoHistoricoCController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
    }
    public function historicoC($idPC)
    {
        $presupuestoC = presupuestoCombustible::find($idPC);
        $presupuestoHC = \DB::select('select * from presupuesto_historico_cs where presupuesto_combustible = '.$idPC);
        return view('historicoPresupuesto.presupuestoHC.index', compact('presupuestoC','presupuestoHC'));
    }
    public function create()
    {
    }
    public function crear($idPC)
    {
        $vehiculos  = vehiculos::all();  
        return view('historicoPresupuesto.presupuestoHC.create',compact('vehiculos', 'idPC'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fechaCreacion'     => ['required'],
            'numeroCupon'     => ['required', 'unique:presupuesto_historico_cs', 'regex:/(^([0-9]+)(\d+)?$)/u'],
            'numeroFactura'     => ['required', 'unique:presupuesto_historico_cs', 'regex:/(^([0-9]+)(\d+)?$)/u'],
            'placa'             => ['required'],
            'cantLitros'        => ['required', 'regex:/(^([0-9]+)(\d+)?$)/u', 'max:5'],
            'montoFactura'      => ['required', 'regex:/(^([0-9.]+)(\d+)?$)/u'],
        ],[
            'fechaCreacion.required'        => 'La :attribute es obligatoria. ',  
 
            'numeroCupon.required'          => 'El :attribute es obligatorio. ',
            'numeroCupon.unique'            => 'El :attribute que intenta agregar ya existe. ', 
            'numeroCupon.regex'             => 'El :attribute debe contener solo números. ',

            'numeroFactura.required'        => 'El :attribute es obligatorio. ', 
            'numeroFactura.unique'          => 'El :attribute que intenta agregar ya existe. ',  
            'numeroFactura.regex'           => 'El :attribute debe contener solo números. ',   

            'placa.required'                => 'La :attribute es obligatoria. ',

            'cantLitros.required'           => 'La :attribute es obligatoria.',
            'cantLitros.regex'              => 'El :attribute debe ser solo numeros.',   
            'cantLitros.max'                => 'El :attribute deben ser solo 5 digitos.',   

            'montoFactura.required'         => 'El :attribute es obligatorio. ', 
            'montoFactura.regex'            => 'El :attribute debe contener solo números; los decimales son separados por un punto. ',   
        ],[
            'fechaCreacion'                 => 'fecha de facturación',
            'numeroCupon'                   => 'número de cupón',
            'numeroFactura'                 => 'número de factura',
            'placa'                         => 'placa del vehículo',
            'cantLitros'                    => 'cantidad de litros',
            'montoFactura'                  => 'monto de la factura',             
        ]);  

        if ($validator->passes()) {
            $PHC = new presupuestoHistoricoC;
            $PC = presupuestoCombustible::find($request->idPC); 

            $PHC->fechaCreacion =$request->fechaCreacion;
            $PHC->numeroCupon =$request->numeroCupon;
            $PHC->numeroFactura =$request->numeroFactura;
            $PHC->placa = $request->placa;
            $PHC->cantLitros = $request->cantLitros;
            $PHC->montoFactura = $request->montoFactura; 
            $PHC->presupuesto_combustible = $request->idPC; 
            $PC->montoRestante = $PC->montoRestante - $request->montoFactura; 
            $PC->save();
            
            $PHC->save();
            return response()->json(['success'=>'Added new records.']);
        }
        return response()->json(['errors'=>$validator->errors()->all()]); 
    }

    public function show(presupuestoHistoricoC $presupuestoHistoricoC)
    {
        //
    }

    public function edit(presupuestoHistoricoC $presupuestoHistoricoC)
    {
        //
    }

    public function update(Request $request, presupuestoHistoricoC $presupuestoHistoricoC)
    {
        //
    }
    public function destroy(Request $request)
    {
        $presupuestoHC = presupuestoHistoricoC::find($request->idHC);
        $presupuestoC = presupuestoCombustible::find($request->idPC); 
        $presupuestoC ->montoRestante = $presupuestoC ->montoRestante + $presupuestoHC->montoFactura;
        $presupuestoC->save();
        $presupuestoHC->delete();
        return response()->json(['success'=>'Registro eliminado con éxito']);
    }
}
