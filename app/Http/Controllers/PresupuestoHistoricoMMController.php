<?php

namespace App\Http\Controllers;

use App\presupuestoHistoricoMM;
use App\presupuestoMecaMoto;
use App\vehiculos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PresupuestoHistoricoMMController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
    }
    public function historicoMM($idPMM)
    {
        $presupuestoMM = presupuestoMecaMoto::find($idPMM);
        $presupuestoHMM = presupuestoHistoricoMM::orderBy('idHMM','DESC')->where('presupuesto_meca_moto', '=', $idPMM)->get();
        return view('historicoPresupuesto.presupuestoHMM.index', compact('presupuestoMM', 'presupuestoHMM'));
    }
    public function create()
    {
    }
    public function crear($idPMM)
    {
        $vehiculos  = vehiculos::all();
        return view('historicoPresupuesto.presupuestoHMM.create',compact('vehiculos', 'idPMM')); 
    }
    public function store(Request $request)
    {
        $PMM = presupuestoMecaMoto::find($request->idPMM); 
        $validator = Validator::make($request->all(), [
            'fechaCreacion'     => ['required'],
            'placa'             => ['required'],
            'numFactura'        => ['required', 'unique:presupuesto_historico_m_ms', 'regex:/(^([0-9]+)(\d+)?$)/u'],
            'montoFactura'      => ['required', 'numeric', "max:$PMM->montoRestante", 'min:1'],
        ],[
            'fechaCreacion.required'        => 'La :attribute es obligatoria. ', 
 
            'placa.required'                => 'El :attribute es obligatoria. ',   
 
            'numFactura.required'           => 'El :attribute es obligatorio. ', 
            'numFactura.unique'             => 'El :attribute que intenta agregar ya existe. ',  
            'numFactura.regex'              => 'El :attribute debe contener solo números. ', 
            
            'montoFactura.required'         => 'El :attribute es obligatorio.', 
            'montoFactura.min'              => 'El :attribute debe ser mínimo 1',   
            'montoFactura.numeric'       => 'El :attribute debe contener solo números.',    
            'montoFactura.max'           => 'No es posible ingresar el :attribute, ya que supera el presupuesto',   
        ],[
            'fechaCreacion'                 => 'fecha de creación de la factura',
            'placa'                         => 'vehículo',
            'numFactura'                    => 'número de factura',
            'montoFactura'                  => 'monto total de la factura',              
        ]);  

        if ($validator->passes()) {
            $PMM->montoRestante = $PMM->montoRestante - $request->montoFactura; 
            $PMM->save();
            $PHMM = new presupuestoHistoricoMM; 
            $PHMM->fechaCreacion =$request->fechaCreacion;
            $PHMM->placa = $request->placa;
            $PHMM->numFactura = $request->numFactura;
            $PHMM->montoFactura = $request->montoFactura; 
            $PHMM->presupuesto_meca_moto = $request->idPMM;  
            $PHMM->save();
            return response()->json(['success'=>'Added new records.']);
        }
        return response()->json(['errors'=>$validator->errors()->all()]); 
    
    } 
    public function show(presupuestoHistoricoMM $presupuestoHistoricoMM)
    {
    } 
    public function edit(presupuestoHistoricoMM $presupuestoHistoricoMM)
    {
        //
    } 
    public function update(Request $request, presupuestoHistoricoMM $presupuestoHistoricoMM)
    {
        //
    } 
    public function destroy(Request $request)
    {
        $presupuestoHMM = presupuestoHistoricoMM::find($request->idHMM);
        $presupuestoMM = presupuestoMecaMoto::find($request->idPMM);
        $presupuestoMM->montoRestante =   $presupuestoMM->montoRestante + $presupuestoHMM->montoFactura;
        $presupuestoMM->save();
        $presupuestoHMM->delete();
        return response()->json(['success'=>'Added new records.']);
    }
}
