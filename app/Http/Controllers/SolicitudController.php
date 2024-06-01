<?php

namespace App\Http\Controllers;

use App\solicitud;
use App\User;
use App\vehiculos;
use App\Mail\solicitudMail;
use App\Mail\solicitudMailRetu;

use Illuminate\Http\Request;
use App\Http\Requests\SolicitudRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use Carbon\Carbon;
use PDF;
class SolicitudController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    { 
        $Tsolicitud = DB::table('solicituds AS S')
                    ->select('S.idSolicitud' , 'S.id', 'S.telefono',  'S.estado', 'S.created_at', 'S.descripcion','S.destino',
                    DB::raw("CONCAT(U.primerNombre, ' ', if(U.segundoNombre is null, '', U.segundoNombre), ' ', U.primerApellido, ' ', U.segundoApellido) AS solicitante"),
                    DB::raw("CONCAT(S.fechaEntrega, ' ', S.horaEntrega) AS fechaEntrega"),
                    DB::raw("CONCAT(S.fechaDevolucion, ' ', S.horaDevolucion) AS fechaDevolucion"))
                    ->join('users AS U', 'U.id', 'S.id')
                    ->get(); 
        
        $solicitud = $Tsolicitud->where('estado',"Pendiente"); 
        $solicitudTotal = $Tsolicitud->where('estado','!=',"Pendiente")->count();   
        return view('solicitud.index', compact('solicitud', 'solicitudTotal'));
    }
    public function myIndex()
    {
        $filtros = DB::table('solicituds as s')
                    ->select(
                        Db::raw('sum((select IFNULL(count(users.id), 0)
                                    FROM users 
                                    WHERE s.id = users.id)) as cantidadT'
                        ),
                        Db::raw('sum((select IFNULL(count(users.id), 0)
                                        FROM users 
                                        WHERE s.id = users.id and s.estado = "Pendiente")) as cantidadP'
                        ),
                        Db::raw('sum((select IFNULL(count(users.id), 0)
                                        FROM users 
                                        WHERE s.id = users.id and s.estado = "Aceptada")) as cantidadA'
                        ),
                        Db::raw('sum((select IFNULL(count(users.id), 0)
                                        FROM users 
                                        WHERE s.id = users.id and s.estado = "Rechazada")) as cantidadR'
                        )
                    )  
                    ->where("s.id", auth()->user()->id)
                    ->first();  
        $solicitud = solicitud::select('idSolicitud', 'id', 'telefono',  'estado', 'created_at', 'descripcion','destino',
                                DB::raw("CONCAT(fechaEntrega, ' ', horaEntrega) AS fechaEntrega"),
                                DB::raw("CONCAT(fechaDevolucion, ' ', horaDevolucion) AS fechaDevolucion"))
                            ->where("id", auth()->user()->id) 
                            ->get();       
        return view('solicitud.misSolicitudesIndex', compact('solicitud', 'filtros'));
    }
    public function aceptadoRechazado()
    {
        $solicitudes = DB::table('solicituds AS S')
                        ->select('S.idSolicitud' , 'S.id', 'S.telefono',  'S.estado', 'S.created_at', 'S.descripcion','S.destino',
                            DB::raw("CONCAT(U.primerNombre, ' ', if(U.segundoNombre is null, '', U.segundoNombre), ' ', U.primerApellido, ' ', U.segundoApellido) AS solicitante"),
                            DB::raw("CONCAT(S.fechaEntrega, ' ', S.horaEntrega) AS fechaEntrega"),
                            DB::raw("CONCAT(S.fechaDevolucion, ' ', S.horaDevolucion) AS fechaDevolucion"))
                        ->join('users AS U', 'U.id', 'S.id')
                        ->get(); 
        $aceptada = $solicitudes->where('estado','=',"Aceptada");
        $rechazada = $solicitudes->where('estado','=',"Rechazada");
        
        $solicitudTotal = $solicitudes->where('estado','!=',"Pendiente"); 
        $solicitudAceptada = $solicitudes->where('estado','=',"Aceptada"); 
        $solicitudRechazada = $solicitudes->where('estado','=',"Rechazada"); 

        return view('solicitud.aceptadoRechazado',compact('aceptada','rechazada', 'solicitudAceptada', 'solicitudRechazada', 'solicitudTotal'));
    }
    public function aceptar(Request $request)
    {
        $validarSolicitud = solicitud::select('idSolicitud', 'placa', 'estado', 'fechaEntrega', 'fechaDevolucion',
                                                DB::raw("CONCAT(fechaEntrega, ' ', horaEntrega) AS fechaE"),
                                                DB::raw("CONCAT(fechaDevolucion, ' ', horaDevolucion) AS fechaD"))
                                    ->where('placa', $request->placa)
                                    ->where('estado', 'Aceptada') 
                                    ->where('idSolicitud', '!=', $request->idSolicitud)
                                    ->where(function($query) use ($request){
                                        return $query->where(function($query) use ($request){
                                            return $query->where('fechaEntrega', '<=', $request->fechaEntrega)
                                                    ->where('fechaDevolucion', '>=', $request->fechaEntrega);
                                        })
                                        ->orWhere(function($query) use ($request){
                                            return $query->where('fechaEntrega', '<=', $request->fechaDevolucion)
                                                    ->where('fechaDevolucion', '>=', $request->fechaDevolucion);
                                        });
                                    }) 
                                    ->get();   
       
        if(!$validarSolicitud->isEmpty()): 
            $fechaEntrega       = $request->fechaEntrega . ' ' . $request->horaEntrega;
            $fechaDevolucion    = $request->fechaDevolucion . ' ' . $request->horaDevolucion; 
            foreach ($validarSolicitud as $key => $value): 
                if(($value->fechaE <= $fechaEntrega && $fechaEntrega <= $value->fechaD) 
                    || 
                    ($value->fechaE <= $fechaDevolucion && $fechaDevolucion <= $value->fechaD)):  
                    return response()->json(['errors'=>'Ya existe otra solicitud que coincide con el rango de fecha solicitada para el vehículo '. $request->placa]); 
                endif;   
            endforeach; 
        endif; 
        $solicitud = solicitud::find($request->idSolicitud);
        $solicitud->estado = "Aceptada";
        $solicitud->placa = $request->placa;
        $solicitud->conductor = $request->conductor;
        $solicitud->save();
        $this->emailRet($solicitud);
        return response()->json(['success'=>'Creado con éxito']); 
    }
    public function rechazar($idSolicitud)
    {
        $solicitud = solicitud::find($idSolicitud);
        $solicitud->estado = "Rechazada"; 
        $solicitud->save(); 
        $this->emailRet($solicitud); 
        return response()->json(['success'=>'Added new records.']);
    } 
    public function cancelar(Request $request)
    { 
        $solicitud = solicitud::find($request->solicitud);  
        if($solicitud->estado == 'Pendiente'){
            $solicitud->estado = "Cancelada"; 
            $solicitud->save(); 
             
            return response()->json(['success'=>'Added new records.']); 
        }  
        return response()->json(['errors'=>'Esta solicitud ya ha sido procesada.']); 
    }
    public function create()
    {  
        $user = Auth::user();
        $id = Auth::id();
        $usuarios = \DB::table('users as Users')
                        ->select('Users.id','Users.primerNombre','Users.segundoNombre','Users.primerApellido','Users.segundoApellido', 'Users.telefono', 'Users.email',
                        'departamentos.nombreDeparta as departamento', 'talleres.nombre as taller', 'gasolineras.Nombre as gasolinera')
                        ->leftjoin('departamentos', 'departamentos.id', '=', 'Users.descripcion')
                        ->leftjoin('talleres', 'talleres.CedulaJuridica', '=', 'Users.descripcion')
                        ->leftjoin('gasolineras', 'gasolineras.cedulaJuridica', '=', 'Users.descripcion')
                        ->where('Users.id','=',$id)
                        ->get();
 
        return view('solicitud.create', compact('usuarios'));
        
    } 
    public function store(Request $request)
    { 
        $validator = validator::make($request->all(),[
            'telefono' => ['required'],
            'email' => ['required'],
            'descripcion' => ['required'],
            'destino' => ['required'],
            'numPersonas' => ['required'],
            'fechaEntrega' => ['required'],
            'horaEntrega' => ['required'],
            'fechaDevolucion' => ['required'],
            'horaDevolucion' => ['required'],
            'NecesitaConduc' => [''],
        ],[
            
            'telefono.required' => 'El :attribute es obligatorio. ',

            'email.required' => 'El :attribute es obligatorio. ',

            'descripcion.required' => 'El :attribute es obligatorio. ',

            'destino.required' => 'El :attribute es obligatorio. ',

            'numPersonas.required' => 'El :attribute es obligatorio. ',

            'fechaEntrega.required' => 'La :attribute es obligatoria. ',

            'horaEntrega.required' => 'La :attribute es obligatoria. ',

            'fechaDevolucion.required' => 'La :attribute es obligatoria. ',

            'horaDevolucion.required' => 'La :attribute es obligatoria. ',

            //'placa.required' => 'La :attribute es obligatoria. ',
        ],[
            'telefono' => 'teléfono',
            'email' => 'correo electrónico',
            'descripcion' => 'motivo del viaje',
            'destino' => 'detino del viaje',
            'numPersonas' => 'número de personas',
            'fechaEntrega' => 'fecha de entrega',
            'horaEntrega' => 'hora de entrega',
            'fechaDevolucion' => 'fecha de devolución',
            'horaDevolucion' => 'hora de devolución', 
        ]);
        if ($validator->passes()) {  
            $solicitud = new solicitud;

            $usuario = User::find($request->id);

            $solicitud->id = $usuario->id;
            $solicitud->primerNombre = $usuario->primerNombre;
            $solicitud->segundoNombre = $usuario->segundoNombre;
            $solicitud->primerApellido = $usuario->primerApellido;
            $solicitud->segundoApellido = $usuario->segundoApellido; 
            $solicitud->departamento = $request->departamento;
            $solicitud->telefono = $request->telefono;
            $solicitud->email = $request->email;
            $solicitud->descripcion = $request->descripcion;
            $solicitud->destino = $request->destino;
            $solicitud->numPersonas = $request->numPersonas; 
            $solicitud->fechaEntrega =  $request->fechaEntrega;
            $solicitud->horaEntrega =  $request->horaEntrega;
            $solicitud->fechaDevolucion =  $request->fechaDevolucion;
            $solicitud->horaDevolucion =  $request->horaDevolucion;
            $solicitud->estado = "Pendiente"; 
            $solicitud->NecesitaConduc = $request->NecesitaConduc == "si" ? true : false ;
            $solicitud->save();
            $this->email($request);
            return response()->json(['success'=>'Registro Agregado Correctamente']); 
        } 
        else{
            return response()->json(['errors'=>$validator->errors()->all()]);
        } 
    } 
    public function show($idSolicitud)
    { 
        $solicitudB = solicitud::find($idSolicitud); 
        return view('solicitud.show', compact('solicitudB'));
    }
    public function myShow($idSolicitud)
    {  
        $solicitudB = DB::table('solicituds as s')
                        ->select("s.idSolicitud", "s.id", "s.primerNombre", "s.segundoNombre", "s.primerApellido", "s.segundoApellido", "s.departamento", "s.telefono", "s.email",
                                "s.descripcion", "s.destino", "s.numPersonas", "s.fechaEntrega", "s.horaEntrega", "s.fechaDevolucion", "s.horaDevolucion", "s.estado",
                                "s.NecesitaConduc", "s.placa", DB::raw('CONCAT(s.conductor, " ",u.primerNombre, " ",u.primerApellido) as nombreC')
                        )
                        ->leftjoin('users as u', 'u.id', 's.conductor')
                        ->where('s.idSolicitud', $idSolicitud)
                        ->first();  
        return view('solicitud.misSolicitudesShow', compact('solicitudB'));
    }
    public function formAceptadasRechazadas($idSolicitud)
    { 
        $solicitudB = solicitud::find($idSolicitud); 
        return view('solicitud.formAceptadasRechazadas', compact('solicitudB'));
    }
    public function edit($solicitud)
    {
        $user = Auth::user();
        $id = Auth::id(); 
        $solicitud = \DB::table('users as U')
                        ->select('U.id','U.primerNombre','U.segundoNombre','U.primerApellido','U.segundoApellido', 'U.telefono', 'U.email', 
                                'd.nombreDeparta as departamento',
                                's.idSolicitud', 's.descripcion', 's.destino', 's.numPersonas', 's.fechaEntrega', 's.horaEntrega', 's.fechaDevolucion' , 's.horaDevolucion' , 's.NecesitaConduc') 
                        ->leftjoin('departamentos as d', 'd.id', '=', 'U.descripcion') 
                        ->join('solicituds as s', 's.id', '=', 'U.id')
                        ->where('s.idSolicitud','=',$solicitud) 
                        ->first();  
        return view('solicitud.edit', compact('solicitud'));
    } 
    public function update(Request $request)
    { 
        $validator = validator::make($request->all(),[ 
            'descripcion' => ['required'],
            'destino' => ['required'],
            'numPersonas' => ['required'],
            'fechaEntrega' => ['required'],
            'horaEntrega' => ['required'],
            'fechaDevolucion' => ['required'],
            'horaDevolucion' => ['required'],
            'NecesitaConduc' => ['required'],
        ],[ 
            'descripcion.required' => 'El :attribute es obligatorio. ', 
            'destino.required' => 'El :attribute es obligatorio. ', 
            'numPersonas.required' => 'El :attribute es obligatorio. ', 
            'fechaEntrega.required' => 'La :attribute es obligatoria. ', 
            'horaEntrega.required' => 'La :attribute es obligatoria. ', 
            'fechaDevolucion.required' => 'La :attribute es obligatoria. ', 
            'horaDevolucion.required' => 'La :attribute es obligatoria. ', 
        ],[ 
            'descripcion' => 'motivo del viaje',
            'destino' => 'detino del viaje',
            'numPersonas' => 'número de personas',
            'fechaEntrega' => 'fecha de entrega',
            'horaEntrega' => 'hora de entrega',
            'fechaDevolucion' => 'fecha de devolución',
            'horaDevolucion' => 'hora de devolución', 
        ]);
        if ($validator->passes()) {  
            $solicitud = solicitud::find($request->idSoli); 
            if($solicitud->estado == 'Pendiente'){
                $solicitud->descripcion = $request->descripcion;
                $solicitud->destino = $request->destino;
                $solicitud->numPersonas = $request->numPersonas; 
                $solicitud->fechaEntrega =  $request->fechaEntrega;
                $solicitud->horaEntrega =  $request->horaEntrega;
                $solicitud->fechaDevolucion =  $request->fechaDevolucion;
                $solicitud->horaDevolucion =  $request->horaDevolucion; 
                $solicitud->NecesitaConduc = $request->NecesitaConduc == "si" ? true : false ; 
                $solicitud->save(); 
                return response()->json(['success'=>'Registro Agregado Correctamente']); 
            } 
            return response()->json(['errors'=>['Esta solicitud ya ha sido procesada.']]); 
            
        } else {
            return response()->json(['errors'=>$validator->errors()->all()]);
        } 
    } 
    public function destroy(solicitud $solicitud)
    {
        //
    }
    public function buscarVehiculos($cantidad)
    { 
        return vehiculos::select('placa', 'marca', 'modelo', 'tipo')
                        ->where('cantidadAsientos', '>=', $cantidad)
                        ->where('estado', 'Activo')
                        ->get();
    }
    public function buscarConductoresDisponibles($placa){
        return \DB::table('users')
                ->select('users.id', 'users.primerNombre', 'users.primerApellido', 'users.segundoApellido')  
                ->where('estado', 'Activo') 
                ->where(function($q) {
                    $q->where('roles.name', "Conductor")
                    ->orWhere('roles.name', "Administrador")
                    ->orWhere('roles.name', "Coordinador")
                    ->orWhere('roles.name', "Inspector");
                })
                ->join('roles','roles.id','=','users.tipoUsuario')
                ->join('licencias as li', 'li.user', 'users.id')
                ->groupBy('users.id', 'users.primerNombre', 'users.primerApellido', 'users.segundoApellido')
                ->get();
                //->toSql();
    }
    public function email(Request $request)
    {
        $email = new \stdClass();
        $usuario = User::find($request->id);
        $email->cedula = $usuario->id; 
        $email->nombreSolicitante = $usuario->primerNombre . ' ' . $usuario->segundoNombre . ' ' . $usuario->primerApellido . ' ' . $usuario->segundoApellido;   
        $email->email = $usuario->email;
        
        $email->departamento = $request->departamento; 
        $email->telefono = $request->telefono;   
        $email->motivo = $request->descripcion;
        $email->vehiculo = $request->placa;
        $email->destino = $request->destino;
        $email->numPersonas = $request->numPersonas;
        $email ->fechaEntrega = $request->fechaEntrega;
        $email ->horaEntrega = $request->horaEntrega;
        $email ->fechaDevolucion = $request->fechaDevolucion;
        $email ->horaDevolucion = $request->horaDevolucion;
        \Mail::to("siscovesg@gmail.com")->send(new solicitudMail($email)); 
    }
    public function emailRet(solicitud $solicitud){
        $email = new \stdClass();
  
        $email->nombreSolicitante = $solicitud->primerNombre . ' ' . $solicitud->segundoNombre . ' ' . $solicitud->primerApellido . ' ' . $solicitud->segundoApellido;   
        $email->email = $solicitud->email; 
        $email->departamento = $solicitud->departamento;
        
        
        $email->motivo = $solicitud->descripcion;
        $email->destino = $solicitud->destino;
        $email->numPersonas = $solicitud->numPersonas;
            
        $email->fechaEntrega = $solicitud->fechaEntrega;
        $email->horaEntrega = $solicitud->horaEntrega;
        $email->fechaDevolucion = $solicitud->fechaDevolucion;
        $email->horaDevolucion = $solicitud->horaDevolucion;
         
        $email->fechaCreacion = $solicitud->created_at;

        $email->estado = $solicitud->estado;
        \Mail::to($email->email)->send(new solicitudMailRetu($email)); 
    }
    public function printPDF($id)
    { 
        $solicitud = solicitud::find($id); 
       $data = [
            "id" => $solicitud->id,
            "primerNombre" => $solicitud->primerNombre,
            "segundoNombre" => $solicitud->segundoNombre,
            "primerApellido" => $solicitud->primerApellido,
            "segundoApellido" => $solicitud->segundoApellido,
            "departamento" => $solicitud->departamento,
            "telefono" => $solicitud->telefono,
            "email" => $solicitud->email,
            "conductor" => $solicitud->conductor,
            "descripcion" => $solicitud->descripcion,
            "destino" => $solicitud->destino,
            "numPersonas" => $solicitud->numPersonas,
            "fechaEntrega" => $solicitud->fechaEntrega,
            "horaEntrega" => $solicitud->horaEntrega,
            "fechaDevolucion" => $solicitud->fechaDevolucion,
            "horaDevolucion" => $solicitud->horaDevolucion,
            "estado" => $solicitud->estado, 
            "placa" => $solicitud->placa, 

            'title' => 'Comprobante de solicitud', 
        ]; 
        
        $pdf = PDF::setOptions([
            'logOutputFile' => storage_path('logs/log.htm'),
            'tempDir' => storage_path('logs/')
        ])->loadView('solicitud.downloadPDF', $data)->stream();     
        //return $pdf->download('solicitud pendiente.pdf');
        //return $pdf->stream(); 
        return $pdf;
    }
}
