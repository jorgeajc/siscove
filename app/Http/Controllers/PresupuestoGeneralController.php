<?php

namespace App\Http\Controllers;
use App\PresupuestoRC;
use App\presupuestoMecaCarro;
use App\presupuestoGeneral;
use App\presupuestoAireAcond;
use App\presupuestoLavaVehi;
use App\presupuestoCombustible;
use App\presupuestoMecaMoto;
use App\presupuestoRepuestoMoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PresupuestoGeneralController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
    }
    public function inicio()
    { 
        
        $presupuestoPC = DB::table('presupuesto_combustibles as C')
                        ->select('C.idPC', 'C.fechaRegistro', 'C.montoEstablecido', 'C.montoRestante',
                                DB::raw('count(HC.idHC) as cantFact'))
                        ->leftjoin('presupuesto_historico_cs as HC', 'HC.presupuesto_combustible', 'C.idPC' )
                        ->groupBy('C.idPC',  'C.fechaRegistro', 'C.montoEstablecido', 'C.montoRestante')
                        ->get();
        //dd($presupuestoPC);
        $presupuestoMC = DB::table('presupuesto_meca_carros as MC')
                        ->select('MC.idPMC', 'MC.fechaRegistro', 'MC.montoEstablecido', 'MC.montoRestado',
                            DB::raw('count(HMC.idHMC) as cantFact'))
                        ->leftjoin('presupuesto_historico_m_cs as HMC', 'HMC.presupuesto_meca_carro', 'MC.idPMC' )
                        ->groupBy('MC.idPMC',  'MC.fechaRegistro', 'MC.montoEstablecido', 'MC.montoRestado')
                        ->get();
        //dd($presupuestoMC); 
        $presupuestoMM = DB::table('presupuesto_meca_motos as MM')
                        ->select('MM.idPMM', 'MM.fechaRegistro', 'MM.montoEstablecido', 'MM.montoRestante',
                            DB::raw('count(HMM.idHMM) as cantFact'))
                        ->leftjoin('presupuesto_historico_m_ms as HMM', 'HMM.presupuesto_meca_moto', 'MM.idPMM' )
                        ->groupBy('MM.idPMM',  'MM.fechaRegistro', 'MM.montoEstablecido', 'MM.montoRestante')
                        ->get();
        //dd($presupuestoMM);         
        $presupuestoRC = DB::table('presupuesto_r_cs as RC')
                        ->select('RC.idPRC', 'RC.fechaRegistro', 'RC.montoEstablecido', 'RC.montoRestado',
                            DB::raw('count(HRC.idHRC) as cantFact'))
                        ->leftjoin('presupuesto_historico_r_cs as HRC', 'HRC.presupuesto_R_C', 'RC.idPRC' )
                        ->groupBy('RC.idPRC',  'RC.fechaRegistro', 'RC.montoEstablecido', 'RC.montoRestado')
                        ->get();
        //dd($presupuestoRC);                
        $presupuestoRM = DB::table('presupuesto_repuesto_motos as RM')
                        ->select('RM.idPRM', 'RM.fechaRegistro', 'RM.montoEstablecido', 'RM.montoRestante',
                            DB::raw('count(HRM.idHRM) as cantFact'))
                        ->leftjoin('presupuesto_historico_rep_motos as HRM', 'HRM.presu_rep_moto', 'RM.idPRM' )
                        ->groupBy('RM.idPRM',  'RM.fechaRegistro', 'RM.montoEstablecido', 'RM.montoRestante')
                        ->get();
        //dd($presupuestoRM);                 
        $presupuestoAA = DB::table('presupuesto_aire_aconds as AA')
                        ->select('AA.idPAA', 'AA.fechaRegistro', 'AA.montoEstablecido', 'AA.montoRestante',
                            DB::raw('count(HAA.idHAA) as cantFact'))
                        ->leftjoin('presupuesto_historico_a_as as HAA', 'HAA.presupuesto_aire_acond', 'AA.idPAA' )
                        ->groupBy('AA.idPAA',  'AA.fechaRegistro', 'AA.montoEstablecido', 'AA.montoRestante')
                        ->get();
        //dd($presupuestoAA);                 
        $presupuestoLV = DB::table('presupuesto_lava_vehis as LV')
                        ->select('LV.idPLV', 'LV.fecha', 'LV.monto', 'LV.montoRestante',
                            DB::raw('count(HLV.idHLV) as cantFact'))
                        ->leftjoin('presupuesto_historico_l_vs as HLV', 'HLV.presupuesto_lava_vehi', 'LV.idPLV' )
                        ->groupBy('LV.idPLV',  'LV.fecha', 'LV.monto', 'LV.montoRestante')
                        ->get();
        //dd($presupuestoLV);
        $presupuestoAC = DB::table('administracion_combuses as AC')
                        ->select('AC.idAC', 'AC.fechaRegistro', 'AC.montoEstablecido', 'AC.montoRestante',
                             DB::raw('count(HAC.idHAC) as cantFact'))
                        ->leftjoin('historico_admini_combuses as HAC', 'HAC.administracion_combus', 'AC.idAC' )
                        ->groupBy('AC.idAC',  'AC.fechaRegistro', 'AC.montoEstablecido', 'AC.montoRestante')
                        ->get();  
        //dd($presupuestoAC);                      
        $presupuestoDUC = DB::table('desarr_urbano_combuses as DUC')
                        ->select('DUC.idDUC', 'DUC.fechaRegistro', 'DUC.montoEstablecido', 'DUC.montoRestante',
                             DB::raw('count(HDUC.idHDUC) as cantFact'))
                        ->leftjoin('historico_desarr_urbano_combuses as HDUC', 'HDUC.desarr_urbano_combus', 'DUC.idDUC' )
                        ->groupBy('DUC.idDUC',  'DUC.fechaRegistro', 'DUC.montoEstablecido', 'DUC.montoRestante')
                        ->get();  
        //  dd($presupuestoDUC);
        $presupuestoDTC = DB::table('direccion_tecnica_combuses as DTC')
                        ->select('DTC.idDTC', 'DTC.fechaRegistro', 'DTC.montoEstablecido', 'DTC.montoRestante',
                             DB::raw('count(HDTC.idHDTC) as cantFact'))
                        ->leftjoin('historico_direccion_tecnica_combuses as HDTC', 'HDTC.direc_tec_combus', 'DTC.idDTC' )
                        ->groupBy('DTC.idDTC',  'DTC.fechaRegistro', 'DTC.montoEstablecido', 'DTC.montoRestante')
                        ->get();   
        //dd($presupuestoDTC);
        return view('presupuestos.inicio',compact('presupuestoAA', 'presupuestoMC', 'presupuestoRC',
                                                  'presupuestoLV', 'presupuestoPC', 'presupuestoMM','presupuestoRM',
                                                  'presupuestoAC', 'presupuestoDUC', 'presupuestoDTC'));  
    } 
    public function create()
    {
        return view('presupuestos.presupuestoGeneral.create');
    } 
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'montoEstablecido'  => ['required'],
            'fechaRegistro' => ['required'], 
        ],[
            'montoEstablecido.required'               => 'La :attribute es obligatorio.',  

            'fechaRegistro.required'     => 'El :attribute es obligatorio.', 
        ],[
            'montoEstablecido'                => 'monto inicial',
            'fechaRegistro'      => 'fecha de ingreso del monto',           
        ]);   
        if ($validator->passes()) {
            $presuG = new presupuestoGeneral;

            $presuG->montoEstablecido =$request->montoEstablecido;
            $presuG->fechaRegistro = $request->fechaRegistro; 
            $presuG->montoRestante = $request->montoEstablecido;
            $presuG->save();
            return response()->json(['success'=>'Added new records.']);

        } 
    	return response()->json(['errors'=>$validator->errors()->all()]); 
    } 
    public function show(presupuestoGeneral $presupuestoGeneral)
    {
        //
    } 
    public function edit($idPG)
    {
        $presupuestoG = presupuestoGeneral::find($idPG);
        return view('presupuestos.presupuestoGeneral.edit',compact('presupuestoG'));
    } 
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'montoEstablecido'  => ['required'], 
        ],[
            'montoEstablecido.required'               => 'La :attribute es obligatorio.',   
        ],[
            'montoEstablecido'                => 'monto inicial',       
        ]);   
        if ($validator->passes()) {
            $presuG = presupuestoGeneral::find($request->idPG);

            $presuG->montoEstablecido =$request->montoEstablecido;
            $presuG->fechaRegistro = $request->fechaRegistro; 
            $presuG->montoRestante = $presuG->montoRestante;
            $presuG->save();
            return response()->json(['success'=>'Added new records.']);

        } 
    	return response()->json(['errors'=>$validator->errors()->all()]); 
    }  
    public function destroy($idPG)
    {
        $presuG = presupuestoGeneral::find($idPG);
        $presuG->delete();
        return response()->json(['success'=>'Registro eliminado con éxito']);
    }
}
