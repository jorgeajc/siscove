@extends('welcome')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
                            url: "eliminarDeparta/"+id,
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
    <div class="row" >   
        <div class="col-lg-12">         
            <div class="row" id="centrarContenido">   
                <!-- <div class="col-md-6 col-xl-3"></div>    -->
                <div class="col-md-6 col-xl-4">
                    <div class="card mb-3 widget-content bg-arielle-smile">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading"><h4>Total de Departamentos</h4></div>
                                <div class="widget-subheading"><h5>Registrados</h5> </div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white"><span>{{$departamentos->count()}}</span></div>
                            </div>
                        </div>
                    </div>
                </div>   
                <div class="card" id="panel-departas">  
                    <div class="card-body">  
                        <div class="form-row"> 
                            <div class="col-md-4" style="text-align: left;"></div>   
                            <div class="col-md-4" style="text-align: center;">
                                <h2 style="color:black">Registro de Departamentos</h2>
                            </div>    
                            <div class="col-md-4" style="text-align: right;">
                                <div class="position-relative form-group">   
                                    <a class="btn bg-happy-green" href="{{ route('departamentos.create') }}" style="color:black; padding: 10px"><i class="fas fa-plus"> Nuevo Departamento</i> </a> 
                                </div>
                            </div>
                        </div> 
                        <div class="table-responsive">
                            <table class="table" id="table-departas">
                                <thead>
                                    <tr>
                                        <th>Departamentos</th> 
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($departamentos as $Departamentos)
                                        <tr>
                                            <td>{{$Departamentos->nombreDeparta}}</td>
                                            <td style="text-align:center">
                                                {{csrf_field()}}
                                                <a class="btn bg-sunny-morning" href="{{ route('departamentos.edit', $Departamentos->id) }}"><i class="fas fa-edit" style="color:black"> Editar     </i> </a>
                                                <button class="eliminar btn bg-love-kiss" data-id="{{ $Departamentos->id }}" style="color:black"><i class="fas fa-trash"> Eliminar</i> </button>  
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
@endsection 
</body>
</html>
   
