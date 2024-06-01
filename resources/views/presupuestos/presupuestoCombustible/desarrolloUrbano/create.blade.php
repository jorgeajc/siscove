@extends('welcome') 

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script> 
    <link href="/css/sweetAlert2Style.css" rel="stylesheet" />
    <style type="text/css">
        .alert { display:inline-block; }
    </style> 
    <script>
        $(document).ready(function()
        {
            $(".agregarCombustible").click(function(){ 
                var fechaRegistro = $('#fechaRegistro').val(); 
                var montoEstablecido = $('#montoEstablecido').val();  
                Swal.fire({
                    title: "¿Está Seguro?",
                    text:  "El Registro será Agregado al Sistema" ,
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
                            url: "/guardarDUC", 
                            type: 'POST', 
                            statusCode: {
                                302: function() { 
                                    setTimeout("location.href='/'", 100); 
                                }
                            },
                            data: {
                                    "fechaRegistro" : fechaRegistro,
                                    "montoEstablecido" : montoEstablecido,
                                    _token: '{{csrf_token()}}' 
                                    },
                            success: function (data){
                                if($.isEmptyObject(data.errors)){ 
                                    Swal.fire({
                                        title: "¡Registro Agregado!",
                                        type: 'success',
                                        showCancelButton: false,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Aceptar',
                                    }).then(function() {
                                        setTimeout("location.href='/inicio'", 100); 
                                    });
                                }
                                else{
                                    var descripcion = " <div class='alert alert-danger alert-dismissable'>"+
                                                        "       <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>"+
                                                        "           &times;"+
                                                        "       </button> "+
                                                        "        Solucione los Siguientes Errores"+    
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
                        text:"Registro no Agregado",
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
                        <h2 style="color:black">Nuevo Presupuesto para Combustible</h2> 
                        <br>
                    </div>
                    <div class="card-body "> 
                        <div class="form-group row">
                            <label for="fechaRegistro" class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Fecha: ') }}</label>
                            <div class="col-md-6">
                                <input id="fechaRegistro" type="date" class="form-control{{ $errors->has('fechaRegistro') ? ' is-invalid' : '' }}" name="fechaRegistro" value="{{ old('fechaRegistro') }}" required autofocus>

                                @if ($errors->has('fechaRegistro'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fechaRegistro') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="montoEstablecido" class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Monto Establecido: ') }}</label>
                            <div class="col-md-6">
                                <input id="montoEstablecido" type="text" class="form-control{{ $errors->has('montoEstablecido') ? ' is-invalid' : '' }}" name="montoEstablecido" value="{{ old('montoEstablecido') }}" required autofocus>

                                @if ($errors->has('montoEstablecido'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('montoEstablecido') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row" >
                            <div class="col-md-6 offset-md-4">  
                                <a href="{{ route('presupuestos.inicio')}}"  class="btn bg-malibu-beach">
                                    <i class="fas fa-angle-double-left" style="color:black">Regresar</i>  
                                </a>  
                                <button class="agregarCombustible btn bg-happy-green pull-right">
                                    <i class="fas fa-check-double" style="color:black">Guardar</i>
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