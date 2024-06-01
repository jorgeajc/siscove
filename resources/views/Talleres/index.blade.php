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
                var CedulaJuridica = $(this).data("id");
                console.log(CedulaJuridica);
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
                            url: "/eliminarTalleres/"+CedulaJuridica,
                            type: 'post',
                            statusCode: {
                                302: function() { 
                                    setTimeout("location.href='/'", 100); 
                                }
                            },
                            data: {"CedulaJuridica": CedulaJuridica, _method: 'delete', _token: token}, 
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
                                    title:"¡Registro En Uso!", 
                                    text: "El Registro No Puede Ser Eliminado",
                                    type: "error", 
                                    buttons: "Aceptar", 
                                    confirmButtonText: 'Aceptar'}); 
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
            $(".desactivar").click(function(){ 
                var cedulaJuridica = $(this).data("id"); 
                var token = $("meta[name='csrf-token']").attr("content");
                    Swal.fire({
                        title: "¿Está Seguro de Inhabilitar este Taller?",
                        text: "¡Este Registro No Podrá Seguir Siendo Usado \n ,Deberá Activarlo de Nuevo en la Tabla de Talleres Desactivados!",
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
                                url: "desactivarTaller/"+cedulaJuridica,
                                type: 'POST',
                                statusCode: {
                                    302: function() { 
                                        setTimeout("location.href='/'", 100); 
                                    }
                                },
                                data: { "cedulaJuridica": cedulaJuridica, "_token": token, },
                                success: function (data){
                                    if($.isEmptyObject(data.errors)){  
                                        Swal.fire({
                                        title: "¡Registro Desactivado con Éxito!",
                                        type: 'success',
                                        showCancelButton: false,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Aceptar' 
                                        }).then(function() {
                                        setTimeout("location.reload();", 100); 
                                        }); 
                                    }
                                    else{
                                        Swal.fire({
                                            title:"¡Registro No Desactivado!", 
                                            type: "error", 
                                            buttons: "Aceptar", 
                                            confirmButtonText: 'Aceptar',
                                            timer: 2000,  
                                        }); 
                                    } 
                                }
                            });
                        } else {
                            Swal.fire({
                                title:"¡Cancelado!", 
                                text:"Registro No Desactivado", 
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
    <div class="row" > 
        <div class="col-lg-12"> 
            <div class="row"> 
                <div class="col-md-6 col-xl-4">
                    <div class="card mb-3 widget-content bg-arielle-smile">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading"><h4>Total de Talleres</h4></div>
                                <div class="widget-subheading"><h5>Registrados</h5></div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white"><span>{{$talleres->count()}}</span></div>
                            </div>
                        </div>
                    </div>
                </div>   
                <div class="card"> 
                    <div class="card-body">  
                        <div class="form-row">
                            <div class="col-md-4" style="text-align: left;">
                                <a class="btn bg-love-kiss" href="{{ route('taller.vistaDesactivados') }}" style="color:black">Talleres Desactivados</a>  
                            </div>   
                            <div class="col-md-4" style="text-align: center;">
                                <h2 style="color:black">Registro de Talleres Activos</h2>  
                            </div>    
                            <div class="col-md-4" style="text-align: right;">
                                <div class="position-relative form-group">   
                                    <a class="btn bg-happy-green" href="{{ route('talleres.create') }}" style="color:black"><i class="fas fa-plus"> Nuevo Taller</i> </a>   
                                </div>
                            </div>
                        </div> 
                        <table class="table" id="table-talleress">
                            <thead>
                                <tr>
                                    <th>Identificación</th> 
                                    <th>Nombre</th> 
                                    <th>Ubicacion</th> 
                                    <th>Teléfono de Contacto</th> 
                                    <th>Correo Electrónico</th> 
                                    <th> Opciones</th> 
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach ($talleres as $Talleres) 
                                <tr> 
                                    <td>{{$Talleres->CedulaJuridica}}</td> 
                                    <td>{{$Talleres->nombre}}</td>
                                    <td>{{$Talleres->Ubicacion}}</td>
                                    <td>{{$Talleres->Contacto}}</td>
                                    <td>{{$Talleres->Correo}}</td> 
                                    <td>  
                                        <a class="btn bg-sunny-morning" href="{{ route('talleres.edit', $Talleres->CedulaJuridica) }}"><i class="fas fa-edit" style="color:black"> Editar</i> </a>
                                        <button class="desactivar btn bg-love-kiss" data-id="{{$Talleres->CedulaJuridica }}" style="color:black"><i class="fas fa-times-circle" style="color:black"> Desactivar</i></button>   
                                        <button class="eliminar btn bg-love-kiss" data-id="{{ $Talleres->CedulaJuridica }}" style="color:black"><i class="fas fa-trash"> Eliminar</i></button>
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