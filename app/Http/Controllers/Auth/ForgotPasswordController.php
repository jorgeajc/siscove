<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request; 

class ForgotPasswordController extends Controller
{ 
    use SendsPasswordResetEmails;
 
    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);
 
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );
  
        switch ($response) {
            case \Password::INVALID_USER:
                return redirect('password/reset')->with('status', 'error');
                break;
 
            case \Password::INVALID_PASSWORD:
                return redirect('password/reset')->with('status', 'error');
                break;
 
            case \Password::INVALID_TOKEN:
                return redirect('password/reset')->with('status', 'error');
                break;
            default: 
                return redirect('password/reset')->with('status', 'Se te ha enviado un correo para le cambio de contraseña');
        }
    }
}
