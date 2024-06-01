<?php
namespace App\Http\Controllers;

use App\talleres;
use Illuminate\Http\Request;
use App\Http\Requests\TalleresRequest;
use Illuminate\Support\Facades\Validator;
class TalleresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $talleres = talleres::orderBy( 'CedulaJuridica', 'ASC')->where('Estado','=','Activo')->get();
        return view('Talleres.index',compact('talleres'));
    } 
    public function vistaDesactivados()
    {
        $talleres = talleres::orderBy('CedulaJuridica','ASC')->where('Estado', '=', 'Inactivo')->get(); 
        return view('Talleres.vistaDesactivados',compact('talleres'));
    }
    public function create()
    {
        return view('Talleres.Create');
    } 
    public function store(Request $request)
    {
        $validator = validator::make($request -> all(), [
            'CedulaJuridica' => ['required', 'max:30', 'regex:/(^([0-9-]+)(\d+)?$)/u', 'unique:talleres'],
            'nombre' => ['required', 'max:50', 'regex:/^[\pL\s]+$/u'],
            'Ubicacion' => ['required'],
            'Contacto' => ['required', 'max:50', 'regex:/(^([0-9-]+)(\d+)?$)/u'],
            'Correo' => ['required', 'max:200', 'string', 'unique:talleres', 'email'], 
        ],[
            'CedulaJuridica.required'   => 'La :attribute es obligatorio. ',
            'CedulaJuridica.max'        => 'La :attribute debe contener un máximo de 30 caracteres. ',
            'CedulaJuridica.regex'      => 'La :attribute dede de completarse. ',
            'CedulaJuridica.unique'     => 'La :attribute que desea ingresar, ya existe. ',

            'nombre.required'   => 'El :attribute es obligatorio. ',
            'nombre.max'        => 'El :attribute debe contener un máximo de 50 caracteres. ',
            'nombre.regex'     => 'El :attribute debe contener solo letras, tilde, puntos, comas, dieresis.',

            'Ubicacion.required'   => 'La :attribute es obligatorio. ',

            'Contacto.required'   => 'El :attribute es obligatorio. ',
            'Contacto.max'        => 'El :attribute debe contener un máximo de 50 caracteres. ',
            'Contacto.regex'     => 'El :attribute debe ser solo números y complete todos los números.',

            'Correo.required'   => 'El :attribute es obligatorio. ',
            'Correo.max'        => 'El :attribute debe contener un máximo de 200 caracteres. ',
            'Correo.string'     => 'El :attribute debe contener solo letras. ',
            'Correo.unique'     => 'El :attribute que desea ingresar, ya existe. ',
            'Correo.email'     => 'El :attribute que desea ingresar es incorrecto; ejemplo correcto: correo@correo.com. ',
             
        ],[
            'CedulaJuridica'   => 'cedula jurídica/fisica/extrajera',
            'nombre'   => 'nombre del taller',
            'Ubicacion'   => 'ubicación del taller',
            'Contacto'   => 'contacto',
            'Correo'   => 'correo', 
            
        ]); 
        if($validator->passes())
        {
            $talleresN = new talleres;

            $talleresN->CedulaJuridica =$request->CedulaJuridica;
            $talleresN->nombre =$request->nombre;
            $talleresN->Ubicacion =$request->Ubicacion;
            $talleresN->Contacto =$request->Contacto;
            $talleresN->Correo =$request->Correo;
            $talleresN->Estado = "Activo"; 
            $talleresN->save(); 
            return response()->json(['success'=>'Added new records.']);
        }
        return response()->json(['errors'=>$validator->errors()->all()]);  
     } 
    public function show($CedulaJuridica)
    {
        $talleresB = talleres::where('CedulaJuridica',"=",$CedulaJuridica)->get(); // es undefined
        return view('talleres.fragments.show',compact('talleresB'));
    } 
    public function edit($CedulaJuridica)
    {
        $talleresE = talleres::where('CedulaJuridica','=',$CedulaJuridica)->firstOrFail(); 
        return view('Talleres.edit', compact('talleresE'));
    } 
    public function update(Request $request,  $CedulaJuridica)
    { 
        $validator = validator::make($request -> all(), [
            'CedulaJuridica' => ['required', 'max:30', 'regex:/(^([0-9-]+)(\d+)?$)/u'],
            'nombre' => ['required', 'max:50', 'regex:/^[\pL\s]+$/u'],
            'Ubicacion' => ['required'],
            'Contacto' => ['required', 'max:50', 'regex:/(^([0-9]+)(\d+)?$)/u'],
            'Correo' => ['required', 'max:200', 'string', 'unique:talleres,Correo,'. $request->CedulaJuridica.',CedulaJuridica', 'email'], 
        ],[

            'CedulaJuridica.required'   => 'La :attribute es obligatorio. ',
            'CedulaJuridica.max'        => 'La :attribute debe contener un máximo de 30 caracteres. ',
            'CedulaJuridica.regex'      => 'La :attribute dede de completarse. ',
            'CedulaJuridica.unique'     => 'La :attribute que desea ingresar, ya existe. ',

            'nombre.required'   => 'El :attribute es obligatorio. ',
            'nombre.max'        => 'El :attribute debe contener un máximo de 50 caracteres. ',
            'nombre.regex'     => 'El :attribute debe contener solo letras, tilde, puntos, comas, dieresis.',

            'Ubicacion.required'   => 'La :attribute es obligatorio. ',

            'Contacto.required'   => 'El :attribute es obligatorio. ',
            'Contacto.max'        => 'El :attribute debe contener un máximo de 50 caracteres. ',
            'Contacto.regex'     => 'El :attribute debe ser solo números y complete todos los números. ',

            'Correo.required'   => 'El :attribute es obligatorio. ',
            'Correo.max'        => 'El :attribute debe contener un máximo de 200 caracteres. ',
            'Correo.string'     => 'El :attribute debe contener solo letras. ',
            'Correo.unique'     => 'El :attribute que desea ingresar, ya existe. ',
            'Correo.email'      => 'El :attribute que desea editar es incorrecto; ejemplo correcto: correo@correo.com. ',
        ],[
            'CedulaJuridica'   => 'cedula jurídica/fisica/extrajera',
            'nombre'   => 'nombre del taller',
            'Ubicacion'   => 'ubicación del taller',
            'Contacto'   => 'contacto',
            'Correo'   => 'correo',  
        ]); 
        if($validator->passes())
        {
            $talleresN = talleres::where('CedulaJuridica','=',$CedulaJuridica)->firstOrFail(); 
            $talleresN->CedulaJuridica =$request->CedulaJuridica;
            $talleresN->nombre =$request->nombre;
            $talleresN->Ubicacion =$request->Ubicacion;
            $talleresN->Contacto =$request->Contacto;
            $talleresN->Correo =$request->Correo; 
            $talleresN->save(); 
            return response()->json(['success'=>'Added new records.']);
        }
        return response()->json(['errors'=>$validator->errors()->all()]);  
     } 
    public function destroy($CedulaJuridica)
    {
        $talleresB = talleres::where('CedulaJuridica','=',$CedulaJuridica)->firstOrFail(); 
        if($talleresB != null){
                $talleresB ->delete();
            $mensaje = 'success'; 
        }else{
            $mensaje = 'fail';
        }    
        return $mensaje;
    } 
    public function desactivar($CedulaJuridica){
        $talleresB = talleres::where('CedulaJuridica','=',$CedulaJuridica)->firstOrFail(); 
        $talleresB->estado = "Inactivo";
        $talleresB->save();
        return 'success';
    }
    public function activar($CedulaJuridica){
        $talleresB = talleres::where('CedulaJuridica','=',$CedulaJuridica)->firstOrFail(); 
        $talleresB->estado = "Activo";
        $talleresB->save();
        return 'success';
    }
}
