<?php

namespace App\Http\Controllers;

use App\presupuestoHistoricoRC;
use Illuminate\Http\Request;
use App\PresupuestoRC;
use App\vehiculos;
use Illuminate\Support\Facades\Validator;

class PresupuestoHistoricoRCController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
    } 
    public function historicoRC($idPRC)
    {
      $presupuestoRC = PresupuestoRC::find($idPRC);
      $presupuestoHRC = presupuestoHistoricoRC::orderBy('idHRC','DESC')->where('presupuesto_R_C','=',$idPRC)->get();
      return view('historicoPresupuesto.presupuestoHRC.index', compact('presupuestoRC', 'presupuestoHRC'));
    } 
    public function create()
    {
    }
    public function crear($idPRC)
    {
        $vehiculos = vehiculos::all();
        return view('historicoPresupuesto.presupuestoHRC.create', compact('vehiculos','idPRC'));
    } 
    public function store(Request $request)
    {
        $PRC = PresupuestoRC::find($request->idPRC);  
        $validator = Validator::make($request->all(), [
            'fechaCreacion'  => ['required'],
            'placa' => ['required'],
            'numFactura'=> ['required', 'unique:presupuesto_historico_r_cs', 'regex:/(^([0-9]+)(\d+)?$)/u'],
            'montoFactura' => ['required', 'numeric',"max:$PRC->montoRestado", 'min:1'],
        ],[
            'fechaCreacion.required'        => 'La :attribute es obligatoria.',  
 
            'placa.required'                => 'La :attribute es obligatoria.',   

            'numFactura.required'           => 'El :attribute es obligatorio.', 
            'numFactura.unique'             => 'El :attribute que intenta agregar ya existe.',  
            'numFactura.regex'              => 'El :attribute debe contener solo números.',   

            'montoFactura.required'         => 'El :attribute es obligatorio.', 
            'montoFactura.min'              => 'El :attribute debe ser mínimo 1',  
            'montoFactura.numeric'             => 'El :attribute debe contener solo números.',   
            'montoFactura.max'              => 'No es posible ingresar el :attribute, ya que supera el presupuesto',  
        ],[
            'fechaCreacion'                 => 'fecha de creación de la factura',
            'placa'                         => 'vehículo',
            'numFactura'                    => 'número de factura',
            'montoFactura'                  => 'monto total de la factura',              
        ]);  

        if ($validator->passes()) { 
            $PRC->montoRestado = $PRC->montoRestado - $request->montoFactura; 
            $PRC->save();
            $PHRC = new presupuestoHistoricoRC;
            $PHRC->fechaCreacion =$request->fechaCreacion;
            $PHRC->placa = $request->placa;
            $PHRC->numFactura = $request->numFactura;
            $PHRC->montoFactura = $request->montoFactura; 
            $PHRC->presupuesto_R_C = $request->idPRC; 
            $PHRC->save();
            return response()->json(['success'=>'Added new records.']); 
        } 
    	return response()->json(['errors'=>$validator->errors()->all()]);
    }

    public function show(presupuestoHistoricoRC $presupuestoHistoricoRC)
    {
    } 
    public function edit(presupuestoHistoricoRC $presupuestoHistoricoRC)
    {
    } 
    public function update(Request $request, presupuestoHistoricoRC $presupuestoHistoricoRC)
    {
    } 
    public function destroy(Request $request)
    {
        $presupuestoHRC = presupuestoHistoricoRC::find($request->idHRC);
        $presupuestoRC = presupuestoRC::find($request->idPRC); 
        $presupuestoRC->montoRestado += $presupuestoHRC->montoFactura;
        $presupuestoRC->save();
        $presupuestoHRC->delete();
        return response()->json(['success'=>'Registro eliminado con éxito']);
    }
}
