<?php

namespace App\Http\Controllers;
use App\User;
use App\gasolineras;
use Illuminate\Http\Request;
use App\Http\Requests\gasolinerasRequest;
use Illuminate\Support\Facades\Validator;
class GasolinerasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $gasolineras = gasolineras::orderBy('cedulaJuridica','ASC')->where('estado', '=', 'Activo')->get();
        return view('gasolineras.index',compact('gasolineras'));
    }
    public function vistaDesactivados()
    {
        $gasolineras = gasolineras::orderBy('cedulaJuridica','ASC')->where('estado', '=', 'Inactivo')->get();
        return view('gasolineras.vistaDesactivados',compact('gasolineras'));
    } 
    public function create()
    {
        return view ('gasolineras.create'); 
    } 
    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'cedulaJuridica'    => ['required', 'max:45', 'unique:gasolineras', 'regex:/(^([0-9-]+)(\d+)?$)/u'],
            'nombre'            => ['required', 'regex:/^[\pL\s]+$/u', 'max:45'],
            'ubicacion'         => ['required'],
            'contacto'          => ['required', 'max:45', 'regex:/(^([0-9-]+)(\d+)?$)/u'],
            'correo'            => ['required', 'email', 'max:45'], 
        ],[
            'cedulaJuridica.required'   => 'La :attribute es obligatorio. ', 
            'cedulaJuridica.max'        => 'La :attribute debe contener máximo de 45 caracteres. ', 
            'cedulaJuridica.unique'     => 'La :attribute que desea agregar ya existe. ',
            'cedulaJuridica.regex'      => 'La :attribute debe completarse. ',

            'nombre.required'           => 'El :attribute es obligatorio. ', 
            'nombre.max'                => 'El :attribute debe contener un máximo de 45 caracteres. ', 
            'nombre.regex'              => 'El :attribute debe contener solo letras, tilde, puntos, comas, dieresis.',
 
            'ubicacion.required'        => 'La :attribute es obligatorio. ',   

            'contacto.required'         => 'El :attribute es obligatorio. ',  
            'contacto.max'              => 'El :attribute debe contener un máximo de 45 caracteres. ', 
            'contacto.regex'     => 'El :attribute debe ser solo números y complete todos los números.',

            'correo.required'           => 'El :attribute es obligatorio. ',  
            'correo.email'              => 'El :attribute es incorrecto; ejemplo correcto: correo@correo.com. ', 
            'correo.max'                => 'El :attribute debe contener un máximo de 45 caracteres. ', 
        ],[
            'cedulaJuridica'            => 'cedula jurídica/fisica/extrajera',
            'nombre'                    => 'nombre de la gasolinera',
            'ubicacion'                 => 'ubicación de la gasolinera',
            'contacto'                  => 'número de teléfono',
            'correo'                    => 'correo electrónico',             
        ]);  
        if ($validator->passes()) {
            $gasolinerasX = new gasolineras;
            $gasolinerasX->cedulaJuridica = $request->cedulaJuridica;
            $gasolinerasX->nombre = $request->nombre;
            $gasolinerasX->ubicacion = $request->ubicacion;
            $gasolinerasX->contacto = $request->contacto;
            $gasolinerasX->correo = $request->correo;
            $gasolinerasX->estado = 'Activo';
            $gasolinerasX->save();
            return response()->json(['success'=>'Added new records.']);

        } 
    	return response()->json(['errors'=>$validator->errors()->all()]);  
    } 
    public function show(gasolineras $gasolineras)
    {
        $gasolina = gasolineras::where('cedulaJuridica','=',$cedulaJuridica)->firstOrFail(); 
        
        return view('gasolineras.edit',compact('gasolina'));
    } 
    public function edit($id)
    {
        $gasolineras = gasolineras::where('cedulaJuridica','=',$id)->firstOrFail();   
        
        return view('gasolineras.edit',compact('gasolineras'));
    } 
    public function update(Request $request, $cedulaJuridica)
    {
        $validator = Validator::make($request->all(), [ 
            'nombre'            => ['required', 'regex:/^[\pL\s]+$/u', 'max:45'],
            'ubicacion'         => ['required'],
            'contacto'          => ['required', 'max:45', 'regex:/(^([0-9-]+)(\d+)?$)/u'],
            'correo'            => ['required', 'email', 'max:45', 'unique:gasolineras,correo,'. $request->cedulaJuridica .',cedulaJuridica'], 
        ],[ 
            'nombre.required'           => 'El :attribute es obligatorio. ', 
            'nombre.max'                => 'El :attribute debe contener un máximo de 45 caracteres. ', 
            'nombre.regex'              => 'El :attribute debe contener solo letras, tilde, puntos, comas, dieresis.',
 
            'ubicacion.required'        => 'La :attribute es obligatorio. ',     

            'contacto.required'         => 'El :attribute es obligatorio. ',  
            'contacto.max'              => 'El :attribute debe contener un máximo de 45 caracteres. ', 
            'contacto.regex'            => 'El :attribute debe ser solo números y complete todos los números.',

            'correo.required'           => 'El :attribute es obligatorio. ',  
            'correo.email'              => 'El :attribute que desea ingresar es incorrecto; ejemplo correcto: correo@correo.com. ', 
            'correo.max'                => 'El :attribute debe contener un máximo de 45 caracteres. ',  
            'correo.unique'             => 'El :attribute que desea agregar ya existe',

        ],[ 
            'nombre'                    => 'nombre de la gasolinera',
            'ubicacion'                 => 'ubicación de la gasolinera',
            'contacto'                  => 'número de teléfono',
            'correo'                    => 'correo electrónico',              
        ]);  
        if ($validator->passes()) {
            $gasolinerasX = gasolineras::where('cedulaJuridica','=',$cedulaJuridica)->firstOrFail(); 
            $gasolinerasX->cedulaJuridica = $cedulaJuridica;
            $gasolinerasX->nombre = $request->nombre;
            $gasolinerasX->ubicacion = $request->ubicacion;
            $gasolinerasX->contacto = $request->contacto;
            $gasolinerasX->correo = $request->correo;
            $gasolinerasX->estado = $request->estado;
            $gasolinerasX->save();

            return response()->json(['success'=>'Added new records.']); 
        } 
    	return response()->json(['errors'=>$validator->errors()->all()]);  
    } 
    public function destroy($cedulaJuridica)
    {
        $busqueda = User::where('descripcion','=',$cedulaJuridica); 
        
        if($busqueda->count() <=0)
        {
            $gas = gasolineras::where('cedulaJuridica','=',$cedulaJuridica)->firstOrFail(); 
            
            try {
                $gas ->delete();
            } catch (\PDOException $e) {  
                if($e->errorInfo[0] == 23000){
                    return response()->json(['errors'=>'Gasolinera en uso']);
                }  
            } 
        }else{
            return response()->json(['errors'=>'error']);   
        } 
    }
    public function desactivar($cedulaJuridica){
        $gasolinerasX = gasolineras::where('cedulaJuridica','=',$cedulaJuridica)->firstOrFail(); 
        $gasolinerasX->estado = "Inactivo";
        $gasolinerasX->save();
        return response()->json(['success'=>'Added new records.']); 
    }
    public function activar($cedulaJuridica){ 
        $gasolinerasX = gasolineras::where('cedulaJuridica','=',$cedulaJuridica)->firstOrFail(); 
        $gasolinerasX->estado = "Activo";
        $gasolinerasX->save();
        return response()->json(['success'=>'Added new records.']);  
    }
}
