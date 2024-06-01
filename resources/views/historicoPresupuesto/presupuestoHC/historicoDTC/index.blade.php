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
                var idHDTC = $(this).data("id"); 
                var idDTC = $('#idDTC').val();
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
                            url: "/eliminarHistoricoDTC",
                            type: 'post',
                            statusCode: {
                                302: function() { 
                                    setTimeout("location.href='/'", 100); 
                                }
                            },
                            data: { 
                                "idHDTC": idHDTC, 
                                "idDTC": idDTC, 
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
                    } else {
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
                    <div class="card-body"> 
                        <div class="card-heading text-center"> 
                            <h2 style="color:black">{{ __('Historial de Gastos del Presupuesto de desarrollo urbano para combustible') }}</h2>
                            <h3 style="color:black">{{ __('Municipalidad de Nicoya') }}</h3>  
                        </div>  
                        <input id="idDTC" value="{{ $presupuestoDTC->idDTC}}" style="display: none"> 
                        <div class="form-row">
                            <div class="col-md-2" style="text-align: left;">
                                <div class="position-relative form-group">
                                    <button class="btn bg-malibu-beach" style="color:black" onclick="window.location='{{ url('inicio') }}'">
                                        <i class="fas fa-angle-double-left" style="color:black">Regresar</i>
                                    </button>
                                </div> 
                            </div> 
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label>Fecha de Registro: </label>  
                                    <label>{{ date('d/m/Y', strtotime($presupuestoDTC->fechaRegistro))}}</label>
                                </div>
                            </div> 
                            <div class="col-md-4">
                                <div class="position-relative form-group"> 
                                    <label>Monto Actual: </label> 
                                    <label class="money">{{ $presupuestoDTC->montoRestante }}</label>   
                                </div>
                            </div>
                            <div class="col-md-2" style="text-align: right;">
                                <div class="position-relative form-group"> 
                                    <a class="btn bg-happy-green" href="{{ route('historicoDTC.crear',$presupuestoDTC->idDTC) }}" style="color:black"><i class="fas fa-plus"> Nueva factura</i> </a>
                                </div>
                            </div>
                        </div>    
                        <table class="table">
                            <thead>
                                <tr> 
                                    <th>Fecha Creación</th>
                                    <th>Número de Cupón</th>
                                    <th>Número de Factura</th>
                                    <th>Vehículo</th>
                                    <th>Gasolinera</th>
                                    <th>Cant litros</th>
                                    <th>Monto factura</th>
                                    <th>Opciones</th> 
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach($presupuestoHDTC as $HC)
                                    <tr class="success">
                                        <td data-sort="{{ date('Y-m-d', strtotime($HC->fechaCreacion))}}">{{ date('d/m/Y', strtotime($HC->fechaCreacion))}}</td> 
                                        <td>{{$HC->numeroCupon}}</td>
                                        <td>{{$HC->numeroFactura}}</td>
                                        <td>{{$HC->placa}}</td>
                                        <td>{{$HC->gasolinera}}</td>
                                        <td>{{$HC->cantLitros}}</td>
                                        <td class="money">{{$HC->montoFactura}}</td>
                                        <td>  
                                            <button class="eliminarHC btn bg-love-kiss" data-id="{{ $HC->idHDTC }}" style="color:black"><i class="fas fa-trash"></i> Eliminar</button>  
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