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
            $(".editar").click(function(){ 
                console.log({{$ManVe->idMV}});
                var idMV = {{$ManVe->idMV}};
                var tipoVehiculo = $('#tipoVehiculo').val(); 
                var motor = $('#motor').val(); 
                var modelo = $('#modelo').val(); 
                var fechaIngreso = $('#fechaIngreso').val(); 
                var placa = $('#placa').val();  
                var kilometros = $('#kilometros').val(); 
                var descripcion = $('#descripcion').val(); 
                var propietario = $('#propietario').val(); 
              
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
                            url: "/editarMV", 
                            type: 'POST',
                            statusCode: {
                                302: function() { 
                                    setTimeout("location.href='/'", 100); 
                                }
                            }, 
                            data: {
                                    "tipoVehiculo" : tipoVehiculo, 
                                    "motor" : motor, 
                                    "modelo" : modelo, 
                                    "fechaIngreso" : fechaIngreso, 
                                    "placa" : placa,  
                                    "kilometros" : kilometros, 
                                    "descripcion" : descripcion, 
                                    "propietario" : propietario, 
                                    "idMV" : idMV, 
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
                                        setTimeout("location.href='/vistaInicio/"+placa+"'", 100); 
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
                            text: "Registro No Editado",
                            type: "error", 
                            buttons: "Aceptar", 
                            confirmButtonText: 'Aceptar',
                            timer: 2000,}); 
                    }
                });
            }); 
            
        });  
   </script>

</head>
<body> 
    <div class="row justify-content-center">
        <div class="row">
            <div id="parent">   
            </div> 
        </div>
    </div>  
    <div class="tab-content">
        <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
            <div class="main-card mb-3 card"> 
                <div class="card-body">
                    <h2 style="color:black"> Editar Historial de Mecánica</h2>  
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">  
                                <label   style="color: black"> Placa: </label> 
                                <input id="placa" type="text" class="form-control " value="{{ $ManVe->placa }}"  readonly autofocus> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="position-relative form-group">  
                                <label   style="color: black"> Marca: </label>  
                                <input id="marca" type="text" class="form-control " value="{{ $vehiculo->marca}}" readonly autofocus>
                            </div>
                        </div> 
                        <div class="col-md-4">
                            <div class="position-relative form-group">  
                                <label   style="color: black">Modelo: </label>   
                                <input id="modelo" type="text" class="form-control" name="fecha" value="{{ $ManVe->modelo }}" readonly autofocus>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">  
                                <label for="fechaIngreso" style="color: black">{{ __('Fecha De Ingreso: ') }}</label>  
                                <input id="fechaIngreso" type="date" class="form-control" name="fechaIngreso" value="{{ $ManVe->fechaIngreso}}" required autofocus>  
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="position-relative form-group">  
                                <label for="propietario" style="color: black">{{ __('Propietario: ') }}</label>  
                                <input id="propietario" type="text" class="form-control" name="propietario" value="{{ $ManVe->propietario}}" required autofocus> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="position-relative form-group">  
                                <label for="motor"   style="color: black">{{ __('Motor: ') }}</label>  
                                <input id="motor" type="text" class="form-control" name="motor" value="{{$ManVe->Motor}}" required autofocus>  
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">   
                                <label for="tipoVehiculo"   style="color: black">{{ __('Tipo de Vehículo: ') }}</label>  
                                <input id="tipoVehiculo"type="text" class="form-control" name="tipoVehiculo" value="{{$ManVe->tipoVehiculo}}" required  >  
                            </div> 
                        </div> 
                        <div class="col-md-4">
                            <div class="position-relative form-group">  
                                <label for="kilometros"   style="color: black">{{ __('Kilómetros: ') }}</label> 
                                <input id="kilometros" type="text" class="form-control " name="kilometros" value="{{ $ManVe->kilometros}}" required autofocus>
                            </div>
                        </div>
                    </div>  
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="position-relative form-group">  
                                <label for="descripcion"   style="color: black">{{ __('Descripción: ') }}</label>  
                                <textarea id="descripcion" rows="6" cols="8" class="form-control " name="descripcion" required autofocus><?=$ManVe->descripcion?></textarea>
                            </div>  
                        </div>
                    </div>  
                    <div> 
                        <button class="btn bg-malibu-beach" onclick="window.location='{{ url('vistaInicio', $ManVe->placa) }}'">
                            <i class="fas fa-angle-double-left" style="color:black">Regresar</i>
                        </button> 
                        <button class="editar pull-right btn bg-happy-green">
                            <i class="fas fa-sync-alt" style="color:black">Actualizar</i>
                        </button>    
                    </div> 
                </div>
            </div>
        </div>
    </div> 
</body>
</html>
@endsection 