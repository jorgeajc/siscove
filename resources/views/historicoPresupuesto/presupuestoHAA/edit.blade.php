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
                var montoFactura = $('#montoFactura').val(); 
                var fechaCreacion = $('#fechaCreacion').val(); 
                var placa = $('#placa').val(); 
                var numFactura = $('#numFactura').val(); 
                var idPAA = $('#idPAA').val(); 
                Swal.fire({
                    title: "¿Está Seguro de Realizar la Actualización?",
                    text:  "El Registro será Actualizado en el Sistema",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aceptar'   
                })
                .then((willDelete) => {
                    if (willDelete.value) { 
                        $.ajax({
                            url: "/guardarPHAA", 
                            type: 'POST', 
                            statusCode: {
                                302: function() { 
                                    setTimeout("location.href='/'", 100); 
                                }
                            },
                            data: {
                                    "montoFactura" : montoFactura,
                                    "fechaCreacion" : fechaCreacion,  
                                    "numFactura" : numFactura, 
                                    "placa" : placa, 
                                    "idPAA" : idPAA, 
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
                                        setTimeout("location.href='/historicoAA/"+idPAA+"'", 100); 
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
                            text:"Registro No Editado", 
                            type: "error", 
                            buttons: "Aceptar", 
                            confirmButtonText: 'Aceptar',
                            timer: 2000, });
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
                    {{ __('Ingresando Factura De Aires Acondicionados') }}
                </div> 
                    
                <div class="panel-body">  
                    <div class="form-group row" >
                        <label class="col-md-4 col-form-label text-md-right"> Código De Registro Aire Acondicionado </label>
                        <div class="col-md-3"> 
                            <input id="idPAA" style="text-align:right;" type="text" class="form-control " value="{{ $idPAA}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fechaCreacion" class="col-md-4 col-form-label text-md-right">{{ __('Fecha De Creación') }}</label> 
                        <div class="col-md-6">
                            <input id="fechaCreacion" type="date" class="form-control{{ $errors->has('fechaCreacion') ? ' is-invalid' : '' }}" name="fechaCreacion" value="{{ old('fechaCreacion') }}" required autofocus>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="placa" class="col-md-4 col-form-label text-md-right">{{ __('Placa Del Vehículo') }}</label> 
                        <div class="col-md-6">
                            <select class="form-control" id="placa" name="placa">
                                <option value="">Seleccione</option>
                                @foreach($vehiculos as $item)
                                    <option value="{{$item->placa}}" required>
                                    {{$item->placa}}, {{$item->marca}}, {{$item->modelo}} 
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div> 

                    <div class="form-group row">
                        <label for="numFactura" class="col-md-4 col-form-label text-md-right">{{ __('Numero De Factura') }}</label> 
                        <div class="col-md-6">
                            <input id="numFactura"style="text-align:right;" type="text" class="form-control{{ $errors->has('numFactura') ? ' is-invalid' : '' }}" name="numFactura" value="{{ old('numFactura') }}" required autofocus>
                        </div>
                    </div>    
                    <div class="form-group row">
                        <label for="montoFactura" class="col-md-4 col-form-label text-md-right">{{ __('Monto Total De La Factura') }}</label> 
                        <div class="col-md-6">
                            <input id="montoFactura" style="text-align:right;" type="text" class="form-control{{ $errors->has('montoFactura') ? ' is-invalid' : '' }}" name="montoFactura" value="{{ old('montoFactura') }}" required autofocus>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <button class="agregar btn btn-success pull-right">
                                <i class="fas fa-sync-alt" style="color:black">Guardar</i>
                            </button>  
                            <button class="btn btn-primary pull-left" onclick="window.location='{{ url('historicoAA', $idPAA) }}'">
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