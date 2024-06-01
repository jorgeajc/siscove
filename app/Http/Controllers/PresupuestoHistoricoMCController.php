<?php

namespace App\Http\Controllers;

use App\presupuestoHistoricoMC;
use Illuminate\Http\Request;
use App\presupuestoMecaCarro;
use App\vehiculos;
use Illuminate\Support\Facades\Validator;
class PresupuestoHistoricoMCController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 
    public function index()
    {
    }
    public function historicoMC($idPMC)
    {
        $presupuestoMC = presupuestoMecaCarro::find($idPMC);
        $presupuestoHMC = presupuestoHistoricoMC::orderBy('idHMC','DESC')->where('presupuesto_meca_carro','=',$idPMC)->get();
        return view('historicoPresupuesto.presupuestoHMC.index',compact('presupuestoMC', 'presupuestoHMC'));
    }
    public function create()
    {
    }
    public function crear($idPMC)
    {
        $vehiculos  = vehiculos::all();
        return view('historicoPresupuesto.presupuestoHMC.create',compact('vehiculos', 'idPMC'));
    }
    public function store(Request $request)
    {
        $PMC = presupuestoMecaCarro::find($request->idPMC);  
        $validator = Validator::make($request->all(), [
            'fechaCreacion'     => ['required'],
            'placa'             => ['required'],
            'numFactura'        => ['required', 'unique:presupuesto_historico_m_cs', 'regex:/(^([0-9]+)(\d+)?$)/u'],
            'montoFactura'      => ['required', 'numeric', "max:$PMC->montoRestado", 'min:1'],
        ],[
            'fechaCreacion.required'        => 'La :attribute es obligatoria. ', 
 
            'placa.required'                => 'El :attribute es obligatoria. ',   
 
            'numFactura.required'           => 'El :attribute es obligatorio. ', 
            'numFactura.unique'             => 'El :attribute que intenta agregar ya existe. ',  
            'numFactura.regex'              => 'El :attribute debe contener solo números. ',  

            'montoFactura.required'         => 'El :attribute es obligatorio.', 
            'montoFactura.min'              => 'El :attribute debe ser mínimo 1',
            'montoFactura.numeric'          => 'El :attribute debe contener solo números.',    
            'montoFactura.max'              => 'No es posible ingresar el :attribute, ya que supera el presupuesto',   
        ],[
            'fechaCreacion'                 => 'fecha de creación de la factura',
            'placa'                         => 'vehículo',
            'numFactura'                    => 'número de factura',
            'montoFactura'                  => 'monto total de la factura',              
        ]);  

        if ($validator->passes()) {
            $PMC->montoRestado = $PMC->montoRestado - $request->montoFactura; 
            $PMC->save();

            $PHMC = new presupuestoHistoricoMC; 
            $PHMC->fechaCreacion =$request->fechaCreacion;
            $PHMC->placa = $request->placa;
            $PHMC->numFactura = $request->numFactura;
            $PHMC->montoFactura = $request->montoFactura; 
            $PHMC->presupuesto_meca_carro = $request->idPMC; 
            $PHMC->save();
            return response()->json(['success'=>'Added new records.']);
        }
        return response()->json(['errors'=>$validator->errors()->all()]); 
    } 
    public function show(presupuestoHistoricoMC $presupuestoHistoricoMC)
    {
    }
    public function edit(presupuestoHistoricoMC $presupuestoHistoricoMC)
    {
        //
    } 
    public function update(Request $request, presupuestoHistoricoMC $presupuestoHistoricoMC)
    {
    }
    public function destroy(Request $request)
    { 
        $presupuestoHMC = presupuestoHistoricoMC::find($request->idHMC);
        $presupuestoMC = presupuestoMecaCarro::find($request->idPMC);
        $presupuestoMC->montoRestado =   $presupuestoMC->montoRestado + $presupuestoHMC->montoFactura;
        $presupuestoMC->save();
        $presupuestoHMC->delete();
        return response()->json(['success'=>'Added new records.']); 
    }
}
