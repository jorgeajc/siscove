<?php

namespace App\Http\Controllers;

use App\departamentos;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\DepartamentosRequest;
use Illuminate\Support\Facades\Validator;
class DepartamentosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $departamentos = departamentos::orderBy('id','DESC')->get();
        return view('departamentos.index',compact("departamentos"));
    }

    public function create()
    {
        return view('departamentos.create');
    }
    public function store(Request $request)
    {
        $validator = validator::make($request->all(), [
            'nombreDeparta' => ['required', 'max:100', 'regex:(^[\pL\s\-]+$)', 'unique:departamentos'],
        ],[
            'nombreDeparta.required'   => 'El nombre del :attribute es obligatorio. ',
            'nombreDeparta.max'        => 'El nombre del :attribute debe contener un máximo de 100 caracteres. ',
            'nombreDeparta.regex'        => 'El nombre del :attribute debe contener solo letras. ',
            'nombreDeparta.unique'        => 'El nombre del :attribute que desea ingresar, ya existe. ',

        ],[
            'nombreDeparta'   => 'departamento',
        ]);

        if($validator->passes())
        {
            $departamentosX = new departamentos;
            $departamentosX->nombreDeparta = $request->nombreDeparta;
            $departamentosX->save();
            return response()->json(['success'=>'Added new records.']);
        }
        return response()->json(['errors'=>$validator->errors()->all()]); 

    } 
    public function show(departamentos $departamentos)
    {
       
    } 
    public function edit($id)
    {
        $departaE = departamentos::find($id); 
  
        return view('departamentos.edit',compact('departaE'));

    }
 
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombreDeparta' => ['required', 'max:100', 'regex:(^[\pL\s\-]+$)','unique:departamentos'],
        ],[
            'nombreDeparta.required'   => 'El nombre del :attribute es obligatorio. ',
            'nombreDeparta.max'        => 'El nombre del :attribute debe contener un máximo de 100 caracteres. ',
            'nombreDeparta.regex'        => 'El nombre del :attribute debe contener solo letras. ',
            'nombreDeparta.unique'        => 'El nombre del :attribute que desea ingresar, ya existe. ',
        ],[
            'nombreDeparta'   => 'departamento',
        ]);

        if ($validator->passes()) {  
            $departaE = departamentos::find($id); 
            $departaE->nombreDeparta = $request->nombreDeparta;
            $departaE->save();
            return response()->json(['success'=>'Registro Agregado Correctamente']); 
        } 
    	return response()->json(['errors'=>$validator->errors()->all()]);  
       
    } 
    public function destroy($id,Request $request)
    {  
        $busqueda = User::where('descripcion','=',$id);

        if($busqueda->count() <=0)
        {
            $departaE = departamentos::find($id);  
            $departaE ->delete();
            return response()->json(['success'=>'Registro eliminado con éxito']); 
        } 
        else{
            return response()->json(['errors'=>'error']);
        }  
    }
}
