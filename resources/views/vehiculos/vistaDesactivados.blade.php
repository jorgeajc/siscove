@extends('welcome')

@section('content') 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script> 
    <link href="/css/table.css" rel="stylesheet" />
    <link href="/css/sweetAlert2Style.css" rel="stylesheet" /> 
    <script> 
        $(document).ready(function(){   
            $(".activar").click(function(){ 
                var placa = $(this).data("id"); 
                var token = $("meta[name='csrf-token']").attr("content");
                
                    Swal.fire({
                        title: "¿Está Seguro de Habilitar este Vehículo?",
                        text: "Este Vehículo Podrá Ser Usado de Nuevo en el Sistema",
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
                                url: "activarVehiculo/"+placa,
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
                                        title: "¡Registro Activado!",
                                        text:"Lo encontrará en vehiculos activos",
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
                                            title:"¡Registro No Activado!", 
                                            type: "error", 
                                            buttons: "Aceptar", 
                                            confirmButtonText: 'Aceptar'});
                                    } 
                                }
                            });
                        } else {
                            Swal.fire({
                                title:"¡Cancelado!",
                                text: "Registro No Activado", 
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
            <div class="row">  
                <div class="col-md-6 col-xl-5">
                    <div class="card mb-3 widget-content bg-love-kiss">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading"><h3>Vehículos Desactivados</h3></div>
                                <div class="widget-subheading"><h4>Tipo Carro</h4> </div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white"><span>{{$carros}}</span></div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-md-6 col-xl-5">
                    <div class="card mb-3 widget-content bg-love-kiss">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading"><h3>Vehículos Desactivados</h3></div>
                                <div class="widget-subheading"><h4>Tipo Moto</h4></div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white"><span>{{$motos}}</span></div>
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="card panel-default"> 
                    <div class="card-body">
                        <div class="form-row"> 
                            <div class="col-md-4" style="text-align: left;">
                                <a class="btn bg-malibu-beach" style="color: black;" href="{{ route('vehiculos.index') }}">Ir a vehiculos Activos </a> 
                            </div>   
                            <div class="col-md-4" style="text-align: center;">
                                <h2 style="color: black;">Registro de Vehículos Inactivos</h2> 
                            </div>     
                        </div> 
                        <div class="table-responsive"> 
                            <table class="table">
                                <thead>
                                    <tr> 
                                        <th>Estado</th>
                                        <th>Tipo</th>
                                        <th>Placa</th>
                                        <th>Marca</th>
                                        <th>Modelo</th>
                                        <th>Vencimiento Marchamo</th>
                                        <th>Vencimiento RTV</th> 
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
                                                <span class="badge badge-danger" style="color:white">{{$ve->estado}}</span>   
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
                                                <button  class="activar btn bg-happy-green " style="color: black;" data-id="{{$ve->placa}}" style="color:whites"><i class="fas fa-plus" style="color:black"> Activar</i> </button>   
                                                <a class="btn bg-happy-itmeo" style="color: black;" href="{{ route('index_desactivados', $ve->placa) }}"><i class="fas fa-car-crash"> Mantenimiento</i></a>    
                                                <a class="btn bg-happy-itmeo" style="color: black;" href="{{ route('indexDesactivadoSE', $ve->placa) }}"><i class="fas fa-arrow-alt-circle-left"> Salida <i class="fas fa-car"></i> Entrada</i><i class="fas fa-arrow-alt-circle-right"></i></a>
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