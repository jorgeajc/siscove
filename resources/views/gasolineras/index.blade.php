@extends('welcome')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title> 
    <link href="/css/table.css" rel="stylesheet" />
    <script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script> 
    <link href="/css/sweetAlert2Style.css" rel="stylesheet" /> 
    <script>
        $(document).ready(function(){
            $(".eliminar").click(function(){
                var cedulaJuridica = $(this).data("id");
                var token = $("meta[name='csrf-token']").attr("content");

                Swal.fire({
                    title: "¿Está seguro de eliminar el registro?",
                    text: "El registro no podrá recuperarse",
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
                            url: "eliminarGasolinera/"+cedulaJuridica,
                            type: 'post',
                            statusCode: {
                                302: function() { 
                                    setTimeout("location.href='/'", 100); 
                                }
                            },
                            data: { "cedulaJuridica": cedulaJuridica, "_token": token, _method: 'delete'},
                            success: function (data){
                                if($.isEmptyObject(data.errors)){  
                                    Swal.fire({
                                        title: "¡Registro eliminado del sistema!",
                                        type: 'success',
                                        showCancelButton: false,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Aceptar' 
                                    }).then(function() {
                                        setTimeout("location.reload();", 100); 
                                    }); 
                                }else{
                                    Swal.fire({
                                        title: data.errors, 
                                        text: "El registro no puede ser eliminado",
                                        type: "error", 
                                        buttons: "Aceptar", 
                                        confirmButtonText: 'Aceptar'  
                                    }); 
                                } 
                            }
                        });
                    } else {
                        Swal.fire({
                            title:"¡Cancelado!", 
                            text: "Registro no eliminado",
                            type: "error", 
                            buttons: "Aceptar", 
                            confirmButtonText: 'Aceptar',
                            timer: 2000,  
                        }); 
                    }
                });
            });  
            $(".desactivar").click(function(){ 
                var cedulaJuridica = $(this).data("id"); 
                var token = $("meta[name='csrf-token']").attr("content");
                    Swal.fire({
                        title: "¿Está Seguro de Inhabilitar esta Gasolinera?",
                        text: "¡Este Registro No Podrá Seguir Siendo Usado \n ,Deberá Activarlo de Nuevo en la Tabla de Gasolineras Desactivadas!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Aceptar'   
                    }) 
                    .then((willDelete) => {
                        if (willDelete.value) {
                            $.ajax({
                                url: "desactivarGasolinera/"+cedulaJuridica,
                                type: 'post', 
                                statusCode: {
                                    302: function() { 
                                        setTimeout("location.href='/'", 100); 
                                    }
                                },
                                data: { "cedulaJuridica": cedulaJuridica, "_token": token},
                                success: function (data){
                                    if($.isEmptyObject(data.errors)){  
                                        Swal.fire({
                                        title: "¡Registro Desactivado con Éxito!",
                                        type: 'success',
                                        showCancelButton: false,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Aceptar' 
                                    }).then(function() {
                                        setTimeout("location.reload();", 100); 
                                    }); 
                                    }else{
                                        Swal.fire({
                                            title:"¡Registro No Desactivado!", 
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
                                type: "error", 
                                buttons: "Aceptar", 
                                confirmButtonText: 'Aceptar',
                                timer: 2000,  
                            }); 
                        } 
                    }); 
            }); 
            $('.table').DataTable({
                "language": {
                    "url": "/json/Spanish.json"                    
                }
            });  
        });  
    </script>
</head>
<body> 
    <div class="row" >  
        <div class="col-lg-12">  
            <div class="row" > 
                <div class="col-md-6 col-xl-4">
                    <div class="card mb-3 widget-content bg-arielle-smile">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading"><h4>Total de Gasolineras</h4></div>
                                <div class="widget-subheading"><h5>Registrados</h5></div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white"><span>{{$gasolineras->count()}}</span></div>
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="card"> 
                    <div class="card-body"> 
                        <div class="form-row">
                            <div class="col-md-4" style="text-align: left;">
                                <a class="btn bg-love-kiss" href="{{ route('gasolinera.vistaDesactivados') }}" style="color:black;">Gasolineras Desactivadas</a>   
                            </div>   
                            <div class="col-md-4" style="text-align: center;">
                                <h2  style="color:black">Registro de Gasolineras Activas</h2> 
                            </div>    
                            <div class="col-md-4" style="text-align: right;">
                                <div class="position-relative form-group">   
                                    <a class="btn bg-happy-green" href="{{ route('gasolineras.create') }}" style="color:black;"><i class="fas fa-plus"></i> Nueva Gasolinera </a> 
                                </div>
                            </div>
                        </div> 
                        <div class="table-responsive"> 
                            <table class="table"> 
                                <thead>
                                    <tr>
                                        <th colspan="1"> Identificación</th>
                                        <th >Nombre</th>  
                                        <th >Ubicación</th>  
                                        <th >Teléfono de Contacto</th>  
                                        <th >Correo Electrónico</th>  
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($gasolineras as $gas)
                                        <tr>
                                            <td>{{$gas->cedulaJuridica}}</td>
                                            <td>{{$gas->nombre}}</td>
                                            <td>{{$gas->ubicacion}}</td>
                                            <td>{{$gas->contacto}}</td>
                                            <td>{{$gas->correo}}</td>
                                            <td>  
                                                <a class="btn bg-sunny-morning"  href="{{ route('gasolineras.edit', $gas->cedulaJuridica) }}" style="color:black;"><i class="fas fa-edit"> Editar</i></a>
                                                <button class="desactivar btn bg-love-kiss" data-id="{{$gas->cedulaJuridica}}" style="color:black;"><i class="fas fa-times-circle" style="color:black"> Desactivar</i></button> 
                                                <button class="eliminar btn bg-love-kiss" data-id="{{$gas->cedulaJuridica}}" style="color:black;"><i class="fas fa-trash"> Eliminar</i> </button>  
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
@endsection 
</body>
</html>
    
