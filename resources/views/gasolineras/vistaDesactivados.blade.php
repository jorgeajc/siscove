@extends('welcome')
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
    <script>
        $(document).ready(function(){ 
            $(".activar").click(function(){ 
                var cedulaJuridica = $(this).data("id"); 
                var token = $("meta[name='csrf-token']").attr("content");
                
                    Swal.fire({
                        title: "¿Está seguro de habilitar esta gasolinera?",
                        text: "¡Esta gasolinera podrá ser usada de nuevo en el sistema!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Activar', 
                        cancelButtonText: 'Cancelar',    
                    }) 
                    .then((willDelete) => {
                        if (willDelete.value) {
                            $.ajax({
                                url: "activarGasolinera/"+cedulaJuridica,
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
                                        title: "¡Registro Activado!", 
                                        text:"Lo encontrará en la Tabla Principal de Gasolineras Activas",
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
                                        title:"¡Registro no Activado!", 
                                        type: "error", 
                                        buttons: "Aceptar", 
                                        confirmButtonText: 'Aceptar',
                                        timer: 2000,  });                   
                                    } 
                                }
                            });
                        } else {
                            Swal.fire({
                                title:"¡Cancelado!", 
                                text:"Registro no Activado",
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
@section('content')
    <div class="row" > 
        <div class="col-lg-12">   
            <div class="row" >  
               <div class="col-md-6 col-xl-4">
                  <div class="card mb-3 widget-content bg-love-kiss">
                     <div class="widget-content-wrapper text-white">
                           <div class="widget-content-left">
                              <div class="widget-heading"><h3>Total de Gasolineras</h3></div>
                              <div class="widget-subheading"><h4>Desactivadas</h4></div>
                           </div>
                           <div class="widget-content-right">
                              <div class="widget-numbers text-white"><span>{{$gasolineras->count()}}</span></div>
                           </div>
                     </div>
                  </div>
               </div>  
               <div class="card ">   
                    <div class="form-row">
                        <div class="col-md-4" style="text-align: left;">
                            <a class="btn bg-malibu-beach" href="{{ route('gasolineras.index') }}" style="color:black;"> <i class="fas fa-angle-double-left"></i>Regresar</a>    
                        </div>   
                        <div class="col-md-4" style="text-align: center;">
                            <h2  style="color:black">Registro de Gasolineras Inactivas</h2> 
                        </div>     
                    </div> 
                  <div class="card-body"> 
                     <div class="table-responsive"> 
                           <table class="table"> 
                              <thead>
                                 <tr>
                                       <th colspan="1">Identificación</th>
                                       <th >Nombre</th>  
                                       <th >Ubicación</th>  
                                       <th >Telefono de Contacto</th>  
                                       <th >Correo</th>  
                                       <th>Opciones</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @foreach ($gasolineras as $gas)
                                       <tr>
                                          <td>{{$gas->cedulaJuridica}}</td>
                                          <td>{{$gas->nombre}}</td>
                                          <td>{{$gas->ubicacion}}</td>
                                          <td>{{$gas->contacto}}</td>
                                          <td>{{$gas->correo}}</td>
                                          <td>  
                                             <button class="activar btn bg-happy-green" data-id="{{$gas->cedulaJuridica}}" style="color:black;"><i class="fas fa-plus" style="color:black"> Activar</i> </button>  
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
    
