<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; 
use App\User;
class HomeController extends Controller
{  
    public function index() 
    {  
        if(!auth()->guest()):  
            if((auth()->user()->tipoUsuario) == 4): 
                $arrayMensajes = [];
                $arrayFiltros = $this->arrayFiltros();
                if (!session()->has('validar')): 
                    session(['validar' => '1']); 
                    if((auth()->user()->tipoUsuario) == 4):  
                        $arrayMensajes = [  
                            $this->func_PAA(),
                            $this->func_PC(),
                            $this->func_PLV(),
                            $this->func_PMC(),
                            $this->func_PMM(),
                            $this->func_PRC(),
                            $this->func_PRM()
                        ];
                    endif;
                endif;  
                return view('homeAdmin', compact('arrayMensajes', 'arrayFiltros'));
            else:
                return view('homeUser');
            endif;
        endif;
        return view('auth/login'); 
    } 
    public function func_PAA(){
        $data = DB::select("select func_PAA() as mensajePAA;"); 
        return $data[0]->mensajePAA;
    }
    public function func_PC(){
        $data = DB::select("select func_PC() as mensajePC;"); 
        return $data[0]->mensajePC;
    }
    public function func_PLV(){
        $data = DB::select("select func_PLV() as mensajePLV;"); 
        return $data[0]->mensajePLV;
    }
    public function func_PMC(){
        $data = DB::select("select func_PMC() as mensajePMC;"); 
        return $data[0]->mensajePMC;
    }
    public function func_PMM(){
        $data = DB::select("select func_PMM() as mensajePMM;"); 
        return $data[0]->mensajePMM;
    }
    public function func_PRC(){
        $data = DB::select("select func_PRC() as mensajePRC;"); 
        return $data[0]->mensajePRC;
    }
    public function func_PRM(){
        $data = DB::select("select func_PRM() as mensajePRM;"); 
        return $data[0]->mensajePRM;
    } 
    public function arrayFiltros(){
        try { 
            $mecanicaCarro = DB::table('presupuesto_meca_carros')
                            ->select('montoEstablecido', 'montoRestado AS montoRestante',
                                    DB::raw("(montoEstablecido - montoRestado) AS gastado"))
                            ->whereRaw('idPMC = (SELECT MAX(idPMC) FROM presupuesto_meca_carros)')
                            ->first();
            $mecanicaMoto = DB::table('presupuesto_meca_motos')
                            ->select('montoEstablecido', 'montoRestante',
                                DB::raw("(montoEstablecido - montoRestante) AS gastado")) 
                            ->whereRaw('idPMM = (SELECT MAX(idPMM) FROM presupuesto_meca_motos)')
                            ->first();
            $repuestoCarro = DB::table('presupuesto_r_cs')
                            ->select('montoEstablecido', 'montoRestado AS montoRestante',
                                DB::raw("(montoEstablecido - montoRestado) AS gastado")) 
                            ->whereRaw('idPRC = (SELECT MAX(idPRC) FROM presupuesto_r_cs)')
                            ->first();
            $repuestoMoto = DB::table('presupuesto_repuesto_motos')
                            ->select('montoEstablecido', 'montoRestante',
                                DB::raw("(montoEstablecido - montoRestante) AS gastado")) 
                            ->whereRaw('idPRM = (SELECT MAX(idPRM) FROM presupuesto_repuesto_motos)')
                            ->first();
            $lavado = DB::table('presupuesto_lava_vehis')
                            ->select('monto AS montoEstablecido', 'montoRestante',
                                DB::raw("(monto - montoRestante) AS gastado")) 
                            ->whereRaw('idPLV = (SELECT MAX(idPLV) FROM presupuesto_lava_vehis)')
                            ->first();
            $aireAcondicionado = DB::table('presupuesto_aire_aconds')
                            ->select('montoEstablecido', 'montoRestante',
                                DB::raw("(montoEstablecido - montoRestante) AS gastado")) 
                            ->whereRaw('idPAA = (SELECT MAX(idPAA) FROM presupuesto_aire_aconds)')
                            ->first();
            $administracionComb = DB::table('administracion_combuses')
                            ->select('montoEstablecido', 'montoRestante',
                                DB::raw("(montoEstablecido - montoRestante) AS gastado")) 
                            ->whereRaw('idAC = (SELECT MAX(idAC) FROM administracion_combuses)')
                            ->first();
            $desarrolloUrbanoComb = DB::table('desarr_urbano_combuses')
                            ->select('montoEstablecido', 'montoRestante',
                                DB::raw("(montoEstablecido - montoRestante) AS gastado")) 
                            ->whereRaw('idDUC = (SELECT MAX(idDUC) FROM desarr_urbano_combuses)')
                            ->first();
            $direccionTecnicaComb = DB::table('direccion_tecnica_combuses')
                            ->select('montoEstablecido', 'montoRestante',
                                DB::raw("(montoEstablecido - montoRestante) AS gastado")) 
                            ->whereRaw('idDTC = (SELECT MAX(idDTC) FROM direccion_tecnica_combuses)')
                            ->first();  
            $usuarios = User::count(); 
            return [
                $mecanicaCarro, $mecanicaMoto, $repuestoCarro, 
                $repuestoMoto, $lavado, $aireAcondicionado, 
                $administracionComb, $desarrolloUrbanoComb, $direccionTecnicaComb,
                $usuarios
            ];
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
    public function notificaciones(){
        return DB::select(DB::raw('select idSolicitud, id,  primerNombre, primerApellido, created_at   
                                    from solicituds
                                    where estado = "Pendiente"
                                    order by created_at desc' ));
    }
}