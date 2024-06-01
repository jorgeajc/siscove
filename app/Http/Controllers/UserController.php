<?php

namespace App\Http\Controllers;
 
use App\User;
use App\departamentos; 
use App\talleres;
use App\gasolineras;
use App\tipo_usuario;
use App\Mail\PresuMinGas;
use App\licencias;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UsuariosRequest;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Validator;  
use Illuminate\Support\Facades\Session; 
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{ 
    
    public function __construct()
    {
        $this->middleware('auth');
    } 
    public function index() 
    {
        $usuarios = DB::table('users as Users')
                    ->select('Users.id','Users.primerNombre','Users.segundoNombre','Users.primerApellido',
                                'Users.segundoApellido', 'Users.telefono', 'Users.email', 'Users.estado', 'Users.tipoUsuario',
                                'roles.name as tipo', 
                                'departamentos.nombreDeparta as departamento', 
                                'talleres.nombre as taller', 
                                'gasolineras.Nombre as gasolinera'
                    )
                    ->leftjoin('departamentos', 'departamentos.id', '=', 'Users.descripcion')
                    ->leftjoin('talleres', 'talleres.CedulaJuridica', '=', 'Users.descripcion')
                    ->leftjoin('gasolineras', 'gasolineras.cedulaJuridica', '=', 'Users.descripcion')
                    ->leftjoin('roles', 'roles.id', '=', 'Users.tipoUsuario') 
                    ->get();   
        $licencias = licencias::all();
        return view('usuarios.index', compact('usuarios', 'licencias'));  
    }  
    public function create()
    {
        return view('usuarios.create');
    } 
    public function store(Request $request)
    {
        if($request->tipoLicencia != null){
            $arreglo = $request->tipoLicencia; 
            if(count($arreglo) > count(array_unique($arreglo))){
                return response()->json(['errors'=>['No puede agregar dos licencias del mismo tipo']]);  
            }
        }  
        $validator = Validator::make($request->all(), [
            'id'  => ['required', 'max:45', 'unique:users', 'regex:/^([0-9+\-a-zA-Z])*$/'],
            'primerNombre' => ['required', 'regex:/^[\pL\s]+$/u', 'max:20'],
            'segundoNombre'=> [ 'regex: /^[\pL\s]+$/u','max:20', 'nullable'],
            'primerApellido' => ['required', 'regex:/^[\pL\s]+$/u', 'max:20'],
            'segundoApellido' => ['required', 'regex:/^[\pL\s]+$/u', 'max:20'],
            'telefono' => ['required', 'max:8', 'regex:/(^([0-9]+)(\d+)?$)/u'], 
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:6', 'confirmed', 'max:16'],
            'tipoUsuario' => ['required'],
            'descripcion' => ['required'], 
            'password_confirmation' => ['required', 'min:6', 'max:16'],
            
        ],[
            'id.required'               => 'La :attribute es obligatorio.', 
            'id.max'                    => 'La :attribute debe contener max 45 letras.', 
            'id.unique'                 => 'La :attribute que desea agregar ya existe',
            'id.regex'                  => 'La :attribute solo debe contener números, letras, guion',

            'primerNombre.required'     => 'El :attribute es obligatorio. ', 
            'primerNombre.max'          => 'El :attribute debe contener un máximo de 20 letras. ', 
            'primerNombre.regex'       => 'El :attribute debe contener solo letras. ',  

            'segundoNombre.regex'      => 'El :attribute debe contener solo letras y espacios',
            'segundoNombre.max'         => 'El :attribute debe contener un máximo de 20 letras. ',  

            'primerApellido.required'   => 'El :attribute es obligatorio. ', 
            'primerApellido.max'        => 'El :attribute debe contener un máximo de 20 letras.', 
            'primerApellido.regex'     => 'El :attribute debe contener solo letras. ', 
            
            'segundoApellido.required'  => 'El :attribute es obligatorio. ', 
            'segundoApellido.max'       => 'El :attribute debe contener un máximo de 20 letras.', 
            'segundoApellido.regex'    => 'El :attribute debe contener solo letras.', 

            'telefono.required'         => 'El :attribute es obligatorio.',  
            'telefono.max'              => 'El :attribute debe tener un máximo de 8 números.',
            'telefono.regex'            => 'El :attribute debe ser solo números.',

            'email.required'            => 'El :attribute es obligatorio.',
            'email.email'               => 'El :attribute es incorrecto; ejemplo correcto: correo@correo.com',
            'email.max'                 => 'El :attribute debe contener un máximo de 255 caracteres.',
            'email.unique'              => 'El :attribute que desea agregar ya existe',
            
            'password.required'         => 'La :attribute es obligatoria.',
            'password.min'              => 'La :attribute debe contener un mínimo 6 caracteres.',
            'password.max'              => 'La :attribute debe contener un maximo 16 caracteres.',  
            'password.confirmed'        => 'Las :attributes no coinciden',  

            'password_confirmation.required'         => 'La :attribute es obligatoria.',
            'password_confirmation.min'              => 'La :attribute debe contener un mínimo 6 caracteres.',
            'password_confirmation.max'              => 'La :attribute debe contener un máximo 16 caracteres.',  

            'tipoUsuario.required'      => 'El :attribute es obligatorio.',
            
            'descripcion.required'      => ' :attribute es obligatorio.',
        ],[
            'id'                => 'cedula',
            'primerNombre'      => 'primer nombre',
            'segundoNombre'     => 'segundo nombre',
            'primerApellido'    => 'primer apellido',
            'segundoApellido'   => 'segundo apellido',
            'telefono'          => 'teléfono',
            'email'             => 'correo electrónico',
            'password'          => 'contraseña',
            'tipoUsuario'       => 'tipo de usuario',
            'descripcion'       => 'departamento', 
            'password_confirmation' => 'contraseña de confimación',                
        ]);    
        if ($validator->passes()) { 
            $user = new User; 
            $user->id = $request->id;
            $user->primerNombre = $request->primerNombre;
            $user->segundoNombre= $request->segundoNombre;
            $user->primerApellido= $request->primerApellido;
            $user->segundoApellido= $request->segundoApellido;
            $user->telefono= $request->telefono;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->tipoUsuario = $request->tipoUsuario;
            $user->descripcion = $request->descripcion;
            $user->estado = 'Activo';
            $user->save();

            $user = User::find($request->id);
            $user->assignRole($request->tipoUsuario);
            if( $request->tipoLicencia != null && $request->vencimiento != null ){
                foreach ($request->tipoLicencia as $key => $tipo){  
                        $licencia = new licencias; 
                        $licencia->vencimiento = Carbon::createFromFormat('d/m/Y', $request->vencimiento[$key]);
                        $licencia->tipo = $tipo;   
                        $licencia->user = $user->id;
                        $licencia->save();  
                } 
            } 
            return response()->json(['success'=>'Added new records.']); 
        } 
    	return response()->json(['errors'=>$validator->errors()->all()]); 
    } 
    public function show($id)
    {
        $user = DB::table('users as Users')->
        select('Users.id','Users.primerNombre','Users.segundoNombre','Users.primerApellido','Users.segundoApellido', 'Users.telefono', 'Users.email',
                'Users.descripcion',
                'roles.id as tipoId', 'roles.name as tipo', 
                'departamentos.id as departamentoId', 'departamentos.nombreDeparta as departamento', 
                'talleres.CedulaJuridica as tallerCedula', 'talleres.nombre as taller', 
                'gasolineras.cedulaJuridica as gasolineraCedula', 'gasolineras.Nombre as gasolinera')
            ->leftjoin('departamentos', 'departamentos.id', '=', 'Users.descripcion')
            ->leftjoin('talleres', 'talleres.CedulaJuridica', '=', 'Users.descripcion')
            ->leftjoin('gasolineras', 'gasolineras.cedulaJuridica', '=', 'Users.descripcion')
            ->leftjoin('roles', 'roles.id', '=', 'Users.tipoUsuario')
            ->where('Users.id', $id)
            ->get(); 
        $tipoUsuario = \DB::select('select * from roles'); 
        $licencias = licencias::where('user', $id)->get();  
        return view('usuarios.show', compact('user', 'tipoUsuario', 'licencias'));
    } 
    public function edit($id)
    {
        $user = DB::table('users as Users')
            ->select('Users.id','Users.primerNombre','Users.segundoNombre','Users.primerApellido','Users.segundoApellido', 'Users.telefono', 'Users.email',
                'Users.descripcion',
                'roles.id as tipoId', 'roles.name as tipo', 
                'departamentos.id as departamentoId', 'departamentos.nombreDeparta as departamento', 
                'talleres.CedulaJuridica as tallerCedula', 'talleres.nombre as taller', 
                'gasolineras.cedulaJuridica as gasolineraCedula', 'gasolineras.Nombre as gasolinera')
            ->leftjoin('departamentos', 'departamentos.id', '=', 'Users.descripcion')
            ->leftjoin('talleres', 'talleres.CedulaJuridica', '=', 'Users.descripcion')
            ->leftjoin('gasolineras', 'gasolineras.cedulaJuridica', '=', 'Users.descripcion')
            ->leftjoin('roles', 'roles.id', '=', 'Users.tipoUsuario') 
            ->where('Users.id', $id)
            ->get(); 
        $tipoUsuario = \DB::select('select * from roles'); 
        $licencias = licencias::where('user', $id)->get();  
        // dd($licencias);
        return view('usuarios.edit', compact('user', 'tipoUsuario', 'licencias'));
    } 
    public function update(Request $request, $id)
    {
        if($request->tipoLicencia != null){
            $arreglo = $request->tipoLicencia; 
            if(count($arreglo) > count(array_unique($arreglo))){
                return response()->json(['errors'=>['No puede agregar dos licencias del mismo tipo']]);  
            }
        } 
        $validator = Validator::make($request->all(),[ 
            'primerNombre' => ['required', 'regex:/^[\pL\s]+$/u', 'max:20'],
            'segundoNombre'=> ['max:20'],
            'primerApellido' => ['required', 'regex:/^[\pL\s]+$/u', 'max:20'],
            'segundoApellido' => ['regex:/^[\pL\s]+$/u', 'max:20'],            
            'telefono' => ['required', 'max:8', 'regex:/(^([0-9]+)(\d-)?$)/u'], 
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'. $request->id .',id'], 
            'tipoUsuario' => ['required'],
            'descripcion' => ['required'], 
        ],[ 
            'primerNombre.required'     => 'El :attribute es obligatorio. ', 
            'primerNombre.max'          => 'El :attribute debe contener un máximo de 20 letras. ', 
            'primerNombre.regex'       => 'El :attribute debe contener solo letras. ', 

            'segundoNombre.max'         => 'El :attribute debe contener un máximo de 20 letras.',   
            'segundoNombre.regex'       => 'El :attribute debe contener solo letras. ', 

            'primerApellido.required'   => 'El :attribute es obligatorio. ', 
            'primerApellido.max'        => 'El :attribute debe contener un máximo de 20 letras.', 
            'primerApellido.regex'     => 'El :attribute debe contener solo letras. ', 
            
            'segundoApellido.required'  => 'El :attribute es obligatorio. ', 
            'segundoApellido.max'       => 'El :attribute debe contener un máximo de 20 letras.', 
            'segundoApellido.regex'    => 'El :attribute debe contener solo letras.', 

            'telefono.required'         => 'El :attribute es obligatorio.',  
            'telefono.max'              => 'El :attribute debe tener un máximo de 8 números.',
            'telefono.regex'            => 'El :attribute debe ser solo números.',

            'email.required'            => 'El :attribute es obligatorio.',
            'email.email'               => 'El :attribute es incorrecto; ejemplo correcto: correo@correo.com',
            'email.max'                 => 'El :attribute debe contener un máximo de 255 caracteres.',
            'email.unique'              => 'El :attribute que desea agregar ya existe',
            
            'tipoUsuario.required'      => 'El :attribute es obligatorio.',
            
            'descripcion.required'      => ':attribute es obligatorio.',
        ],[
            
            'primerNombre'      => 'primer nombre',
            'segundoNombre'     => 'segundo nombre',
            'primerApellido'    => 'primer apellido',
            'segundoApellido'   => 'segundo apellido',
            'telefono'          => 'teléfono',
            'email'             => 'correo electrónico',
            'tipoUsuario'       => 'tipo de usuario',
            'descripcion'       => 'departamento', 
        ]);
        if ($validator->passes()) {  
            $nuevoUser = User::find($id);  
            $nuevoUser->id =$request->id;
            $nuevoUser->primerNombre = $request->primerNombre;
            $nuevoUser->segundoNombre = $request->segundoNombre;
            $nuevoUser->primerApellido = $request->primerApellido;
            $nuevoUser->segundoApellido = $request->segundoApellido;
            $nuevoUser->telefono = $request->telefono;
            $nuevoUser->email = $request->email; 
            $nuevoUser->password;
            $nuevoUser->removeRole($nuevoUser->tipoUsuario);
            $nuevoUser->tipoUsuario = $request->tipoUsuario;
            $nuevoUser->descripcion = $request->descripcion;  
            $nuevoUser->save(); 

            $licen = licencias::where('user', $id)->get(); 
            if($request->licencia == "si"){
                foreach ($licen as $key => $value) { 
                    $value->delete();
                }
                foreach ($request->tipoLicencia as $key => $value) { 
                    $licencia = new licencias;  
                    $licencia->tipo = $value;
                    if(strpos($request->vencimiento[$key], '-') !== false){
                        $licencia->vencimiento =  $request->vencimiento[$key];
                    }else{
                        $licencia->vencimiento =  Carbon::createFromFormat('d/m/Y', $request->vencimiento[$key]);
                    } 
                    $licencia->user = $id;
                    $licencia->save();  
                }  
            }else if($request->licencia == "no"){ 
                foreach ($licen as $key => $value) { 
                    $value->delete();
                }  
            }  
            $nuevoUser->assignRole($request->tipoUsuario);
            return response()->json(['success'=>'Registro agregado correactamente']); 
        } 
        return response()->json(['errors'=>$validator->errors()->all()]);   
    } 
    public function destroy($id)
    {  
        if($id == '123'){
            return response()->json(['errors'=>['El usuario seleccionado no puede ser eliminado']]);  
        }else{
            try {
                $user = User::find($id);
                $licencia = licencias::find($user->licencia);

                if($licencia){
                    $user->delete();
                    $licencia->delete();
                }else{
                    $user->delete();
                }
                return response()->json(['success'=>'Registro eliminado con éxito']);  
            } catch (\Throwable $th) {
                return response()->json(['errors'=>['El usuario seleccionado no puede ser eliminado']]);  
            } 
        }  
    }   
    public function buscarProcedencia($id)
    {   
        if($id == 1 || $id == 2 || $id == 3 || $id == 4 || $id == 7 || $id == 8)
        {
            return departamentos::all();
        }
        else if($id == 5)
        {
            return gasolineras::all();
        }
        else if($id == 6)
        {
            return talleres::all();
        } 
    } 
    public function cambioEstado($id){
       try {
           $x = User::find($id);
           $x->update(['estado' => $x->estado == 'Activo'? 'Inactivo':  'Activo']); 
       } catch (\Throwable $th) {
            return response()->json(['errors'=>["Error en el cambio de estado"]]);
       }
    }
}
