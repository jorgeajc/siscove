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
        <script>  
            $(document).ready(function(){
                $(".eliminar").click(function(){
                    var id = $(this).data("id");
                    
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
                                url: "/eliminarSV/"+id,
                                type: 'post',
                                statusCode: {
                                    302: function() { 
                                        setTimeout("location.href='/'", 100); 
                                    }
                                },
                                data: {"id": id, _method: 'delete', _token: token},
                                success: function (data){
                                    if($.isEmptyObject(data.errors)){   
                                        Swal.fire({
                                            title: "¡Registro Eliminado del Sistema!",  
                                            type: 'success',
                                            showCancelButton: false,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'Aceptar' 
                                        }).then(function() {
                                            setTimeout("location.reload();", 100); 
                                        }); 
                                    }
                                    else
                                    {
                                        Swal.fire({
                                        title:"¡Registro En Uso!", 
                                        text: "El Registro No Puede Ser Eliminado",
                                        type: "error", 
                                        buttons: "Aceptar", 
                                        confirmButtonText: 'Aceptar'
                                        });
                                    } 
                                }
                            });
                        }
                        else
                        { 
                            Swal.fire({
                                title:"¡Cancelado!", 
                                text: "Registro No Eliminado",
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
        <div class="row">
            <div class="col-lg-12"> 
                <div class="row" >   
                    <div class="card"> 
                        <div class="card-body">  
                            <div class="form-row">
                                <div class="col-md-4"></div>  
                                <div class="col-md-4" style="text-align: center;">
                                    <h2 style="color:black">Registros de Ingreso y Salida del Vehículo </h2>  
                                </div> 
                            </div>   
                            <div class="form-row"> 
                                <div class="col-md-2" style="text-align: left;">
                                    <button class="btn bg-malibu-beach" onclick="window.location='{{ url('vehiculos') }}'">
                                        <i class="fas fa-angle-double-left" style="color:black">Regresar</i>
                                    </button>
                                </div>   
                                <div class="col-md-7">
                                    <div class="card mb-3 widget-content bg-arielle-smile">
                                        <div class="widget-content-wrapper text-white"> 
                                            <div class="widget-content-left">
                                                <div class="widget-numbers text-white"><span>{{ $vehiculo->marca }} {{ $vehiculo->modelo }}</span></div> 
                                            </div> 
                                            <div class="widget-content-right">
                                                <div class="widget-numbers text-white"><span>{{ $vehiculo->placa }}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>   
                                <div class="col-md-3" style="text-align: right;">
                                    <div class="position-relative form-group">   
                                        <a class="btn bg-happy-green pull-left" style="color: black;" href="{{ route('salidaVehicular.create',  $vehiculo->placa ) }}"> <i class="fas fa-plus"> Nuevo Registro</i></a>   
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive"> 
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Oficina Solicitante</th> 
                                            <th>F.Autorizacion de Salida</th> 
                                            <th>F.Autorizacion de Ingreso</th> 
                                            <th>Total Kilometraje recorrido</th> 
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($salidaVehicular as $SalidaVehicular)
                                            <tr>
                                                <td>{{$SalidaVehicular->oficinaSolicitante}}</td>
                                                <td>{{ date('d/m/Y', strtotime($SalidaVehicular->fechaAutorizacionSalida))}}</td>
                                                <td>{{ date('d/m/Y', strtotime($SalidaVehicular->fechaAutorizacionIngreso))}}</td> 
                                                <td>{{$SalidaVehicular->totalKm}}</td>
                                                <td> 
                                                    <a class="btn bg-sunny-morning" href="{{ route('salidaVehicular.edit',  array($SalidaVehicular->id, $vehiculo->placa)) }}"><i class="fas fa-edit" style="color:black"> Editar</i></a>
                                                    <a class="btn bg-happy-itmeo" href="{{ route('salidaVehicular.show', array($SalidaVehicular->id, $vehiculo->placa))}}" style="color: black;"><i class="fas fa-eye"> Detalles</i></a>
                                                    <button class="eliminar btn bg-love-kiss"" data-id="{{ $SalidaVehicular->id }}" style="color:black"><i class="fas fa-trash"> Eliminar</i></button>  
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
    </body>
</html>
@endsection 
