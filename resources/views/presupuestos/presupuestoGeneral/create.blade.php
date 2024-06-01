@extends('welcome') 

@section('content') 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
    <script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script>  
    <link href="/css/sweetAlert2Style.css" rel="stylesheet" />
    <style type="text/css">
    .alert {
        display:inline-block;
    }
  </style>
    <script>
        $(document).ready(function(){ 
            $(".agregar").click(function(){ 
                var monto = $('#monto').val(); 
                var fecha = $('#fecha').val(); 
                Swal.fire({
                    title: "¿Está seguro de guardar registro?",
                    text:  "¿Está seguro de guardar registro?",
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
                            url: "/guardarPG", 
                            type: 'POST', 
                            statusCode: {
                                302: function() { 
                                    setTimeout("location.href='/'", 100); 
                                }
                            },
                            data: {
                                    "montoEstablecido" : monto,
                                    "fechaRegistro" : fecha,  
                                    _token: '{{csrf_token()}}' 
                                    },
                            success: function(data) {
                                if($.isEmptyObject(data.errors)){ 
                                    Swal.fire({
                                        title: "¡Registro Agregado!",  
                                        type: 'success',
                                        showCancelButton: false,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Aceptar' 
                                    }).then(function() {
                                        setTimeout("location.href='/inicio'", 100); 
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
                        Swal.fire("¡Registro no Agregado!", {icon: "error", buttons: "Aceptar", confirmButtonText: 'Aceptar',});
                    }
                });
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
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        {{ __('Ingresando Monto General') }}
                    </div> 
                    <div class="panel-body">  
                        <div class="form-group row">
                            <label for="fecha" class="col-md-4 col-form-label text-md-right">{{ __('Fecha') }}</label> 
                            <div class="col-md-6">
                                <input id="fecha" type="date" class="form-control{{ $errors->has('fecha') ? ' is-invalid' : '' }}" name="fecha" value="{{ old('fecha') }}" required autofocus>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="monto" class="col-md-4 col-form-label text-md-right">{{ __('Monto establecido') }}</label> 
                            <div class="col-md-6">
                                <input id="monto" type="text" class="form-control{{ $errors->has('monto') ? ' is-invalid' : '' }}" name="monto" value="{{ old('monto') }}" required autofocus>
                            </div>
                        </div>  
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                            <button class="agregar btn btn-success pull-right">
                                    <i class="fas fa-check-double" style="color:black">Guardar</i>
                                </button>  
                                <button class="btn btn-primary pull-left" onclick="window.location='{{ url('inicio') }}'">
                                    <i class="fas fa-angle-double-left" style="color:black">Regresar</i>
                                </button>  
                            </div>
                        </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
</body>
</html>
@endsection 