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
    <link href="/css/formatMoney.css" rel="stylesheet" />
    <script type="text/javascript" src="/js/formatMoney.js"></script> 

    <script>
    $(document).ready(function(){
        $(".eliminarHC").click(function(){
            var idHC = $(this).data("id"); 
            var idPC = $('#idPC').val();
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
                if (willDelete.value)
                { 
                    $.ajax({
                        url: "/eliminarHistoricoC",
                        type: 'post',
                        statusCode: {
                            302: function() { 
                                setTimeout("location.href='/'", 100); 
                            }
                        },
                        data: { 
                            "idHC": idHC, 
                            "idPC": idPC, 
                            "_token": token,
                            _method: 'delete'
                             },
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
                                title:"¡Registro No Eliminado!", 
                                type: "error", 
                                buttons: "Aceptar", 
                                confirmButtonText: 'Aceptar',
                                timer:2000});
                                } 
                            }
                        });
                    }  
                else {
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
    });
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
    <div class="row" >  
        <div class="col-lg-12">  
            <div class="row" >
                <div class="card" > 
                    <div class="card-heading text-center" style="background-image:none;background: #ACB9CA;"> 
                        <h2 style="color:black">{{ __('Historial de Gastos del Presupuesto de Combustible') }}</h2>
                        <h3 style="color:black">{{ __('Municipalidad de Nicoya') }}</h3>  
                    </div>  
                    <div class="card-body"> 
                        <div style="display: none">
                            <label style="color:black"> Código de Registro</label> 
                            <input id="idPC" type="text" class="form-control " value="{{ $presupuestoC->idPC}}" readonly autofocus>
                        </div>  
                        <div class="form-row">
                            <div class="col-md-2">
                                <div class="position-relative form-group">
                                    <button class="btn bg-malibu-beach" style="color:black" onclick="window.location='{{ url('inicio') }}'">
                                        <i class="fas fa-angle-double-left" style="color:black">Regresar</i>
                                    </button>
                                </div> 
                            </div> 
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label style="color:black">Fecha de Registro: </label> 
                                    <label>{{ $presupuestoC->fechaRegistro }}</label>
                                </div>
                            </div> 
                            <div class="col-md-4">
                                <div class="position-relative form-group"> 
                                    <label style="color:black">Monto Actual: </label> 
                                    <label class="money">{{ $presupuestoC->montoRestante }}</label>   
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="position-relative form-group"> 
                                    <a class="btn bg-happy-green" href="{{ route('historicoC.crear',$presupuestoC->idPC) }}" style="color:black"><i class="fas fa-plus"> Nueva factura</i> </a>
                                </div>
                            </div>
                        </div>    
                        <table class="table">
                            <thead>
                                <tr> 
                                    <th>Fecha Creación</th>
                                    <th>Número de Cupón</th>
                                    <th>Número de Factura</th>
                                    <th>Placa</th>
                                    <th>Cant Litros</th>
                                    <th>Monto Factura</th>
                                    <th>Opciones</th> 
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach($presupuestoHC as $HC)
                                    <tr class="success">
                                        <td>{{$HC->fechaCreacion}}</td>
                                        <td>{{$HC->numeroCupon}}</td>
                                        <td>{{$HC->numeroFactura}}</td>
                                        <td>{{$HC->placa}}</td>
                                        <td>{{$HC->cantLitros}}</td>
                                        <td class="money">{{$HC->montoFactura}}</td>
                                        <td>
                                            <a class="btn bg-sunny-morning"><i class="fas fa-marker" style="color:black"></i></a> 
                                            <button class="eliminarHC btn bg-love-kiss" data-id="{{ $HC->idHC }}" style="color:black"><i class="fas fa-trash"></i> Eliminar</button>  
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