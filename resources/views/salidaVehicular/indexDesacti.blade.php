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
                        <div class="card-heading text-center">
                            <h2 style="color:black">Registros de Ingreso y Salida del Vehículo </h2> 
                        </div>
                        <div class="card-body">    
                            <div class="form-row">
                                <div class="col-md-4" style="text-align: left;"> 
                                    <button class="btn bg-malibu-beach" onclick="window.location='{{ url('vistaDesactivadosV') }}'">
                                        <i class="fas fa-angle-double-left" style="color:black">Regresar</i>
                                    </button> 
                                </div>  
                                <div class="col-md-4">
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
                                                    <a class="btn bg-happy-itmeo" href="{{ route('showDesactivado', array($SalidaVehicular->id, $vehiculo->placa))}}" style="color: black;"><i class="fas fa-eye"> Detalles</i></a> 
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
