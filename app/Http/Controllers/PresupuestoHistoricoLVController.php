<?php

namespace App\Http\Controllers;

use App\presupuestoHistoricoLV;
use Illuminate\Http\Request;
use App\presupuestoLavaVehi;
use App\vehiculos;
use Illuminate\Support\Facades\Validator;

class PresupuestoHistoricoLVController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
    }
    public function historicoLV($idPLV)
    {
        $presupuestoLV = presupuestoLavaVehi::find($idPLV);  
        $presupuestoHLV = presupuestoHistoricoLV::orderBy('idHLV','DESC')->where('presupuesto_lava_vehi','=',$idPLV)->paginate(20);
        //dd($presupuestoHLV);
        return view('historicoPresupuesto.presupuestoHLV.index',compact('presupuestoLV', 'presupuestoHLV'));
    } 
    public function create()
    {
    } 
    public function crear($idPLV)
    {
        $vehiculos  = vehiculos::all();
        return view('historicoPresupuesto.presupuestoHLV.create',compact('vehiculos', 'idPLV'));
    } 
    public function store(Request $request)
    {
        $PLV = presupuestoLavaVehi::find($request->idPLV);
        $validator = Validator::make($request->all(), [
            'fechaCreacion'  => ['required'],
            'placa' => ['required'],
            'numFactura'=> ['required', 'unique:presupuesto_historico_a_as','regex:/(^([0-9]+)(\d+)?$)/u'],
            'montoFactura' => ['required', 'numeric', "max:$PLV->montoRestante", 'min:1'],
        ],[
            'fechaCreacion.required'        => 'La :attribute es obligatoria. ',   
 
            'placa.required'                => 'La :attribute es obligatoria. ',  
 
            'numFactura.required'        => 'El :attribute es obligatorio. ', 
            'numFactura.unique'          => 'El :attribute que intenta agregar ya existe. ',  
            'numFactura.regex'           => 'El :attribute debe contener solo números. ',   
            
            'montoFactura.required'      => 'El :attribute es obligatorio.', 
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
            $PLV->montoRestante = $PLV->montoRestante - $request->montoFactura; 
            $PLV->save();
            $PHLV = new presupuestoHistoricoLV; 
            $PHLV->fechaCreacion =$request->fechaCreacion;
            $PHLV->placa = $request->placa;
            $PHLV->numFactura = $request->numFactura;
            $PHLV->montoFactura = $request->montoFactura; 
            $PHLV->presupuesto_lava_vehi = $request->idPLV; 
            $PHLV->save();
            return response()->json(['success'=>'Added new records.']); 
        } 
    	return response()->json(['errors'=>$validator->errors()->all()]); 
    } 
    public function show(presupuestoHistoricoLV $presupuestoHistoricoLV)
    {
    }
    public function edit(presupuestoHistoricoLV $presupuestoHistoricoLV)
    {
    }
    public function edita($idHLV)
    {
        $presupuestoHLV = presupuestoHistoricoLV::find($idHLV);
        return view('historicoPresupuesto.presupuestoHLV.edit',compact('presupuestoHLV', 'idPLV')); 
    } 
    public function update(Request $request, presupuestoHistoricoLV $presupuestoHistoricoLV)
    {
    }
    public function destroy(Request $request)
    {
        $presupuestoHLV = presupuestoHistoricoLV::find($request->idHLV);
        $presupuestoLV = presupuestoLavaVehi::find($request->idPLV); 
        $presupuestoLV->montoRestante += $presupuestoHLV->montoFactura;
        $presupuestoLV->save();
        $presupuestoHLV->delete();
        return response()->json(['success'=>'Registro eliminado con éxito']);
  
    }
}
      