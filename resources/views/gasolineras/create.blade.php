@extends('welcome') 

@section('content') 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script>  
    <script type="text/javascript" src="/js/jquery.maskedinput.js"></script> 
    <link href="/css/sweetAlert2Style.css" rel="stylesheet" />
    <style type="text/css">
        .alert {
            display:inline-block;
        }
    </style>
    <script>
        $(document).ready(function(){
            $(".agregar").click(function(){ 
                var validarCedula = document.getElementsByName("cedula");  
                var cedulaJuridica;  
                for(var i=0; i<validarCedula.length; i++){ 
                    if(validarCedula[i].value.match(/\d/g) != null){    
                        cedulaJuridica = validarCedula[i].value;  
                    } 
                } 
                var nombre = $('#nombre').val(); 
                var Ubicacion = $('#ubicacion').val();
                var Contacto = $('#contacto').val();
                var Correo = $('#correo').val();
                Swal.fire({
                    title: "¿Está seguro de ingresar este registro al sistema?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aceptar',   
                    cancelButtonText: 'Cancelar', 
                })
                .then((willDelete) => {
                    if (willDelete.value) { 
                        $.ajax({
                            url: "/guardarGasolinera", 
                            type: 'POST', 
                            statusCode: {
                                302: function() { 
                                    setTimeout("location.href='/'", 100); 
                                }
                            },
                            data: {
                                    "cedulaJuridica" : cedulaJuridica,
                                    "nombre" : nombre, 
                                    "ubicacion" : Ubicacion,
                                    "contacto" : Contacto,
                                    "correo" : Correo,

                                    _token: '{{csrf_token()}}' 
                                    },
                                    success: function(data) {
                                if($.isEmptyObject(data.errors)){  
                                    Swal.fire({
                                        title: "¡Agregado!",
                                        type: 'success',
                                        showCancelButton: false,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Aceptar' 
                                    }).then(function() { 
                                        setTimeout("location.href='/gasolineras'", 750); 
                                    });  
                                }else{    
                                        var descripcion = " <div class='alert alert-danger alert-dismissable'>"+
                                                        "       <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>"+
                                                        "           &times;"+
                                                        "       </button> "+
                                                        "        Solucione los siguientes errores"+    
                                                        "   </div>";
                                                        
                                    $.each(data.errors, function(i, item) {
                                        descripcion+=" <div class='alert alert-danger alert-dismissable'>"+
                                                        "       <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>"+
                                                        "           &times;"+
                                                        "       </button> "+  
                                                                item + 
                                                        "   </div>";
                                    });     
                                    $("#parent").html(descripcion);  
                                }
                            }
                        });
                    } else {
                        Swal.fire({
                            title:"¡Cancelado!", 
                            type: "error",  
                            confirmButtonText: 'Aceptar',
                            timer: 2000,  
                        });                         
                    }
                });
            });  
            $("#tipoId").click(function(){
                tipoIdentificacion(); 
            });
        });  
        $(function($){
            $("#contacto").mask("99999999", {  
                autoclear: false
            }); 
            $(".CedulaJuridica").mask("9-999-999999", { 
                completed:function(){ 
                    document.getElementsByClassName('CedulaJuridica')[0].style.border=' 1px solid #0000FF';  
                },
                autoclear: false
            }); 
            $(".CedulaFisica").mask("9-9999-9999", { 
                completed:function(){ 
                    document.getElementsByClassName('CedulaFisica')[0].style.border=' 1px solid #0000FF';  
                },
                autoclear: false
            }); 
            $(".idExtranjero").mask("999999999999",{ 
                autoclear: false
            }); 
            $(".idExtranjero").keyup(function(){
                var idExtranjero = $('.idExtranjero').val().match(/\d/g);    
                if(idExtranjero != null){  
                    if(idExtranjero.length == 11 || idExtranjero.length == 12){ 
                        document.getElementsByClassName('idExtranjero')[0].style.border=' 1px solid #0000FF';
                    }else{ 
                        document.getElementsByClassName('idExtranjero')[0].style.border=' 1px solid #dedede';  
                    } 
                } 
            });    
            $(".CedulaFisica").keyup(function(){ 
                var CedulaFisica = $('.CedulaFisica').val().match(/\d/g);   
                if(CedulaFisica != null && CedulaFisica.length != 9 ){ 
                    document.getElementsByClassName('CedulaFisica')[0].style.border=' 1px solid #dedede';    
                }
            });
            $(".CedulaJuridica").keyup(function(){ 
                var CedulaJuridica = $('.CedulaJuridica').val().match(/\d/g);  
                if(CedulaJuridica != null && CedulaJuridica.length != 10){
                    document.getElementsByClassName('CedulaJuridica')[0].style.border='1px solid #dedede';  
                }   
            });
        });
        function tipoIdentificacion(){
            var tipo = $('#tipoId').val(); 
            //variables para visualizar y ocultar los form-gruop
            var CedulaFisic = document.getElementById('CedulaFisic');
            var idExtranjer = document.getElementById('idExtranjer');
            var CedulaJuridic = document.getElementById('CedulaJuridic');
            //variables para manejar los inputs
            var CedulaFisica = document.getElementById('CedulaFisica');
            var idExtranjero = document.getElementById('idExtranjero');
            var CedulaJuridica = document.getElementById('CedulaJuridica');
            if(tipo == "CedulaJuridica"){    
                CedulaFisica.value = "";
                idExtranjero.value = "";
                CedulaFisic.style.display='none';
                idExtranjer.style.display='none';
                CedulaJuridic.style.display='block';  
            }else if(tipo == "CedulaFisica"){  
                CedulaJuridica.value = "";
                idExtranjero.value = "";
                CedulaFisic.style.display='block';
                idExtranjer.style.display='none';
                CedulaJuridic.style.display='none';  
            }else if(tipo == "idExtranjero"){ 
                CedulaFisica.value = "";
                CedulaJuridica.value = "";
                CedulaFisic.style.display='none';
                idExtranjer.style.display='block';
                CedulaJuridic.style.display='none';  
            }else{
                CedulaFisica.value = "";
                idExtranjero.value = "";
                CedulaJuridica.value = "";
                CedulaFisic.style.display='none';
                idExtranjer.style.display='none';
                CedulaJuridic.style.display='none'; 
            }
        } 
    </script>
    <style>  
        #CedulaJuridic{
            display:none;
        }
        #CedulaFisic{
            display:none;
        }
        #idExtranjer{
            display:none;
        }  
        input#CedulaJuridica, input#CedulaFisica, input#idExtranjero {
            border: 1px solid #dedede; 
            padding: 8px 16.69px;  
            font: 14px Roboto, sans-serif;
            width: 46%;  
        } 
        @media screen and (max-width:770px) {
            input#CedulaJuridica, input#CedulaFisica, input#idExtranjero{  
                width: 100%;  
            } 
        }
    </style>
</head>
<body>
    <br>
    <br>
    <br>
    <div class="container">
        <div class="row">
            <div id="parent">   
            </div> 
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <br>
                    <div class="card-heading text-center" style="color:black;">
                        <h2>Nueva Gasolinera</h2>
                    </div> 
                    <div class="card-body"> 
                        <div class="form-group row">
                            <label for="CedulaJuridica" class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Tipo de identificación: ') }}</label> 
                            <div class="col-md-6">
                                <select class="form-control" name="tipoId" id="tipoId">
                                    <option value="">Seleccione</option>
                                    <option value="CedulaJuridica">Cédula Persona Juridica</option>
                                    <option value="CedulaFisica">Cédula Persona Física</option>
                                    <option value="idExtranjero">Identificación Extranjero</option> 
                                </select>
                            </div>
                        </div>  
                        <div class="form-group row"  id="CedulaJuridic"> 
                            <label class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Cedula Juridica: ') }}</label>  
                            <input id="CedulaJuridica" name="cedula" type="text" placeholder="_-___-______" class="CedulaJuridica" required>
                        </div> 
                        <div class="form-group row"  id="CedulaFisic">
                            <label class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Cedula Fisica: ') }}</label>  
                            <input id="CedulaFisica" name="cedula" type="text" placeholder="_-____-____" class="CedulaFisica" required>
                        </div> 
                        <div class="form-group row" id="idExtranjer">
                            <label class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Identificación Extranjera: ') }}</label>  
                            <input id="idExtranjero" name="cedula" type="text" placeholder="___________" class="idExtranjero" required>
                        </div>  
                        <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Nombre') }}</label> 
                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ old('nombre') }}" required autofocus>
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="ubicacion" class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Ubicación') }}</label> 
                            <div class="col-md-6">
                                <input id="ubicacion" type="text" class="form-control{{ $errors->has('ubicacion') ? ' is-invalid' : '' }}" name="ubicacion" value="{{ old('ubicacion') }}" autofocus>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="contacto" class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Contacto') }}</label> 
                            <div class="col-md-6">
                                <input id="contacto" type="text" class="form-control contacto" name="contacto" value="{{ old('contacto') }}" required autofocus>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="correo" class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Correo Electrónico') }}</label> 
                            <div class="col-md-6">
                                <input id="correo" type="text" class="form-control{{ $errors->has('correo.') ? ' is-invalid' : '' }}" name="correo" value="{{ old('correo') }}" required autofocus>
                            </div>
                        </div>  
                        <div> 
                            <button class="btn bg-malibu-beach pull-left" onclick="window.location='{{ url('gasolineras') }}'">
                                <i class="fas fa-angle-double-left" style="color:black">Regresar</i> 
                            </button>
                            <button class="agregar btn bg-happy-green pull-right">
                                <i class="fas fa-check-double" style="color:black">Guardar</i>                                    
                            </button>   
                        </div>  
                    </div>
                </div>
            </div> 
        </div>
    </div>
</body>
</html>
@endsection