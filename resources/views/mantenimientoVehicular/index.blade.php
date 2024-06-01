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
    <link href="/css/table.css" rel="stylesheet" /> 
    <script>
        $(document).ready(function(){
            $(".eliminar").click(function(){
                var idMV = $(this).data("id");  
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
                            url: "/eliminarMV/"+idMV,
                            type: 'post',
                            statusCode: {
                                302: function() { 
                                    setTimeout("location.href='/'", 100); 
                                }
                            },
                            data: {"idMV": idMV,   _method: 'delete', _token: token}, 
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
                                }else{
                                    Swal.fire({
                                    title:"¡Registro no eliminado!", 
                                    type: "error", 
                                    buttons: "Aceptar", 
                                    confirmButtonText: 'Aceptar'});
                                    } 
                            }
                        });
                    }else {
                        Swal.fire({
                            title:"¡Cancelado!", 
                            text: "Registro No Eliminado",
                            type: "error", 
                            buttons: "Aceptar", 
                            confirmButtonText: 'Aceptar',
                            timer: 2000,}); 
                        }
                });
            });
        });
        $(document).ready(function() {
            //$.noConflict();
            $('.table').DataTable({
                    "language": {
                        "url": "/json/Spanish.json"
                    }
                });
        } );
    </script>
</head>
<body>  
    <div class="row"> 
        <div class="col-md-12">  
            <div class="row"> 
                <div class="col-md-6 col-xl-4">
                    <div class="card mb-3 widget-content bg-happy-itmeo">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading"><h4>Total de Mantenimientos</h4></div> 
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white"><span>{{$mantenimiento->count()}}</span></div>
                            </div>
                        </div>
                    </div>
                </div>    
                <div class="card" > 
                    <div class="card-body"> 
                        <div class="form-row"> 
                            <div class="col-md-4" style="text-align: left;">
                                <button class="btn bg-malibu-beach " onclick="window.location='{{ url('vehiculos') }}'">
                                    <i class="fas fa-angle-double-left" style="color:black">Regresar</i>
                                </button>
                            </div>   
                            <div class="col-md-4" style="text-align: center;">
                                <h2 style="color: black;">Historial de Mantenimiento Vehicular</h2>  
                            </div>    
                            <div class="col-md-4" style="text-align: right;">
                                <div class="position-relative form-group">   
                                    <a class="btn bg-happy-green" href="{{ route('crearMantenimiento',$vehiculo->placa) }}" style="color:black"><i class="fas fa-plus"></i> Nuevo Mantenimiento </a>    
                                </div>
                            </div>
                        </div> 
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label style="color: black;"> Placa</label> 
                                    <input id="placa" type="text" class="form-control " value="{{ $vehiculo->placa }}"  readonly autofocus>
                                </div> 
                            </div> 
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label style="color: black;"> Marca</label> 
                                    <input id="marca" type="text" class="form-control " value="{{ $vehiculo->marca }}"  readonly autofocus>
                                </div>
                            </div> 
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label style="color: black;"> Modelo</label> 
                                    <input id="modelo" type="text" class="form-control" name="fecha" value="{{ $vehiculo->modelo }}" readonly>
                                </div>
                            </div>
                        </div>    
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr> 
                                        <th>Fecha Ingreso</th>
                                        <th>Propietario</th>
                                        <th>Tipo de Vehículo</th>
                                        <th>Placa</th>
                                        <th>Motor</th> 
                                        <th>Placa</th> 
                                        <th>Kilometros</th> 
                                        <th>Descripcion</th> 
                                        <th>Opciones</th> 
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach($mantenimiento as $MV)
                                        <tr class="success">
                                            <td>{{$MV->fechaIngreso}}</td>
                                            <td>{{$MV->propietario}}</td>
                                            <td>{{$MV->tipoVehiculo}}</td>
                                            <td>{{$MV->placa}}</td>
                                            <td>{{$MV->Motor}}</td>
                                            <td>{{$MV->modelo}}</td>
                                            <td>{{$MV->kilometros}}</td> 
                                            <td>{{$MV->descripcion}}</td>
                                            <td>
                                                <a class="btn bg-sunny-morning " href="{{ route('mantenimientoVehicular.edit',$MV->idMV ) }}"><i class="fas fa-edit" style="color:black"> Editar</i></a> 
                                                <button class="eliminar btn bg-love-kiss" data-id="{{ $MV->idMV }}" style="color:black"><i class="fas fa-trash"> Eliminar</i> </button>  
                                            </td>
                                        </tr> 
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $mantenimiento->render()!!}
                        </div>  
                    </div> 
                </div>
            </div> 
        </div> 
     </div> 
</body>
</html>
@endsection 