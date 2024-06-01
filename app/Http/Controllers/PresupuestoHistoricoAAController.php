<?php

namespace App\Http\Controllers;

use App\presupuestoHistoricoAA;
use Illuminate\Http\Request;
use App\presupuestoAireAcond;
use App\vehiculos;
use Illuminate\Support\Facades\Validator;

class PresupuestoHistoricoAAController extends Controller
{ 
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index ()
    { 
    }
    public function historicoAA($idPAA)
    {
        $presupuestoAA = presupuestoAireAcond::find($idPAA); 
        $presupuestoHAA = presupuestoHistoricoAA::orderBy('idHAA','DESC')->where('presupuesto_aire_acond','=',$idPAA)->paginate(20);
        return view('historicoPresupuesto.presupuestoHAA.index',compact('presupuestoAA', 'presupuestoHAA'));
    } 
    public function create()
    { 
    }
    public function crear($idPAA)
    {
        $vehiculos  = vehiculos::all();
        return view('historicoPresupuesto.presupuestoHAA.create',compact('vehiculos', 'idPAA'));
    } 
    public function store(Request $request)
    {
        $PAA = presupuestoAireAcond::find($request->idPAA); 
        $validator = Validator::make($request->all(), [
            'fechaCreacion'  => ['required'],
            'placa' => ['required'],
            'numFactura'=> ['required', 'unique:presupuesto_historico_a_as', 'regex:/(^([0-9]+)(\d+)?$)/u'],
            'montoFactura' => ['required', 'numeric', "max:$PAA->montoRestante", 'min:1'],
        ],[
            'fechaCreacion.required'     => 'La :attribute es obligatoria. ',  
 
            'placa.required'             => 'La :attribute es obligatoria. ',  
 
            'numFactura.required'        => 'El :attribute es obligatorio. ', 
            'numFactura.unique'          => 'El :attribute que intenta agregar ya existe. ',  
            'numFactura.regex'           => 'El :attribute debe contener solo números. ',  

            'montoFactura.required'      => 'El :attribute es obligatorio.', 
            'montoFactura.min'           => 'El :attribute debe ser mínimo 1', 
            'montoFactura.numeric'       => 'El :attribute debe contener solo números.',    
            'montoFactura.max'           => 'No es posible ingresar el :attribute, ya que supera el presupuesto',   
        ],[
            'fechaCreacion'              => 'fecha de creación de la factura',
            'placa'                      => 'vehículo',
            'numFactura'                 => 'número de factura',
            'montoFactura'               => 'monto total de la factura',             
        ]);  

        if ($validator->passes()) {   
            $PAA->montoRestante = $PAA->montoRestante - $request->montoFactura; 
            $PAA->save();
            $PHAA = new presupuestoHistoricoAA;
            $PHAA->fechaCreacion =$request->fechaCreacion;
            $PHAA->placa = $request->placa;
            $PHAA->numFactura = $request->numFactura;
            $PHAA->montoFactura = $request->montoFactura; 
            $PHAA->presupuesto_aire_acond = $request->idPAA;
            $PHAA->save();
            return response()->json(['success'=>'Added new records.']); 
        } 
    	return response()->json(['errors'=>$validator->errors()->all()]); 
    } 
    public function show(presupuestoHistoricoAA $presupuestoHistoricoAA)
    {
    } 
    public function edit($id)
    { 
    } 
    public function edita($idHAA)
    {
        $presupuestoHAA = presupuestoHistoricoAA::find($idHAA);
        return view('historicoPresupuesto.presupuestoHAA.edit',compact('presupuestoHAA', 'idPAA')); 
    } 
    public function update(Request $request, presupuestoHistoricoAA $presupuestoHistoricoAA)
    {
    } 
    public function destroy(Request $request)
    {
        $presupuestoHAA = presupuestoHistoricoAA::find($request->idHAA);
        $presupuestoAA = presupuestoAireAcond::find($request->idPAA); 
        $presupuestoAA->montoRestante += $presupuestoHAA->montoFactura;
        $presupuestoAA->save();
        $presupuestoHAA->delete();
        return response()->json(['success'=>'Registro eliminado con éxito']);
    }
}
