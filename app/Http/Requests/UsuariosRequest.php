<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuariosRequest extends FormRequest
{ 
    public function authorize()
    {
        return true;
    }
 
    public function rules()
    {
        return [
            'id'                => 'required|min:1|max:45',
            'primerNombre'      => 'required|min:1|max:20',
            'segundoNombre'     => 'required|min:1|max:20',
            'primerApellido'    => 'required|min:1|max:20',
            'segundoApellido'   => 'required|min:1|max:20',
            'telefono'          => 'required',
            'email'             => 'required',
            'password'          => 'required|min:1|max:30',
            'tipoUsuario'       => 'required',
            'descripcion'       => 'required',
        ];
    }
    
    public function messages()
    {
        return [
            'id.required'               => 'El :attribute es obligatorio.',
            'id.min'                    => 'El :attribute debe contener mas de una letra.',
            'id.max'                    => 'El :attribute debe contener max 45 letras.',
     
            'primerNombre.required'     => 'El :attribute es obligatorio.',
            'primerNombre.min'          => 'El :attribute debe contener mas de una letra.',
            'primerNombre.max'          => 'El :attribute debe contener max 30 letras.',
      
            'segundoNombre.min'         => 'El :attribute debe contener mas de una letra.',
            'segundoNombre.max'         => 'El :attribute debe contener max 30 letras.',
     
            'primerApellido.required'   => 'El :attribute es obligatorio.',
            'primerApellido.min'        => 'El :attribute debe contener mas de una caracter.',
            'primerApellido.max'        => 'El :attribute debe contener max 30 letras.',
     
            'segundoApellido.required'  => 'El :attribute es obligatorio.',
            'segundoApellido.min'       => 'El :attribute debe contener mas de una caracter.',
            'segundoApellido.max'       => 'El :attribute debe contener max 30 letras.',

            'telefono.required'         => 'El :attribute es obligatorio.', 
     
            'email.required'            => 'Debe seleccionar un :attribute .', 
     
            
            'password.required'         => 'El :attribute es obligatorio.',
            'password.min'              => 'El :attribute debe contener mas de una caracter.',
            'password.max'              => 'El :attribute debe contener max 30 letras.', 

            'tipoUsuario.integer'       => 'El :attribute debe ser entero.',
               
            'descripcion.integer'       => 'El :attribute debe ser entero.',
        ];
    }
    public function attributes()
    {
        return [
            'id'                => 'decula',
            'primerNombre'      => 'nombre de usuario',
            'segundoNombre'     => 'nombre de usuario',
            'primerApellido'    => 'apellido paterno',
            'segundoApellido'   => 'apellido materno',
            'telefono'          => 'Telefono',
            'email'             => 'correo electronico',
            'password'          => 'Contraseña',
            'tipoUsuario'       => 'Tipo de usuario',
            'descripcion'       => 'Descrición',                
        ];
    }
}
