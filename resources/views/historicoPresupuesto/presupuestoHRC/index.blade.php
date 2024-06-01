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
            $(".eliminarH").click(function(){
                var idHRC = $(this).data("id"); 
                var idPRC = $('#idPRC').val();
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
                            url: "/eliminarHRC",
                            type: 'post',
                            statusCode: {
                                302: function() { 
                                    setTimeout("location.href='/'", 100); 
                                }
                            },
                            data: { 
                                "idHRC": idHRC, 
                                "idPRC": idPRC, 
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
                                    //Swal.fire("¡Registro no Eliminado!", {type: 'success',icon: "error", buttons: "Aceptar", });
                                    Swal.fire({
                                        title:"¡Registro No Eliminado!", 
                                        type: "error", 
                                        buttons: "Aceptar", 
                                        confirmButtonText: 'Aceptar',
                                        timer:2000,});

                                        } 
                                }
                            });
                    }else {
                        // Swal.fire("¡Registro no Eliminado!", {type: 'error',icon: "error", buttons: "Aceptar", });
                        Swal.fire({
                            title:"¡Cancelado!", 
                            text:"Registro No Eliminado",
                            type: "error", 
                            buttons: "Aceptar", 
                            confirmButtonText: 'Aceptar',
                            timer:2000,
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
            <div class="row">  
                <div class="card">  
                    <div class="card-body"> 
                        <div class="card-heading text-center"> 
                            <h2 style="color:black">{{ __('Historial de Gastos del Presupuesto de Repuestos de Carros') }}</h2>  
                            <h3 style="color:black">{{ __('Municipalidad de Nicoya') }}</h3> 
                        </div>  
                        <div style="display: none"><input id="idPRC"value="{{ $presupuestoRC->idPRC}}"></div>     
                        <div class="form-row"> 
                                <div class="col-md-2" style="text-align: left;">
                                    <button class="btn bg-malibu-beach" style="color:black" onclick="window.location='{{ url('inicio') }}'">
                                        <i class="fas fa-angle-double-left" style="color:black">Regresar</i>
                                    </button>  
                                </div>      
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label style="color:black"> Fecha de Creación del Presupuesto: </label> 
                                        <label>{{ date('d/m/Y', strtotime($presupuestoRC->fechaRegistro))}}</label>
                                    </div>
                                </div> 
                                <div class="col-md-4">
                                    <div class="position-relative form-group"> 
                                        <label style="color:black"> Monto Actual: </label>
                                        <label class="money">{{ $presupuestoRC->montoRestado }}</label>   
                                    </div>
                                </div> 
                                <div class="col-md-2" style="text-align: right;">
                                    <div class="position-relative form-group">   
                                        <a class="btn bg-happy-green" href="{{ route('historicoRC.crear',$presupuestoRC->idPRC) }}" style="color:black"><i class="fas fa-plus"> Nueva factura</i> </a> 
                                    </div>
                                </div>
                            </div>   
                        <table class="table">
                            <thead>
                                <tr> 
                                    <th>Fecha Creación</th>
                                    <th>Placa</th>
                                    <th>Número de Factura</th>
                                    <th>Monto factura</th>
                                    <th>Opciones</th> 
                                </tr>
                            </thead>
                            <tbody>  
                                    @foreach($presupuestoHRC as $HRC)
                                    <tr class="success">
                                        <td data-sort="{{ date('Y-m-d', strtotime($HRC->fechaCreacion))}}">{{ date('d/m/Y', strtotime($HRC->fechaCreacion))}}</td>   
                                        <td>{{$HRC->placa}}</td>
                                        <td>{{$HRC->numFactura}}</td>
                                        <td class="money">{{$HRC->montoFactura}}</td>
                                        <td>
                                            <button class="eliminarH btn bg-love-kiss" data-id="{{ $HRC->idHRC }}" style="color:black"><i class="fas fa-trash"></i> Eliminar</button>  
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



