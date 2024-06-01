@extends('welcome')

@section('content')

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script> 
        <link href="/css/sweetAlert2Style.css" rel="stylesheet" />  
        <style>
            #conductores {
                display: none;
            }
        </style>
        <script>
            $(document).ready(function(){ 
                if("{{$solicitudB->NecesitaConduc}}" == true){
                    document.getElementById('conductores').style.display='inline-block';
                } 
                $(".aceptarSoli").click(function(){ 
                    var idSolicitud = $(this).data("id");
                    var placa = $('#vehiculo').val();
                    var conductor = $('#conductor').val();
                    var fechaEntrega = $('#fechaEntrega').val();
                    var horaEntrega = $('#horaEntrega').val();
                    var fechaDevolucion = $('#fechaDevolucion').val();
                    var horaDevolucion = $('#horaDevolucion').val();
                    var token = $("meta[name='csrf-token']").attr("content"); 
                    if(placa == ""){
                        var descripcion = " <div class='alert alert-danger alert-dismissable'>"+
                                            "       <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>"+
                                            "           &times;"+
                                            "       </button> "+
                                            "        Vehiculo obligatorio"+    
                                            "   </div>";  
                        $("#placaMensaje").html(descripcion);    
                    }else{
                        if(conductor == "" && "{{$solicitudB->NecesitaConduc}}" == true){
                            var descripcion = " <div class='alert alert-danger alert-dismissable'>"+
                                            "       <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>"+
                                            "           &times;"+
                                            "       </button> "+
                                            "        Conductor obligatorio"+    
                                            "   </div>";   
                            $("#conductorMensaje").html(descripcion);  
                        }else{
                            Swal.fire({
                                title: "¿Está Seguro?",
                                text: "La Solicitud será Agregada al Sistema",
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Aceptar' , 
                                cancelButtonText: 'Cancelar' ,  
                            }) 
                            .then((willDelete) => {
                                if (willDelete.value) {
                                    $.ajax({
                                        url: "/aceptarSolicitud",
                                        type: 'POST',
                                        statusCode: {
                                            302: function() { 
                                                setTimeout("location.href='/'", 100); 
                                            }
                                        },
                                        data: { 
                                            "idSolicitud"       : idSolicitud, 
                                            "placa"             : placa,
                                            "conductor"         : conductor,
                                            "fechaEntrega"      : fechaEntrega,
                                            "horaEntrega"       : horaEntrega,
                                            "fechaDevolucion"   : fechaDevolucion,
                                            "horaDevolucion"    : horaDevolucion,
                                            "conductor"         : conductor,
                                            "_token"            : token, 
                                        },
                                        success: function (data){
                                            if($.isEmptyObject(data.errors)){
                                                Swal.fire({
                                                    title: "¡Solicitud Aceptada!", 
                                                    type: 'success',
                                                    showCancelButton: false,
                                                    confirmButtonColor: '#3085d6',
                                                    cancelButtonColor: '#d33',
                                                    confirmButtonText: 'Aceptar', 
                                                    timer:2000,
                                                }).then(function() {
                                                     location.href='/formAceptadasRechazadas/'+idSolicitud; 
                                                }); 
                                            }else{ 
                                                Swal.fire({
                                                    title:"¡Solicitud No Aceptada!", 
                                                    text: data.errors,
                                                    type: 'error', 
                                                    buttons: "Aceptar", 
                                                    confirmButtonText: 'Aceptar', 
                                                });
                                            } 
                                        }
                                    });
                                } else { 
                                    Swal.fire({
                                        title:"¡Cancelado!", 
                                        text:"Solicitud No Aceptada",
                                        type: "error", 
                                        buttons: "Aceptar", 
                                        confirmButtonText: 'Aceptar',
                                        timer: 2000,
                                    });
                                } 
                            });
                        } 
                    } 
                }); 
                $(".rechazarSoli").click(function(){ 
                    var idSolicitud = $(this).data("id"); 
                    
                    var token = $("meta[name='csrf-token']").attr("content");
                    Swal.fire({
                        title: "¿Está Seguro?",
                        text: "La Solicitud será Rechazada y no se Almacenará en el Sistema",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Aceptar' , 
                        cancelButtonText: 'Cancelar' ,  
                    }) 
                    .then((willDelete) => {
                        if (willDelete.value) {
                            $.ajax({
                                url: "/rechazarSolicitud/" + idSolicitud,
                                type: 'POST',
                                statusCode: {
                                    302: function() { 
                                        setTimeout("location.href='/'", 100); 
                                    }
                                },
                                data: { "idSolicitud": idSolicitud, "_token": token, },
                                success: function (data){
                                    if($.isEmptyObject(data.errors)){  
                                        Swal.fire({
                                        title: "¡Solicitud Rechazada!", 
                                        type: 'success',
                                        showCancelButton: false,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Aceptar', 
                                        timer:2000,
                                    }).then(function() {
                                        location.href='/formAceptadasRechazadas/'+idSolicitud; 
                                    }); 
                                    }else{
                                        Swal.fire({
                                            title:"¡Solicitud No Rechazada!", 
                                            type: "error", 
                                            buttons: "Aceptar", 
                                            confirmButtonText: 'Aceptar',
                                            timer: 2000,
                                        });
                                    } 
                                }
                            });
                        } else { 
                            Swal.fire({
                                title:"¡Cancelado!", 
                                text:"Solicitud No Rechazada",
                                type: "error", 
                                buttons: "Aceptar", 
                                confirmButtonText: 'Aceptar',
                                timer: 2000,
                            });
                        } 
                    }); 
                });
                $("#vehiculo").ready(function(){
                    var cantidad = $("#numPersonas").val();  
                    $.get('/buscarVehiculos/'+cantidad, function(data){ 
                        if(data.length > 0){
                            var descripcion = '<option value="">Seleccione</option>'
                            for (var i=0; i<data.length;i++){
                                    descripcion+='<option value="'+data[i].placa+'">'+data[i].placa+': '+data[i].marca+'</option>'; 
                            } 
                            $("#vehiculo").html(descripcion);   
                        }else{
                            var descripcion = '<option value="">No hay vehiculos disponibles</option>'
                            $("#vehiculo").html(descripcion);     
                        } 
                    });   
                }); 
                $("#vehiculo").change(function(){
                    var placa = $('#vehiculo').val();
                    if(placa != ""){
                        if("{{$solicitudB->NecesitaConduc}}" == true){ 
                            $.get('/buscarConductoresDisponibles/'+placa, function(data){ 
                                if(data.length > 0){
                                    var descripcion = '<option value="">Seleccione</option>'
                                    for (var i=0; i<data.length;i++){
                                        descripcion+='<option value="'+data[i].id+'">'  + data[i].id + ', ' 
                                                                                            + data[i].primerNombre +' ' 
                                                                                            + data[i].primerApellido +' '
                                                                                            + data[i].segundoApellido
                                                                                            + '</option>';  
                                    } 
                                    $("#conductor").html(descripcion);  
                                    document.getElementById('conductores').style.display='inline-block';
                                }else{
                                    var descripcion = '<option value="">No hay conductores disponibles</option>'
                                    document.getElementById('conductores').style.display='inline-block';
                                    $("#conductor").html(descripcion);  
                                } 
                            });     
                        }
                    } 
                }); 
            });
        </script>
    </head>
    <body> 
        <div class="tab-content">
            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <div class="text-center"> 
                            <h2  style="color: orange;">Solicitud Pendiente</h2>
                        </div> 
                        <div class="form-horizontal" style="border:ridge black 1px">
                            <br>
                            <h4 style="color:black" class="text-center"> Datos de Solicitante</h4>
                            <br>
                            <div class="form row" style="margin:1%">
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <h6><label for="cedula" style="color:black">{{ __('Cédula: ') }}</label></h6>
                                        <input id="id" type="text" class="form-control" name="cedula" value="{{$solicitudB->id}}" required autofocus readonly>
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <h6><label for="nombreCompleto" style="color:black">{{ __('Nombre Completo: ') }}</label></h6>
                                        <input id="nombreCompleto" type="text" class="form-control" name="nombreCompleto" value="{{$solicitudB->primerNombre}} {{$solicitudB->segundoNombre}} {{$solicitudB->primerApellido}} {{$solicitudB->segundoApellido }}" required autofocus readonly>
                                    </div>
                                </div> 
                            </div> 
                            <div class="form-row" style="margin:1% ">  
                                <div  class="col-md-4">
                                    <div class="position-relative form-group">
                                        <h6><label for="departamento" style="color:black">{{ __('Departamento: ') }}</label></h6>
                                        <input id="departamento" type="text" class="form-control" name="departamento" value="{{$solicitudB->departamento }}" required autofocus readonly>
                                    </div> 
                                </div>  
                                <div  class="col-md-4">
                                    <div class="position-relative form-group">
                                        <h6><label for="telefono"  style="color: black;">{{ __('Teléfono: ') }}</label></h6>
                                        <input id="telefono" type="text" class="form-control" name="telefono" value="{{$solicitudB->telefono }}" required autofocus readonly>
                                    </div> 
                                </div> 
                                <div  class="col-md-4">
                                    <div class="position-relative form-group">
                                        <h6><label for="email"  style="color: black">{{ __('Email: ') }}</label></h6>
                                        <input id="email" type="text" class="form-control" name="email" value="{{$solicitudB->email }}" required autofocus readonly>
                                    </div> 
                                </div>   
                            </div> 
                            <br>   
                        </div>
                        <br>
                        <div class="form-horizontal" style="border:ridge black 1px">
                            <br>
                            <h3 style="color:black" class="text-center">Datos del Viaje</h3>
                            <br>
                            <div class="form-group row" style="margin:1%">
                                <h6><label for="descripcion" class="col-md-8 col-form-label text-md-right" style="color:black">{{ __('Motivo de la Solicitud: ') }}</label></h6> 
                                <div class="col-md-6">
                                    <textarea id="descripcion" type="text" rows="6" cols="8" class="form-control " name="descripcion" value="{{$solicitudB->descripcion}}" required autofocus readonly>{{$solicitudB->descripcion}}</textarea>
                                </div>
                            </div>  
                            <div class="form row" style="margin:1%">
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <h6><label for="destino" style="color:black">{{ __('Destino del Viaje: ') }}</label></h6> 
                                        <input id="destino" type="text" class="form-control" name="destino" value="{{ $solicitudB->destino}}" required autofocus readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <h6><label for="numPersonas" style="color:black">{{ __('Número de Personas: ') }}</label></h6>
                                        <input id="numPersonas" type="text" class="form-control " name="numPersonas" value="{{$solicitudB->numPersonas}}" required autofocus readonly>
                                    </div>
                                </div>  
                            </div> 
                            <div class="form row" style="margin:1%">
                                <div class="col-md-6" id="vehiculos">
                                    <div class="position-relative form-group"> 
                                        <h6><label style="color:black"> Vehículo Disponible: </label></h6>
                                        <select name="vehiculo" id="vehiculo" class="form-control" required>
                                            <option value="">Seleccione</option>
                                        </select> 
                                    </div>
                                    <div id="placaMensaje">   
                                    </div> 
                                </div> 
                                <div class="col-md-6" id="conductores">  
                                    <div class="position-relative form-group">  
                                        <h6><label style="color:black"> Conductores Disponibles: </label></h6>  
                                        <select name="conductor" id="conductor" class="form-control" required>
                                            <option value="">Seleccione</option>
                                        </select>  
                                    </div>
                                    <div id="conductorMensaje">   
                                    </div>  
                                </div> 
                            </div> 
                            <div class="form row" style="margin:1%"> 
                                <div class="col-md-3">
                                    <div class="position-relative form-group"> 
                                        <h6><label style="color:black">Fecha de Entrega: </label></h6>
                                        <input id="fechaEntrega" type="date" class="form-control " name="fechaEntrega" value="{{$solicitudB->fechaEntrega}}" required autofocus readonly>
                                    </div>
                                </div> 
                                <div class="col-md-3">
                                    <div class="position-relative form-group"> 
                                        <h6><label style="color:black">Hora de Entrega: </label></h6>
                                        <input id="horaEntrega" type="time" class="form-control " name="horaEntrega" value="{{$solicitudB->horaEntrega}}" required autofocus readonly>
                                    </div>
                                </div> 
                                <div class="col-md-3">
                                    <div class="position-relative form-group"> 
                                        <h6><label style="color:black">Fecha de Devolución: </label></h6>
                                        <input id="fechaDevolucion" type="date" class="form-control " name="fechaDevolucion" value="{{$solicitudB->fechaDevolucion}}" required autofocus readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="position-relative form-group"> 
                                        <h6><label  style="color:black">Hora de Devolución: </label></h6>
                                        <input id="horaDevolucion" type="time" class="form-control " name="horaDevolucion" value="{{$solicitudB->horaDevolucion}}" required autofocus readonly>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <br>
                        <br>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">  
                                <a href="{{ route('solicitud.index')}}" 
                                    class="btn bg-malibu-beach"><i class="fas fa-angle-double-left" style="color:black">Regresar</i>  
                                </a>
                                <button id="botonRechazar" class="rechazarSoli btn bg-love-kiss" data-id="{{$solicitudB->idSolicitud}}">
                                    <i class=" fa fa-times" style="color:black;"> Rechazar</i>
                                </button>  
                                <button id="botonAceptar" class="aceptarSoli btn bg-happy-green pull-right" data-id="{{$solicitudB->idSolicitud}}">
                                    <i target = "_ blank" class="fas fa-check-double" style="color:black"> Aceptar</i>
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