<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class ResetPasswordController extends Controller
{ 
    use ResetsPasswords;
 
    protected $redirectTo = '/home';

    public function reset(Request $request)
    {
        $this->validate($request, $this->rules(), $this->validationErrorMessages());
 
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );
 
        return $response == \Password::PASSWORD_RESET
                    ? redirect('login')->with('status', 'error')
                    : redirect('password/reset')->with('status', 'error');
    }
 
    protected function resetPassword($user, $password)
    {
        $user->forceFill([
            'password' => Hash::make($password),
            'remember_token' => str_random(60),
        ])->save();
 
        // GENERAR TOKEN PARA SATELLIZER AQUI ??
        // $this->guard()->login($user);
    }
}
