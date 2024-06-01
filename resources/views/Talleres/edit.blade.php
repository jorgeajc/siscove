@extends('welcome') 
@section('content')
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"> 
    <script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script> 
    <link href="/css/sweetAlert2Style.css" rel="stylesheet" />
    <script type="text/javascript" src="/js/jquery.maskedinput.js"></script> 
    <style type="text/css">
        .alert {
        display:inline-block;
    }
  </style>
  <script>
    $(document).ready(function(){
        $(".editar").click(function(){  
            var CedulaJuridica = $('#CedulaJuridica').val();
            var nombre = $('#nombre').val(); 
            var Ubicacion = $('#Ubicacion').val(); 
            var Contacto = $('#Contacto').val(); 
            var Correo = $('#Correo').val();  
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
                if (willDelete) { 
                    $.ajax({
                        url: "/editarTaller/" + CedulaJuridica, 
                        type: 'POST', 
                        statusCode: {
                                302: function() { 
                                    setTimeout("location.href='/'", 100); 
                                }
                            },
                        data: {
                                "nombre" : nombre,
                                "CedulaJuridica" : CedulaJuridica, 
                                "Ubicacion" : Ubicacion,
                                "Contacto" : Contacto,
                                "Correo" : Correo, 
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
                        buttons: "Aceptar", 
                        confirmButtonText: 'Aceptar'});
                        }
            });
        });  
        $(function($){
            $("#Contacto").mask("99999999", {  
                autoclear: false
            });  
        });  
    });   
   </script> 
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
                        <h5 class="card-title text-center" style="color:black">Editar Taller</h5>   
                        <div class="form-group row">
                            <label for="CedulaJuridica" class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Cedula Jurídica del Taller: ') }}</label> 
                            <div class="col-md-6">
                                <input id="CedulaJuridica" type="text" class="form-control" name="CedulaJuridica" value="{{ $talleresE->CedulaJuridica}}" required autofocus readonly>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Nombre del Taller: ') }}</label>     
                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control" name="nombre" value="{{ $talleresE->nombre}}" required autofocus>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="Ubicacion" class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Ubicación: ') }}</label> 
                            <div class="col-md-6">
                                <input id="Ubicacion" type="text" class="form-control{{ $errors->has('Ubicacion') ? ' is-invalid' : '' }}" name="Ubicacion" value="{{ $talleresE->Ubicacion }}" required autofocus>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="Contacto" class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Contacto: ' ) }}</label> 
                            <div class="col-md-6">
                                <input id="Contacto" type="text" class="form-control Contacto" name="Contacto" value="{{ $talleresE->Contacto }}" required autofocus>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="Correo" class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Correo Electrónico: ') }}</label> 
                            <div class="col-md-6">
                                <input id="Correo" type="text" class="form-control{{ $errors->has('Correo') ? ' is-invalid' : '' }}" name="Correo" value="{{ $talleresE->Correo }}" required autofocus>
                            </div>
                        </div>   
                        <div> 
                            <a href="{{ route('talleres.index')}}" class="btn bg-malibu-beach pull-left">
                                <i class="fas fa-angle-double-left" style="color:black">Regresar</i> 
                            </a>   
                            <button class="editar btn bg-happy-green  pull-right"> 
                                <i class="fas fa-sync-alt" style="color:black">{{ __('Actualizar') }}</i> 
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
