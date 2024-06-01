<?php

namespace App\Http\Controllers;

use App\historicoDesarrUrbanoCombus;
use Illuminate\Http\Request;
use App\desarrUrbanoCombus;
use App\vehiculos;
use App\gasolineras;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;
class HistoricoDesarrUrbanoCombusController extends Controller
{ 
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
    } 
    public function historicoDUC($idDUC)
    {
        $presupuestoDUC = desarrUrbanoCombus::find($idDUC);  
        $presupuestoHDUC = DB::table('historico_desarr_urbano_combuses AS h')
                            ->select('h.idHDUC', 'h.fechaCreacion', 'h.numeroCupon', 'h.numeroFactura', 'h.cantLitros', 'h.montoFactura', 'h.placa', 'g.nombre as gasolinera')
                            ->where('desarr_urbano_combus', $idDUC)
                            ->join('gasolineras AS g', 'g.cedulaJuridica', 'h.gasFK')                                     
                            ->get(); 
        //dd($presupuestoHDUC);
        return view('historicoPresupuesto.presupuestoHC.historicoDUC.index', compact('presupuestoDUC','presupuestoHDUC'));
    }
    public function create()
    {
        //
    } 
    public function crear($idDUC)
    {
        $vehiculos  = vehiculos::all();  
        $gasolineras  = gasolineras::all(); 
        return view('historicoPresupuesto.presupuestoHC.historicoDUC.create',compact('vehiculos', 'idDUC', 'gasolineras'));
    } 
    public function store(Request $request)
    {
        $PC = desarrUrbanoCombus::find($request->idDUC); 
        $validator = Validator::make($request->all(), [
            'fechaCreacion'     => ['required'],
            'numeroCupon'     => ['required', 'unique:presupuesto_historico_cs', 'regex:/(^([0-9]+)(\d+)?$)/u'],
            'numeroFactura'     => ['required', 'unique:presupuesto_historico_cs', 'regex:/(^([0-9]+)(\d+)?$)/u'],
            'placa'             => ['required'],
            'cantLitros'        => ['required', 'regex:/(^([0-9]+)(\d+)?$)/u', 'max:10'],
            'montoFactura'      => ['required', 'numeric', "max:$PC->montoRestante", 'min:1'],
            'gasolinera'             => ['required'],
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
            'cantLitros.max'                => 'El :attribute deben ser solo 10 digitos.',   

            'montoFactura.required'         => 'El :attribute es obligatorio. ', 
            'montoFactura.min'              => 'El :attribute debe ser mínimo 1',
            'montoFactura.max'              => 'No es posible ingresar el :attribute, ya que supera el presupuesto',   
            'gasolinera.required'           => 'La :attribute es obligatoria.'
        ],[
            'fechaCreacion'                 => 'fecha de facturación',
            'numeroCupon'                   => 'número de cupón',
            'numeroFactura'                 => 'número de factura',
            'placa'                         => 'placa del vehículo',
            'cantLitros'                    => 'cantidad de litros',
            'montoFactura'                  => 'monto de la factura',  
            'gasolinera'                    => 'gasolinera'             
        ]);   
        if ($validator->passes()) { 
            
            $PC->montoRestante = $PC->montoRestante - $request->montoFactura; 
            $PC->save(); 
            $PHC = new historicoDesarrUrbanoCombus;
            $PHC->fechaCreacion =$request->fechaCreacion;
            $PHC->numeroCupon =$request->numeroCupon;
            $PHC->numeroFactura =$request->numeroFactura;
            $PHC->placa = $request->placa;
            $PHC->gasFK = $request->gasolinera;
            $PHC->cantLitros = $request->cantLitros;
            $PHC->montoFactura = $request->montoFactura; 
            $PHC->desarr_urbano_combus = $request->idDUC; 
            
            $PHC->save();
            return response()->json(['success'=>'Added new records.']);
        }
        return response()->json(['errors'=>$validator->errors()->all()]); 
    }  
    public function show(historicoDesarrUrbanoCombus $historicoDesarrUrbanoCombus)
    {
        //
    } 
    public function edit(historicoDesarrUrbanoCombus $historicoDesarrUrbanoCombus)
    {
        //
    } 
    public function update(Request $request, historicoDesarrUrbanoCombus $historicoDesarrUrbanoCombus)
    {
        //
    } 
    public function destroy(Request $request)
    {
        $presupuestoHC = historicoDesarrUrbanoCombus::find($request->idHDUC); 
        $presupuestoC = desarrUrbanoCombus::find($request->idDUC); 
        $presupuestoC->montoRestante = $presupuestoC->montoRestante + $presupuestoHC->montoFactura;
        $presupuestoC->save();
        $presupuestoHC->delete();
        return response()->json(['success'=>'Registro eliminado con éxito']);
    }
}
