<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
class Handler extends ExceptionHandler
{ 
    protected $dontReport = [
        //
    ]; 
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ]; 
    public function report(Exception $exception)
    {
        parent::report($exception);
    } 
    public function render($request, Exception $exception)
    { 
        
        if($exception instanceof \Illuminate\Session\TokenMismatchException){   
            die(header("HTTP/1.0 302 Not Found")); 
        } 

        if ($exception instanceof \Spatie\Permission\Exceptions\UnauthorizedException) {
            abort('401');
        }
        // 404 page when a model is not found
        if ($exception instanceof ModelNotFoundException) { 
            abort(404);
        } 

        // custom error message
        if ($exception instanceof \ErrorException) {
            abort(500);
        }
         
        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException) {
            abort(405);
        } 

        if ($exception instanceof \Illuminate\Database\QueryException) {  
            abort(500);
        }   
        return parent::render($request, $exception);
    }
}
