<?php

namespace App\Http\Controllers;

use App\historicoAdminiCombus;
use App\administracionCombus;
use Illuminate\Http\Request;
use App\vehiculos;
use App\gasolineras;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;
class HistoricoAdminiCombusController extends Controller
{ 
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
    } 
    public function historicoAC($idAC)
    {
        $presupuestoAC = administracionCombus::find($idAC);  
        // $presupuestoHAC = DB::select('select * from historico_admini_combuses where administracion_combus = '.$idAC);
        $presupuestoHAC = DB::table('historico_admini_combuses AS h')
                            ->select('h.idHAC', 'h.fechaCreacion', 'h.numeroCupon', 'h.numeroFactura', 'h.cantLitros', 'h.montoFactura', 'h.placa', 'g.nombre as gasolinera')
                            ->where('administracion_combus', $idAC)
                            ->join('gasolineras AS g', 'g.cedulaJuridica', 'h.gasFK')                                     
                            ->get(); 
        // dd($presupuestoHAC);
        return view('historicoPresupuesto.presupuestoHC.historicoAC.index', compact('presupuestoAC','presupuestoHAC'));
    }
    public function create()
    {
        //
    } 
    public function crear($idAC)
    {
        $vehiculos  = vehiculos::all(); 
        $gasolineras  = gasolineras::all(); 
        return view('historicoPresupuesto.presupuestoHC.historicoAC.create',compact('vehiculos', 'idAC', 'gasolineras'));
    } 
    public function store(Request $request)
    {
        
        $PC = administracionCombus::find($request->idAC); 
        $validator = Validator::make($request->all(), [
            'fechaCreacion'     => ['required'],
            'numeroCupon'       => ['required', 'unique:presupuesto_historico_cs', 'regex:/(^([0-9]+)(\d+)?$)/u'],
            'numeroFactura'     => ['required', 'unique:presupuesto_historico_cs', 'regex:/(^([0-9]+)(\d+)?$)/u'],
            'placa'             => ['required'],
            'gasolinera'             => ['required'],
            'cantLitros'        => ['required', 'regex:/(^([0-9]+)(\d+)?$)/u', 'max:10'],
            'montoFactura'      => ['required', 'numeric', "max:$PC->montoRestante", 'min:1'],
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

            'gasolinera.required'            => 'La :attribute es obligatoria.'
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
            $PHC = new historicoAdminiCombus;
            $PHC->fechaCreacion =$request->fechaCreacion;
            $PHC->numeroCupon =$request->numeroCupon;
            $PHC->numeroFactura =$request->numeroFactura;
            $PHC->placa = $request->placa;
            $PHC->gasFK = $request->gasolinera;
            $PHC->cantLitros = $request->cantLitros;
            $PHC->montoFactura = $request->montoFactura; 
            $PHC->administracion_combus = $request->idAC; 
            
            $PHC->save();
            return response()->json(['success'=>'Added new records.']);
        }
        return response()->json(['errors'=>$validator->errors()->all()]); 
    } 
    public function show(historicoAdminiCombus $historicoAdminiCombus)
    {
        //
    } 
    public function edit(historicoAdminiCombus $historicoAdminiCombus)
    {
        // 
    }
    public function update(Request $request, historicoAdminiCombus $historicoAdminiCombus)
    {
        //
    } 
    public function destroy(Request $request)
    {
        $presupuestoHC = historicoAdminiCombus::find($request->idHAC); 
        $presupuestoC = administracionCombus::find($request->idAC); 
        $presupuestoC->montoRestante = $presupuestoC->montoRestante + $presupuestoHC->montoFactura;
        $presupuestoC->save();
        $presupuestoHC->delete();
        return response()->json(['success'=>'Registro eliminado con éxito']);
    }
}
