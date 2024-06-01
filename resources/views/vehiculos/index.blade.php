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
    <link href="/css/table.css" rel="stylesheet" />
    <link href="/css/sweetAlert2Style.css" rel="stylesheet" />  
    <link href="/css/3puntos.css" rel="stylesheet" />  
    <script src="/js/3puntos.js" type="text/javascript"></script>   
    <script> 
        $(document).ready(function(){  
            $(".eliminar").click(function(){
                var placa = $(this).data("id"); 
                
                var token = $("meta[name='csrf-token']").attr("content");
                Swal.fire({
                    title: "¿Está Seguro de Eliminar el Registro?",
                    text: "El Registro No Podrá Recuperarse",
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
                            url: "/eliminarVehiculo/"+placa,
                            type: 'post',
                            statusCode: {
                                302: function() { 
                                    setTimeout("location.href='/'", 100); 
                                }
                            },
                            data: {"placa": placa, _method: 'delete', _token: token}, 
                            success: function (data){
                                if($.isEmptyObject(data.errors)){   
                                    Swal.fire({
                                        title: "¡Registro Eliminado del Sistema!",
                                        type: 'success',
                                        showCancelButton: false,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Aceptar',
                                        timer: 2000,
                                    }).then(function() {
                                        setTimeout("location.reload();"); 
                                    }); 
                                }else{
                                    Swal.fire({
                                        title:"¡Registro No Eliminado!", 
                                        text: data.errors,
                                        type: "error", 
                                        buttons: "Aceptar", 
                                        confirmButtonText: 'Aceptar',
                                        timer: 5000,
                                    });
                                } 
                            }
                        });
                    } else {
                        Swal.fire({
                            title:"¡Cancelado!", 
                            text: "Registro No eliminado",
                            type: "error", 
                            buttons: "Aceptar", 
                            confirmButtonText: 'Aceptar',
                            timer: 2000,
                        });
                    }
                });
            });
            $(".desactivar").click(function(){ 
                var placa = $(this).data("id"); 
                var token = $("meta[name='csrf-token']").attr("content");
                    Swal.fire({
                        title: "¿Está Seguro de Inhabilitar este Vehículo?",
                        text: "Este Registro No Podrá Seguir Siendo Usado, Deberá Activarlo de Nuevo en la Tabla de Vehículos Desactivados",
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
                                url: "desactivarVehiculo/"+placa,
                                type: 'POST',
                                statusCode: {
                                    302: function() { 
                                        setTimeout("location.href='/'", 100); 
                                    }
                                },
                                data: { "placa": placa, "_token": token, },
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
                                        setTimeout("location.reload();"); 
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
                                text: "Registro No Desactivado",
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
    <style>
        .fa-2x {
            line-height: 1;
        } 
        div.dropdown-menu.show{  
            max-width:590px; 
            padding: 6px 10px; 
        }
    </style>
</head>
<body>      
    <div class="row">
        <div class="col-lg-12">
            <div class="row"> 
                <div class="col-md-6 col-xl-4">
                    <div class="card mb-3 widget-content bg-arielle-smile">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading"><h3>Total de Vehículos</h3></div>
                                <div class="widget-subheading"><h4>Registrados</h4></div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white"><span>{{$vehiculos->count()}}</span></div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-md-6 col-xl-4">
                    <div class="card mb-3 widget-content bg-arielle-smile">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading"><h3>Vehículos</h3></div>
                                <div class="widget-subheading"> <h4>Tipo Carro</h4></div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white"><span>{{$carros}}</span></div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-md-6 col-xl-4">
                    <div class="card mb-3 widget-content bg-arielle-smile">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading"><h3>Vehículos</h3></div>
                                <div class="widget-subheading"><h4>Tipo Moto</h4> </div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white"><span>{{$motos}}</span></div>
                            </div>
                        </div>
                    </div>
                </div>   
                <div class="card"> 
                    <div class="card-body"> 
                        <div class="form-row"> 
                            <div class="col-md-4" style="text-align: left;">
                                <a class="btn bg-love-kiss" style="color: black;" href="{{ route('vehiculo.vistaDesactivados') }}">Vehiculos Desactivados</a> 
                            </div>   
                            <div class="col-md-4" style="text-align: center;">
                                <h2 style="color: black;">Registro de Vehículos</h2>
                            </div>    
                            <div class="col-md-4" style="text-align: right;">
                                <div class="position-relative form-group">   
                                    <a class="btn bg-happy-green" style="color: black;"href="{{ route('vehiculos.create') }}"><i class="fas fa-plus"> Nuevo Vehículo</i></a>    
                                </div>
                            </div>
                        </div> 
                        <table class="table table-hover" >
                            <thead>
                                <tr> 
                                    <th>Estado</th>
                                    <th>Tipo</th>
                                    <th>Placa</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Vencimiento Marchamo</th>
                                    <th>Vencimiento riteve</th> 
                                    <th>
                                        Visitas al Taller 
                                    </th> 
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach ($vehiculos as $ve)
                                    <tr> 
                                        <td>
                                            @if($ve->estado == "Activo")
                                                <span class="badge badge-success" style="color:black">{{$ve->estado}}</span>
                                            @else
                                                <span class="badge badge-warning" style="color:black">{{$ve->estado}}</span>
                                            @endif   
                                        </td>
                                        <td>
                                            @if($ve->tipo == "carro")
                                                <i class="fas fa-car fa-2x"></i>
                                            @else
                                                <i class="fas fa-motorcycle fa-2x"></i>
                                            @endif   
                                        </td>
                                        <td>{{$ve->placa}}</td> 
                                        <td>{{$ve->marca}}</td>
                                        <td>{{$ve->modelo}}</td>
                                        <td style="color:red;">{{ date('d/m/Y', strtotime($ve->marchamo)) }}</td>
                                        <td style="color:red;">{{ date('d/m/Y', strtotime($ve->riteve)) }}</td>
                                        <td>{{$ve->count}}</td>  
                                        <td> 
                                            <div class="active show">  
                                                <button class="btn btn-light btn-circle end-btn dropdown-toggle" type="button" id="btn-opc" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="opciones">
                                                    <i class="fas fa-ellipsis-h fa-lg"></i>
                                                </button>  
                                                <div class="dropdown-menu"> 
                                                    <a class="btn bg-sunny-morning" style="color: black;" href="{{ route('vehiculos.edit', $ve->placa) }}"><i class="fas fa-edit"> Editar</i> </a>
                                                    <a class="btn bg-happy-itmeo" style="color: black;" href="{{ route('vistaInicio', $ve->placa) }}"><i class="fas fa-car-crash"> Mantenimiento</i></a>
                                                    <a class="btn bg-happy-itmeo" style="color: black;" href="{{ route('vistaInicial', $ve->placa) }}"><i class="fas fa-arrow-alt-circle-left"> Salida <i class="fas fa-car"></i> Entrada</i><i class="fas fa-arrow-alt-circle-right"></i></a>
                                                    <button class="desactivar btn bg-love-kiss" style="color: black;" data-id="{{$ve->placa}}"><i class="fas fa-times-circle" style="color:black"> Desactivar</i></button> 
                                                    <button class="eliminar btn bg-love-kiss" style="color: black;" data-id="{{$ve->placa}}"><i class="fas fa-trash"> Eliminar</i> </button>  
                                                </div>  
                                            </div>   
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
</body>
</html>
<br>
@endsection   