<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
class LoginController extends Controller
{ 
    use AuthenticatesUsers; 
    protected $redirectTo = '/home'; 
    public function __construct(){
        $this->middleware('guest')->except('logout');
    }  
    public function login(Request $request){
        $this->validateLogin($request); 
         /*If the class is using the ThrottlesLogins trait, we can automatically throttle the login attempts for this application. 
         We'll key this by the username and the IP address of the client making these requests into this application.*/
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        } 
        // This section is the only change
        if ($this->guard()->validate($this->credentials($request))) {
            $user = $this->guard()->getLastAttempted(); 
            // Make sure the user is active
            if ($user->estado=='Activo' && $this->attemptLogin($request)) {
                // Send the normal successful login response
                /* sí las credenciales validas y estado activo */ 
                return $this->sendLoginResponse($request);
            } else {
                /*Increment the failed login attempts and redirect back to the login form with an error message.*/
                /* Sí las credenciales válidas y estado inactivo */
                $this->incrementLoginAttempts($request);
                return redirect()
                    ->back()
                    ->withInput($request->only($this->username(), 'remember'))
                    ->withErrors(['id' => 'Su cuenta está inactiva']);
            }
        } 
        /*If the login attempt was unsuccessful we will increment the number of attempts
        to login and redirect the user back to the login form. Of course, when this
        user surpasses their maximum number of attempts they will get locked out.*/
        /* Sí las credenciales invalidas */
        $this->incrementLoginAttempts($request); 
        return $this->sendFailedLoginResponse($request);
    }
}
