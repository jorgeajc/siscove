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
            //Cada 10 segundos (10 000 milisegundos)  
            setTimeout(refrescar, 120000);
        });
        function refrescar(){  
            location.reload();
        }
    </script>
</head>
<body>
    <div class="row">
        <div class="col-lg-12"> 
            <div class="row" > 
                <div class="col-md-6 col-xl-4">
                    <div class="card mb-3 widget-content bg-sunny-morning">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading"> <h3>Total de Solicitudes</h3> </div> 
                                <div class="widget-subheading"><h3>Pendientes</h3> </div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white"><span>{{$solicitud->count()}}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card mb-3 widget-content bg-arielle-smile">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading"> <h3>Total de Solicitudes</h3> </div> 
                                <div class="widget-subheading"><h4>Procesadas</h4></div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white"><span>{{$solicitudTotal}}</span></div>
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="card">
                    <div class="card-heading text-center">
                        <h2  style="color: black;">Solicitudes Pendientes</h2>
                    </div> 
                    <div class="card-body"> 
                        <table class="table" >
                            <thead>
                                <tr>    
                                    <th>Fecha/hora<br>Creación</th>   
                                    <th>Fecha<br>Entrega</th>
                                    <th>Fecha<br>Devolución</th>
                                    <th>Solicitante</th>
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
                                        <td>{{$solicitudes->id}} <br> {{$solicitudes->solicitante}}</td>
                                        <td>
                                            <span class="badge badge-info" style="color:white">Destino:</span> {{$solicitudes->destino}} 
                                            <br> 
                                            <span class="badge badge-info" style="color:white">Descripción:</span> {{$solicitudes->descripcion}}
                                        </td>
                                        <td>{{$solicitudes->telefono}}</td>
                                        <td>
                                            <span class="badge badge-pill badge-warning" style="color:white">{{$solicitudes->estado}}</span>
                                        </td>
                                        <td> 
                                            <a class="btn bg-happy-itmeo" href="{{ route('solicitud.show', $solicitudes->idSolicitud) }}" style="color: black;"><i class="fas fa-eye"> Detalles</i></a>
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