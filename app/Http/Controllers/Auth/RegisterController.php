<?php
namespace App\Http\Controllers\Auth;
use App\User;
use App\departamentos;
use App\talleres;
use App\gasolineras;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\UsuariosRequest;

class RegisterController extends Controller
{
    use RegistersUsers;
    protected $redirectTo = '/home';
     
    protected function validator(array $data)
    {
        return Validator::make($data, [ 
            'id' => $data['id'],
            'primerNombre' => $data['primerNombre'],
            'segundoNombre' => $data['segundoNombre'],
            'primerApellido' => $data['primerApellido'],
            'segundoApellido' => $data['segundoApellido'],
            'telefono' => $data['telefono'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),  
            'tipoUsuario' => $data['tipoUsuario'],
            'descripcion' => $data['descripcion'],
        ]);
    }
    protected function create(UsuariosRequest $data)
    {
        return User::create([
            'id' => $data['id'],
            'primerNombre' => $data['primerNombre'],
            'segundoNombre' => $data['segundoNombre'],
            'primerApellido' => $data['primerApellido'],
            'segundoApellido' => $data['segundoApellido'],
            'telefono' => $data['telefono'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),  
            'tipoUsuario' => $data['tipoUsuario'],
            'descripcion' => $data['descripcion'],
        ]);
        
    }
    public function buscarProcedencia($id)
    {  
        if($id == 1 || $id == 2 || $id == 3 || $id == 4 || $id == 7|| $id == 8)
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
}
