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
            $(".agregarHC").click(function(){ 
                var fechaCreacion = $('#fechaCreacion').val(); 
                var numeroCupon = $('#numeroCupon').val(); 
                var numeroFactura = $('#numeroFactura').val(); 
                var placa = $('#placa').val();
                var cantLitros = $('#cantLitros').val();
                var montoFactura = $('#montoFactura').val(); 
                var idPC = $('#idPC').val(); 
                Swal.fire({
                    title: "¿Está Seguro?",
                    text: "El Registro será Agregado al Sistema",
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
                            url: "/guardarPHC", 
                            type: 'POST', 
                            statusCode: {
                                302: function() { 
                                    setTimeout("location.href='/'", 100); 
                                }
                            },
                            data: {
                                    "fechaCreacion" : fechaCreacion,
                                    "numeroCupon" : numeroCupon,  
                                    "numeroFactura" : numeroFactura, 
                                    "placa" : placa, 
                                    "cantLitros" : cantLitros, 
                                    "montoFactura" : montoFactura, 
                                    "idPC" : idPC, 
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
                                        setTimeout("location.href='/historicoC/"+idPC+"'", 100); 
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
                            text:"Registro No Agregado", 
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
<br>
<br>
<br> 
    <div class="container">
        <div class="row">
            <div id="parent">   
            </div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-heading text-center">
                        <br>
                        <h2 style="color:black">{{ __('Factura de Combustible') }}</h2>
                        <br>
                    </div>  
                    <div class="card-body">  
                        <div class="form-group row" style="display: none">
                            <label class="col-md-4 col-form-label text-md-right" style="color:black"> Código del Registro: </label>
                            <div class="col-md-3"> 
                                <input id="idPC" style="text-align:right;" type="text" class="form-control " value="{{ $idPC}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fechaCreacion" class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Fecha de Creación: ') }}</label> 
                            <div class="col-md-6">
                                <input id="fechaCreacion" type="date" class="form-control{{ $errors->has('fechaCreacion') ? ' is-invalid' : '' }}" name="fechaCreacion" value="{{ old('fechaCreacion') }}" required autofocus>
                            </div>
                        </div>   
                        <div class="form-group row">
                            <label for="numeroCupon" class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Número de Cupón: ') }}</label> 
                            <div class="col-md-6">
                                <input id="numeroCupon" type="text" class="form-control{{ $errors->has('numeroCupon') ? ' is-invalid' : '' }}" name="numeroCupon" value="{{ old('numeroCupon') }}" required autofocus>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="numeroFactura" class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Número de Factura: ') }}</label> 
                            <div class="col-md-6">
                                <input id="numeroFactura" type="text" class="form-control{{ $errors->has('numeroFactura') ? ' is-invalid' : '' }}" name="numeroFactura" value="{{ old('numeroFactura') }}" required autofocus>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="placa" class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Placa del Vehículo: ') }}</label> 
                            <div class="col-md-6">
                                <select class="form-control" id="placa" name="placa">
                                    <option value="">Seleccione: </option>
                                    @foreach($vehiculos as $item)
                                        <option value="{{$item->placa}}" required>
                                        {{$item->placa}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="cantLitros" class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Cantidad de Litros: ') }}</label> 
                            <div class="col-md-6">
                                <input id="cantLitros" type="text" class="form-control{{ $errors->has('cantLitros') ? ' is-invalid' : '' }}" name="cantLitros" value="{{ old('cantLitros') }}" required autofocus>
                            </div>
                        </div>    
                        <div class="form-group row">
                            <label for="montoFactura" class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Monto Total de la Factura: ') }}</label> 
                            <div class="col-md-6">
                                <input id="montoFactura" type="text" class="form-control{{ $errors->has('montoFactura') ? ' is-invalid' : '' }}" name="montoFactura" value="{{ old('montoFactura') }}" required autofocus>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4"> 
                                <button class="btn bg-malibu-beach" onclick="window.location='{{ url('historicoC', $idPC) }}'">
                                    <i class="fas fa-angle-double-left" style="color:black">Regresar</i>
                                </button> 
                                <button class="agregarHC btn bg-happy-green pull-right  ">
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
<br>
@endsection 