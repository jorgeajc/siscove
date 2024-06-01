@extends('welcome') 
@section('content')
<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8"> 
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
                var CedulaJuridica;  
                for(var i=0; i<validarCedula.length; i++){ 
                    if(validarCedula[i].value.match(/\d/g) != null){    
                        CedulaJuridica = validarCedula[i].value; 
                    } 
                } 
                var nombre = $('#nombre').val(); 
                var Ubicacion = $('#Ubicacion').val();
                var Contacto = $('#Contacto').val();
                var Correo = $('#Correo').val();  
                Swal.fire({
                    title: " ¿Está seguro de ingresar este registro al sistema?",
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
                            url: "/guardarTaller", 
                            type: 'POST', 
                            statusCode: {
                                302: function() { 
                                    setTimeout("location.href='/'", 100); 
                                }
                            },
                            data: {
                                    "CedulaJuridica" : CedulaJuridica,
                                    "nombre" : nombre, 
                                    "Ubicacion" : Ubicacion,
                                    "Contacto" : Contacto,
                                    "Correo" : Correo, 
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
                                        confirmButtonText: 'Aceptar',
                                    }).then(function() {
                                        setTimeout("location.href='/talleres'", 750); 
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
                            confirmButtonText: 'Aceptar'});

                    }
                });
            }); 
               
            $("#tipoId").click(function(){
                tipoIdentificacion(); 
            });
        }); 
        $(function($){
            $("#Contacto").mask("99999999", {  
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
            border-radius: 3px 3px 3px 3px;
            -moz-border-radius: 3px 3px 3px 3px;
            -webkit-border-radius: 3px 3px 3px 3px;
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
        <div class="row justify-content-center"> 
            <div class="col-lg-8"> 
                <div class="row">
                    <div id="parent">   
                    </div> 
                </div>  
                <div class="card">
                    <div class="card-body"> 
                        <h5 class="card-title text-center" style="color:black">Nuevo Taller</h5>  
                        <div class="form-group row">
                            <label for="CedulaJuridica" class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Tipo de Identificación: ') }}</label> 
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
                            <label class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Cedula Jurídica: ') }}</label>  
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
                            <label for="nombre" class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Nombre: ') }}</label> 
                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ old('nombre') }}" required autofocus>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="Ubicacion" class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Ubicación: ') }}</label> 
                            <div class="col-md-6">
                                <input id="Ubicacion" type="text" class="form-control{{ $errors->has('Ubicacion') ? ' is-invalid' : '' }}" name="Ubicacion" value="{{ old('Ubicacion') }}" autofocus>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="Contacto" class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Numero de Contacto: ') }}</label> 
                            <div class="col-md-6">
                                <input id="Contacto" type="text" class="form-control" name="Contacto" class="Contacto" required autofocus> 
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="Correo" class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Correo Electrónico: ') }}</label> 
                            <div class="col-md-6">
                                <input id="Correo" type="text" class="form-control{{ $errors->has('Correo') ? ' is-invalid' : '' }}" name="Correo" value="{{ old('Correo') }}" required autofocus>
                            </div>
                        </div> 
                        <div> 
                            <a href="{{ route('talleres.index')}}" class="btn bg-malibu-beach pull-left">
                                <i class="fas fa-angle-double-left" style="color:black">Regresar</i>
                            </a>   
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