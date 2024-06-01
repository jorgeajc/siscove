@extends('welcome')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/css/table.css" rel="stylesheet" />
    <link href="/css/sweetAlert2Style.css" rel="stylesheet" />

    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>  
    
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
                            url: "/eliminarUser/"+id,
                            type: 'post',
                            statusCode: {
                                302: function() { 
                                    setTimeout("location.href='/'", 100); 
                                }
                            },
                            data: { "id": id, _method: 'delete', _token: token},
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
                                        setTimeout("location.reload();"); 
                                    }); 
                                }else{
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
                    } else {
                        Swal.fire({
                            title:"¡Cancelado!",
                            text:"Registro No Eliminado", 
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
        function cambioEstado(id, estado){
            var token = $("meta[name='csrf-token']").attr("content");  
            Swal.fire({
                title: "¿Está seguro que desea cambiar el estado de este usuario?",
                text: estado == 'Activo' ? "Este usuario no tendrá acceso al sistema" : "Este usuario volverá a tener acceso al sistema" ,
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
                        url: "/cambioEstado/"+id,
                        type: 'post',
                        statusCode: {
                            302: function() { 
                                setTimeout("location.href='/'", 100); 
                            }
                        },
                        data: { "id": id, _method: 'post', _token: token},
                        success: function (data){
                            if($.isEmptyObject(data.errors)){   
                                setTimeout("location.reload();"); 
                            }else{
                                Swal.fire({
                                    title:"¡Error!", 
                                    text: data.errors,
                                    type: "error", 
                                    buttons: "Aceptar", 
                                    confirmButtonText: 'Aceptar'
                                });
                            } 
                        }
                    }); 
                }
            }); 
        }
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
                                <div class="widget-heading"><h3>Total de Usuarios</h3></div>
                                <div class="widget-subheading"><h4>Registrados</h4> </div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white"><span>{{$usuarios->count()}}</span></div>
                            </div>
                        </div>
                    </div>
                </div>   
                <div class="card">    
                    <div class="card-body">  
                        <div class="form-row"> 
                            <div class="col-md-4" style="text-align: left;"></div>   
                            <div class="col-md-4" style="text-align: center;">
                                <h2 style="color:black">Registro de Usuarios</h2>  
                            </div>    
                            <div class="col-md-4" style="text-align: right;">
                                <div class="position-relative form-group">   
                                    <a class="btn bg-happy-green" href="{{ route('register') }}" style="color:black"><i class="fas fa-plus"> Nuevo Usuario</i></a>   
                                </div>
                            </div>
                        </div> 
                        <table class="table">  
                            <thead> 
                                <tr> 
                                    <th >Cedula</th> 
                                    <th >Nombre</th> 
                                    <th >Apellidos</th> 
                                    <th >Telefono</th> 
                                    <th >Correo</th> 
                                    <th >Tipo de Usuario</th>
                                    <th >Descripcion</th> 
                                    <th>Licencia</th> 
                                    <th>Estado</th>
                                    <th>Opciones</th>  
                                </tr>
                            </thead> 
                            <tbody>  
                                @foreach ($usuarios as $usu) 
                                    <tr>   
                                        <td>{{$usu->id}}</td> 
                                        <td>{{$usu->primerNombre}} {{ $usu->segundoNombre }}</td> 
                                        <td>{{$usu->primerApellido}} {{$usu->segundoApellido}}</td> 
                                        <td>{{$usu->telefono}}</td> 
                                        <td>{{$usu->email}}</td>   
                                        <td>  {{$usu->tipo}} </td>
                                        <td>
                                            @if(isset($usu->gasolinera))
                                                {{$usu->gasolinera}} 
                                                @elseif(isset($usu->taller))
                                                    {{$usu->taller}}
                                                    @elseif(isset($usu->departamento))
                                                        {{$usu->departamento}} 
                                            @endif 
                                        </td>  
                                        <td>   
                                            @foreach ($licencias as $li => $value)   
                                                @if($usu->id == $value->user)
                                                    {{$value->tipo}}  
                                                    <label style="color:red;">{{ date('d/m/Y', strtotime($value->vencimiento)) }}</label> 
                                                    <br>    
                                                @endif 
                                            @endforeach  
                                        </td>
                                        <td>
                                            @if($usu->estado == 'Activo')
                                                <span class="badge badge-pill badge-success">Activo</span>
                                                @else
                                                <span class="badge badge-pill badge-danger">Inactivo</span>
                                            @endif 
                                        </td>
                                        <td>
                                            <div class="active show">  
                                                <button class="btn btn-light btn-circle end-btn dropdown-toggle" type="button" id="btn-opc" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="opciones">
                                                    <i class="fas fa-ellipsis-h fa-lg"></i>
                                                </button>  
                                                <div class="dropdown-menu"> 
                                                    <a class="btn bg-sunny-morning " href="{{ route('User.edit', $usu->id) }}" style="color:black"><i class="fas fa-edit"> Editar</i></a>
                                                    <button class="eliminar btn bg-love-kiss" data-id="{{ $usu->id }}" style="color:black"><i class="fas fa-trash"> Eliminar</i> </button> 
                                                    @if($usu->tipoUsuario != 4)<button class="btn bg-happy-green" onclick='cambioEstado("{{ $usu->id }}", "{{ $usu->estado }}")'style="color:black"><i class="fas fa-sync-alt" style="color:black"> Cambiar estado</i></button>@endif   
                                                </div>  
                                            </div>
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