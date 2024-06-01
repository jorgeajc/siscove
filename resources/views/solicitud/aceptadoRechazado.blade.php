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
            //$.noConflict();
            $('.table').DataTable({
                    "language": {
                        "url": "/json/Spanish.json"
                    },
                    "order": [[ 0, "desc" ]]
                });
        } );
    </script> 
</head>
<body>
    <div class="row"> 
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-arielle-smile">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading"><h4>Total de Solicitudes</h4></div>
                        <div class="widget-subheading"><h5>Procesadas</h5> </div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>{{$solicitudTotal->count()}}</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-happy-green">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading"><h4>Total de Solicitudes</h4></div>
                        <div class="widget-subheading"><h5>Aceptadas</h5></div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>{{$solicitudAceptada->count()}}</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-love-kiss">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading"><h4>Total de Solicitudes</h4></div>
                        <div class="widget-subheading"><h5>Rechazadas</h5> </div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>{{$solicitudRechazada->count()}}</span></div>
                    </div>
                </div>
            </div>
        </div> 
    </div>  
    <div class="row"> 
        <div class="col-lg-6">  
            <div class="card">
                <div class="card-heading text-center">
                    <h2  style="color:Green;">Solicitudes Aceptadas</h2>
                </div>
                <div class="card-body"> 
                        <table class="table" >
                            <thead>
                                <tr>       
                                    <th>Fecha de Creación</th>
                                    <th>Fecha Entrega</th>
                                    <th>Fecha Devolución</th>
                                    <th>Solicitante</th>
                                    <th>Teléfono</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach ($aceptada as $aceptadas)
                                    <tr> 
                                        <td data-sort="{{ date('Y-m-d H:i', strtotime($aceptadas->created_at))}}">{{ date('d/m/Y H:i', strtotime($aceptadas->created_at))}}</td>
                                        <td data-sort="{{ date('Y-m-d H:i', strtotime($aceptadas->fechaEntrega))}}">{{ date('d/m/Y H:i', strtotime($aceptadas->fechaEntrega))}}</td>
                                        <td data-sort="{{ date('Y-m-d H:i', strtotime($aceptadas->fechaDevolucion))}}">{{ date('d/m/Y H:i', strtotime($aceptadas->fechaDevolucion))}}</td>
                                        <td>{{$aceptadas->id}} <br> {{$aceptadas->solicitante}}</td>
                                        <td>{{$aceptadas->telefono}}</td>
                                        <td>
                                            <span class="badge badge-pill badge-success" style="color:white">{{$aceptadas->estado}}</span>
                                        </td>
                                        <td> 
                                            <a class="btn bg-happy-itmeo" href="{{ route('solicitud.formAceptadasRechazadas', $aceptadas->idSolicitud) }}" style="color: black;"><i class="fas fa-eye"> Detalles</i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table> 
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-heading text-center">
                    <h2  style="color:Red;">Solicitudes Rechazadas</h2>
                </div>
                <div class="card-body"> 
                        <table class="table" >
                            <thead>
                                <tr>       
                                    <th>Fecha de Creación</th>
                                    <th>Fecha Entrega</th>
                                    <th>Fecha Devolución</th>
                                    <th>Solicitante</th>
                                    <th>Teléfono</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach ($rechazada as $rechazadas)
                                    <tr> 
                                        <td data-sort="{{ date('Y-m-d H:i', strtotime($rechazadas->created_at))}}">{{ date('d/m/Y H:i', strtotime($rechazadas->created_at))}}</td>
                                        <td data-sort="{{ date('Y-m-d H:i', strtotime($rechazadas->fechaEntrega))}}">{{ date('d/m/Y H:i', strtotime($rechazadas->fechaEntrega))}}</td>
                                        <td data-sort="{{ date('Y-m-d H:i', strtotime($rechazadas->fechaDevolucion))}}">{{ date('d/m/Y H:i', strtotime($rechazadas->fechaDevolucion))}}</td>
                                        <td>{{$rechazadas->id}} <br> {{$rechazadas->solicitante}}</td>
                                        <td>{{$rechazadas->telefono}}</td>
                                        <td>
                                            <span class=" badge badge-pill badge-danger" style="color:white">{{$rechazadas->estado}}</span>
                                        </td>
                                        <td> 
                                            <a class="btn bg-happy-itmeo" href="{{ route('solicitud.formAceptadasRechazadas', $rechazadas->idSolicitud) }}" style="color: black;"><i class="fas fa-eye"> Detalles</i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table> 
                </div>
            </div> 
        </div>
    </div>
</body>
</html>
@endsection   