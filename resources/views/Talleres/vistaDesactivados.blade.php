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
    <link href="/css/table.css" rel="stylesheet" /> 
    <script>
      $(document).ready(function(){
        $(".activar").click(function(){ 
                var CedulaJuridica = $(this).data("id"); 
                var token = $("meta[name='csrf-token']").attr("content");
                Swal.fire({
                        title: "¿Está seguro de habilitar este taller?",
                        text: "¡Este taller podrá ser usado de nuevo en el sistema!",
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
                                url: "activarTaller/"+CedulaJuridica,
                                type: 'POST',
                                statusCode: {
                                    302: function() { 
                                          setTimeout("location.href='/'", 100); 
                                    }
                                 },
                                data: { "CedulaJuridica": CedulaJuridica, "_token": token, },
                                success: function (data){
                                  if($.isEmptyObject(data.errors)){ 
                                    Swal.fire({
                                        title: "¡Registro Activado!", 
                                        text:"Lo encontrará en la Tabla Principal de Talleres Activos",
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
                        }else {
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
         <div class="row" >    
         <div class="col-md-6 col-xl-4">
               <div class="card mb-3 widget-content bg-love-kiss">
                  <div class="widget-content-wrapper text-white">
                     <div class="widget-content-left">
                           <div class="widget-heading"><h3>Total de Talleres</h3></div>
                           <div class="widget-subheading"><h4>Desactivados</h4></div>
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
                     <a class="btn bg-malibu-beach" href="{{ route('talleres.index') }}" style="color:black"><i class="fas fa-angle-double-left" style="color:black">Regresar</i></a>   
                  </div>   
                  <div class="col-md-4" style="text-align: center;">
                     <h2 style="color:black">Registro de Talleres Inactivos</h2> 
                  </div>     
               </div> 
               <table class="table"> 
                  <thead> 
                     <tr> 
                        <th>Identificación</th> 
                        <th>Nombre</th>
                        <th>Ubicación</th>
                        <th>Contacto</th>
                        <th>Correo Electrónico</th> 
                        <th>Opciones</th> 
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
                        <button class="activar btn bg-happy-green" data-id="{{$Talleres->CedulaJuridica}}" style="color:whites"><i class="fas fa-plus" style="color:black"> Activar</i> </button> 
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