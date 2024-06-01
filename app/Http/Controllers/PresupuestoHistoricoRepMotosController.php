<?php

namespace App\Http\Controllers;

use App\presupuestoHistoricoRepMotos;
use App\presupuestoRepuestoMoto;
use App\vehiculos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PresupuestoHistoricoRepMotosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
    }
    public function historicoRM($idPRM)
    {
        $presupuestoRM = presupuestoRepuestoMoto::find($idPRM);
        $presupuestoHRM = presupuestoHistoricoRepMotos::orderBy('idHRM','DESC')->where('presu_rep_moto','=', $idPRM)->get();
        return view('historicoPresupuesto.presupuestoHRM.index', compact('presupuestoRM','presupuestoHRM'));
    }
    public function create()
    {
    }
    public function crear($idPRM)
    {
        $vehiculos  = vehiculos::all();
        return view('historicoPresupuesto.presupuestoHRM.create',compact('vehiculos', 'idPRM'));
    }
    public function store(Request $request)
    {
        $PRM = presupuestoRepuestoMoto::find($request->idPRM); 
        $validator = Validator::make($request->all(), [
            'fechaCreacion'     => ['required'],
            'placa'             => ['required'],
            'numFactura'        => ['required', 'unique:presupuesto_historico_rep_motos', 'regex:/^\d+(\.\d{1,2})?$/'],
            'montoFactura'      => ['required', 'numeric', "max:$PRM->montoRestante", 'min:1'],
        ],[
            'fechaCreacion.required'        => 'La :attribute es obligatoria.',  
 
            'placa.required'                => 'El :attribute es obligatoria.',  
 
            'numFactura.required'           => 'El :attribute es obligatorio.', 
            'numFactura.unique'             => 'El :attribute que intenta agregar ya existe.',  
            'numFactura.regex'              => 'El :attribute debe contener solo números.',   

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
                $PRM->montoRestante = $PRM->montoRestante - $request->montoFactura; 
                $PRM->save();
                
                $PHRM = new presupuestoHistoricoRepMotos; 
                $PHRM->fechaCreacion =$request->fechaCreacion;
                $PHRM->placa = $request->placa;
                $PHRM->numFactura = $request->numFactura;
                $PHRM->montoFactura = $request->montoFactura; 
                $PHRM->presu_rep_moto = $request->idPRM; 
                $PHRM->save();
                return response()->json(['success'=>'Added new records.']); 
        }
        return response()->json(['errors'=>$validator->errors()->all()]);  
    }

    public function show(presupuestoHistoricoRepMotos $presupuestoHistoricoRepMotos)
    {
        //
    }

    public function edit(presupuestoHistoricoRepMotos $presupuestoHistoricoRepMotos)
    {
        //
    }

    public function update(Request $request, presupuestoHistoricoRepMotos $presupuestoHistoricoRepMotos)
    {
        //
    }

    public function destroy(Request $request)
    {
        $presupuestoHRM = presupuestoHistoricoRepMotos::find($request->idHRM);
        $presupuestoRM = presupuestoRepuestoMoto::find($request->idPRM);
        $presupuestoRM->montoRestante = $presupuestoRM->montoRestante + $presupuestoHRM->montoFactura;
        $presupuestoRM->save();
        $presupuestoHRM->delete();
        return response()->json(['success'=>'Added new records.']);
    }
}
