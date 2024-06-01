@extends('welcome')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">   
    <script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script>  
    <script type="text/javascript" src="/js/jquery.maskedinput.js"></script> 
    <style type="text/css">
        .alert {
            display:inline-block;
        }
  </style>
    <script>
        $(document).ready(function()
        { 
            $(".editar").click(function(){
                var cedulaJuridica = $('#cedulaJuridica').val(); 
                var nombre = $('#nombre').val(); 
                var Ubicacion = $('#ubicacion').val();
                var Contacto = $('#contacto').val();
                var Correo = $('#correo').val(); 
                var estado = $('#estado').val(); 
                Swal.fire({
                    title: "¿Está seguro de actualizar este registro?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Actualizar',  
                    cancelButtonText: 'Cancelar', 
                })
                .then((willDelete) => {
                    if (willDelete.value) { 
                        $.ajax({
                            url: "/editarGasolinera/"+cedulaJuridica, 
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
                                    "estado":estado,
                                    _token: '{{csrf_token()}}' 
                                    },
                                    success: function(data) {
                                if($.isEmptyObject(data.errors)){ 
                                    Swal.fire({
                                        title: "¡Actualizado!",
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
                            buttons: "Aceptar", 
                            confirmButtonText: 'Aceptar',
                            timer: 2000,  
                        });                     }
                });
            });   
        });
        $(function($){
            $("#contacto").mask("99999999", {  
                autoclear: false
            }); 
        }); 
    </script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div id="parent">   
            </div> 
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card panel-default">
                    <br>
                    <div class="card-heading text-center">
                        <h2 style="color:black;">Editar Gasolinera</h2> 
                    </div>
                    <br>
                    <div class="card-body">   
                        <div class="form-group row">
                                <label for="cedulaJuridica" class="col-md-4 col-form-label text-md-right" style="color:black;">{{ __('Cedula Jurídica') }}</label>

                                <div class="col-md-6">
                                    <input id="cedulaJuridica" type="text" class="form-control{{ $errors->has('cedulaJuridica') ? ' is-invalid' : '' }}" name="cedulaJuridica" value="{{ $gasolineras->cedulaJuridica }}" required autofocus readonly>
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label for="nombre" class="col-md-4 col-form-label text-md-right" style="color:black;">{{ __('Nombre') }}</label>

                                <div class="col-md-6">
                                    <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ $gasolineras->nombre }}" required autofocus>
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label for="ubicacion" class="col-md-4 col-form-label text-md-right" style="color:black;">{{ __('Ubicación') }}</label>

                                <div class="col-md-6">
                                    <input id="ubicacion" type="text" class="form-control{{ $errors->has('ubicacion') ? ' is-invalid' : '' }}" name="ubicacion" value="{{ $gasolineras->ubicacion }}" autofocus>
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label for="contacto" class="col-md-4 col-form-label text-md-right" style="color:black;">{{ __('Contacto') }}</label>

                                <div class="col-md-6">
                                    <input id="contacto" type="text" class="form-control contacto" name="contacto" value="{{ $gasolineras->contacto }}" required autofocus>
                                </div>
                            </div> 
                            <div class="form-group row">
                            <label for="correo" class="col-md-4 col-form-label text-md-right" style="color:black;">{{ __('Correo Electrónico') }}</label>

                            <div class="col-md-6">
                                <input id="correo" type="text" class="form-control{{ $errors->has('correo') ? ' is-invalid' : '' }}" name="correo" value="{{ $gasolineras->correo }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row"> 
                            <label class="col-md-4 col-form-label text-md-right" style="color:black;">{{ __('Estado de la gasolinera') }}</label>
                            <div class="col-md-6">
                                <select class="form-control" id="estado" name="estado">   
                                    <option id="estado" value="{{ $gasolineras->estado }}">{{ $gasolineras->estado }} </option>
                                    @if( $gasolineras->estado  == "Activo") 
                                        <option id="estado" value="Inactivo" required> Inactivo </option>   
                                    @else
                                        <option id="estado" value="Activo" required> Activo </option> 
                                    @endif
                                </select>
                            </div>
                        </div>  
                        <div>
                            <a href="{{ route('gasolineras.index') }}" class="btn bg-malibu-beach pull-left">
                                <i class="fas fa-angle-double-left" style="color:black">Regresar</i> 
                            </a>                                        
                            <button class="editar btn bg-happy-green pull-right">
                                <i class="fas fa-sync-alt" style="color:black"> Actualizar</i>
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

