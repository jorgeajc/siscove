@extends('welcome') 
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">  
    <link href="/css/login.css" rel="stylesheet" />
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script> 
    <script type="text/javascript">
        function mostrarPassword(){
            var cambio = document.getElementById("password");
            if(cambio.type == "password"){
                cambio.type = "text";
                $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            }else{
                cambio.type = "password";
                $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            }
        }  
        function ocultarPorTiempo(){
            console.log("entro");
            var cambio = document.getElementById("password");
            if(cambio.type == "text"){
                console.log("if");
                cambio.type = "password";
                $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            } 
        }
        $(document).ready(function () { 
            $('#show_password').click(function () {  
                setTimeout(ocultarPorTiempo, 5000);
            }); 
        });
    </script> 
</head> 
<body>  
    <div class="row justify-content-center contenedor">
        <div class="col-md-4 elemento"> 
            <div class="card"> 
                <div class="imgcontainer">
                    <img src="/images/logo.jpg" alt="logo" class="logo">
                </div> 
                <h3 class="titulo">Iniciar sesión</h3> 
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" id="form">
                        @csrf
                        <fieldset>   
                            <div class="form-group row">
                                
                                <label class="sr-only">{{ __('Cédula: ') }}</label> 
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-deep-blue"><i class="fa fa-user fa-lg"></i></span>
                                    </div> 
                                    <input id="id" type="text" placeholder="Identificación" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id" value="{{ old('id') }}" required autofocus>
                                    @if ($errors->has('id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('id') }}</strong>
                                        </span>
                                    @endif 
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="sr-only">{{ __('Contraseña: ') }}</label> 
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-deep-blue"><i class="fa fa-lock fa-lg"></i></span>
                                    </div>
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Contraseña" name="password" required> 
                                    <div class="input-group-prepend">
                                        <button id="show_password" class="btn bg-happy-itmeo" type="button" onclick="mostrarPassword()" style="color:black"> <span class="fa fa-eye-slash icon fa-lg"></span> </button>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> 
                            <div class="form-group row"> 
                                <button type="submit" class="btn btn-lg  bg-happy-green btn-block" style="color:black">
                                    {{ __('Iniciar Sesión') }}
                                </button> 
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Recuperar contraseña?') }}
                                    </a>
                                @endif 
                            </div> 
                        </fieldset>
                    </form> 
                </div>   
            </div>
        </div> 
    </div>  
</body> 
</html> 
@endsection