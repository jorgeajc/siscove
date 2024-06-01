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
            $(".editarPresuMeca").click(function(){ 
                var idPMC = $('#idPMC').val(); 
                var fechaRegistro = $('#fechaRegistro').val(); 
                var montoEstablecido = $('#montoEstablecido').val(); 
                Swal.fire({
                    title: "¿Está Seguro de Realizar la Actualización?", 
                    text:"El Registro será Actualizado en el Sistema",
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
                            url: "/editarPMC/"+idPMC, 
                            type: 'POST', 
                            statusCode: {
                                302: function() { 
                                    setTimeout("location.href='/'", 100); 
                                }
                            },
                            data: {
                                    "idPMC" : idPMC,
                                    "fechaRegistro" : fechaRegistro,
                                    "montoEstablecido" : montoEstablecido,  
                                    _token: '{{csrf_token()}}' 
                                    },
                            success: function(data) {
                                if($.isEmptyObject(data.errors)){ 
                                    Swal.fire({
                                        title: "¡Registro Actualizado!",  
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
                    }  else {
                            Swal.fire({
                            title:"¡Cancelado!", 
                            text:"Registro No Editado",
                            type: "error", 
                            buttons: "Aceptar", 
                            confirmButtonText: 'Aceptar',
                            timer:2000,});
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
                <div class="card">
                    <div class="card-heading text-center">
                        <br>
                        <h2 style="color:black">Editar Presupuesto para Mecánica de Carro<h2>
                        <br>
                    </div> 
                    <div class="card-body">  
                        <div class="form-group row"  style="display:none">
                            <label for="idPMC" class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Código: ') }}</label> 
                            <div class="col-md-6">
                                <input id="idPMC" type="text" class="form-control{{ $errors->has('idPMC') ? ' is-invalid' : '' }}" name="identificador" value="{{ $presupuestoMC->idPMC}}" readonly autofocus>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="fecha" class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Fecha: ') }}</label> 
                            <div class="col-md-6">
                                <input id="fechaRegistro" type="date" class="form-control{{ $errors->has('fecha') ? ' is-invalid' : '' }}" name="fecha" value="{{ $presupuestoMC->fechaRegistro }}" required autofocus>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="monto" class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Monto Establecido: ') }}</label> 
                            <div class="col-md-6">
                                <input id="montoEstablecido" type="text" class="form-control{{ $errors->has('monto') ? ' is-invalid' : '' }}" name="monto" value="{{ $presupuestoMC->montoEstablecido }}" required autofocus>
                            </div>
                        </div>  
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <button class="btn bg-malibu-beach" onclick="window.location='{{ url('inicio') }}'">
                                    <i class="fas fa-angle-double-left" style="color:black">Regresar</i>  
                                </button>
                                <button class="editarPresuMeca btn bg-happy-green pull-right">
                                    <i class="fas fa-sync-alt" style="color:black">Actualizar</i>
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