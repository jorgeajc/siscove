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
        $(document).ready(function() {  
            $('.table').DataTable({
                "language": {
                    "url": "/json/Spanish.json"
                },
              "order": [[ 0, "desc" ]]
            }); 
            setTimeout(refrescar, 120000);
            cancelar();
        });
        function refrescar(){  
            location.reload();
        }
        function cancelar(){
            $(".cancelar").click(function(){ 
                var solicitud = $(this).data("id"); 
                var token = $("meta[name='csrf-token']").attr("content");
                Swal.fire({
                    title: "¿Está Seguro de cancelar esta solicitud?",
                    text: "No podrá volver a enviarla, tendrá que hacer otra",
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
                            url: "cancelarSolicitud",
                            type: 'POST',
                            statusCode: {
                                302: function() { 
                                    setTimeout("location.href='/'", 100); 
                                }
                            },
                            data: { "solicitud": solicitud, "_token": token, },
                            success: function (data){   
                                if($.isEmptyObject(data.errors)){
                                    Swal.fire({
                                        title: "¡Registro Cancelado con Éxito!", 
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
                                        title:"¡Solicitud No Cancelada!", 
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
                            text: "Registro No Cancelado",
                            type: "error", 
                            buttons: "Aceptar", 
                            confirmButtonText: 'Aceptar',
                            timer: 2000,
                        });
                    } 
                }); 
            }); 
        }
    </script>
</head>
<body>
    <div class="row">
        <div class="col-lg-12"> 
            <div class="row" > 
                <div class="col-md-3 col-xl-3">
                    <div class="card mb-3 widget-content bg-arielle-smile">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading"> <h4>Total de Solicitudes</h4> </div> 
                                <div class="widget-subheading"><h5 style="color:transparent">.</h5></div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white"><span>{{$filtros->cantidadT}}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-xl-3">
                    <div class="card mb-3 widget-content bg-happy-green">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading"> <h4>Solicitudes</h4></div>
                                <div class="widget-subheading"><h5>Aceptadas</h5></div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white"><span>{{$filtros->cantidadA}}</span></div>
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="col-md-3 col-xl-3">
                    <div class="card mb-3 widget-content bg-love-kiss">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading"> <h4>Solicitudes</h4></div>
                                <div class="widget-subheading"><h5>Rechazadas</h5> </div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white"><span>{{$filtros->cantidadR}}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-xl-3">
                    <div class="card mb-3 widget-content bg-sunny-morning">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading"> <h4>Solicitudes</h4></div>
                                <div class="widget-subheading"><h5>Pendientes</h5> </div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white"><span>{{$filtros->cantidadP}}</span></div>
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="card">
                    <div class="card-heading text-center">
                        <h2  style="color: black">Mis solicitudes</h2>
                    </div> 
                    <div class="card-body"> 
                        <table class="table" >
                            <thead>
                                <tr>       
                                    <th>Fecha/hora<br>Creación</th>
                                    <th>Fecha<br>Entrega</th>
                                    <th>Fecha<br>Devolución</th> 
                                    <th>Detalles</th>
                                    <th>Teléfono</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach ($solicitud as $solicitudes)
                                    <tr> 
                                        <td data-sort="{{ date('Y-m-d H:i', strtotime($solicitudes->created_at))}}">{{ date('d/m/Y H:i', strtotime($solicitudes->created_at))}}</td>
                                        <td data-sort="{{ date('Y-m-d H:i', strtotime($solicitudes->fechaEntrega))}}">{{ date('d/m/Y H:i', strtotime($solicitudes->fechaEntrega))}}</td>
                                        <td data-sort="{{ date('Y-m-d H:i', strtotime($solicitudes->fechaDevolucion))}}">{{ date('d/m/Y H:i', strtotime($solicitudes->fechaDevolucion)) }}</td>
                                        <td>
                                            <span class="badge badge-info" style="color:white">Destino:</span> {{$solicitudes->destino}} 
                                            <br> 
                                            <span class="badge badge-info" style="color:white">Descripción:</span> {{$solicitudes->descripcion}}
                                        </td>
                                        <td>{{$solicitudes->telefono}}</td>
                                        <td>
                                            @if($solicitudes->estado == "Aceptada")
                                                <span class="badge badge-pill badge-success" style="color:white">{{$solicitudes->estado}}</span>
                                                @elseif($solicitudes->estado == "Rechazada")
                                                    <span class="badge badge-pill badge-danger" style="color:white">{{$solicitudes->estado}}</span>
                                                    @elseif($solicitudes->estado == "Cancelada")
                                                        <span class="badge badge-pill badge-secondary" style="color:white">{{$solicitudes->estado}}</span>
                                                        @else
                                                            <span class="badge badge-pill badge-warning" style="color:white">{{$solicitudes->estado}}</span> 
                                            @endif 
                                        </td>
                                        <td> 
                                            <a class="btn bg-happy-itmeo" href="{{ route('solicitud.myShow', $solicitudes->idSolicitud) }}" style="color: black;"><i class="fas fa-eye"> Detalles</i></a>
                                            @if($solicitudes->estado == "Pendiente")
                                                <button class="cancelar btn bg-love-kiss" style="color: black;" data-id="{{$solicitudes->idSolicitud}}"><i class="fas fa-times-circle" style="color:black"> Cancelar</i></button> 
                                                <a class="btn bg-sunny-morning" style="color: black;" href="{{ route('solicitud.edit', $solicitudes->idSolicitud) }}"><i class="fas fa-edit"> Editar</i> </a>
                                            @endif
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
@endsection   