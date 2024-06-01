@extends('welcome') 
@section('content')
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"> 
    <script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script> 
    <link href="/css/sweetAlert2Style.css" rel="stylesheet" />
    <style type="text/css">
        .alert {
        display:inline-block;
    }
    </style>
    <script>
        $(document).ready(function(){
            $(".editar").click(function(){ 
                var id = $('#id').val();
                var nombreDeparta = $('#nombreDeparta').val(); 
               
                Swal.fire({
                    title: "¿Está seguro de actualizar este registro?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Actualizar',
                    cancelButtonText: 'Cancelar', 

                })
                .then((willDelete) => {
                    if (willDelete.value) { 
                        $.ajax({
                            url:  "/editarDeparta/" + id, 
                            type: 'POST', 
                            statusCode: {
                                302: function() { 
                                    setTimeout("location.href='/'", 100); 
                                }
                            },
                            data: {
                                    "nombreDeparta" : nombreDeparta, 
                                    _token: '{{csrf_token()}}' 
                                    },
                            success: function (data){
                                if($.isEmptyObject(data.errors)){ 
                                    Swal.fire({
                                        title: "¡Actualizado!",
                                        type: 'success',
                                        showCancelButton: false,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Aceptar' 
                                    }).then(function() {
                                        setTimeout("location.href='/departamentos'", 100); 
                                    });
                                }
                                else{
                                    var descripcion = " <div class='alert alert-danger alert-dismissable'>"+
                                                        "       <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>"+
                                                        "           &times;"+
                                                        "       </button> "+
                                                        "        Solucione los Siguientes Errores"+    
                                                        "   </div>";
                                    $.each(data.errors, function(i, item) {
                                        descripcion+=" <div class='alert alert-danger alert-dismissable'>"+
                                                        "       <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>"+
                                                        "           &times;"+
                                                        "       </button> "+  
                                                                item + 
                                                        "   </div>";
                                    }); 
                                    $("#parent").html(descripcion);                  
                                }
                                 
                            }
                        });
                    } else {
                        Swal.fire({
                            title:"¡Cancelado!", 
                            type: "error", 
                            buttons: "Aceptar", 
                            confirmButtonText: 'Aceptar',
                            timer: 2000,});
                    }
                });
              
            });  
        });  
   </script> 
</head>
<body>
    <br>
    <br>
    <br>
    <br>
    <div class="container"> 
        <div class="row justify-content-center"> 
            <div class="col-lg-8"> 
                <div class="row">
                    <div id="parent">   
                    </div> 
                </div>  
                <div class="card">
                    <div class="card-body"> 
                        <h5 class="card-title text-center" style="color:black">Editar Departamento</h5>
                        <div class="form-group row" style="display:none">
                            <label for="id" class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Codigo del Departamento') }}</label>

                            <div class="col-md-6">
                                <input id="id" type="text" class="form-control" name="id" value="{{ $departaE->id}}" required autofocus readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nombreDeparta" class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Nombre del Departamento') }}</label>

                            <div class="col-md-6">
                                <input id="nombreDeparta" type="text" class="form-control{{ $errors->has('nombreDeparta') ? ' is-invalid' : '' }}" name="nombreDeparta" value="{{ $departaE->nombreDeparta }}" required autofocus>

                            </div>
                        </div> 
                        <div> 
                            <a href="{{ route('departamentos.index')}}" class="btn bg-malibu-beach pull-left">
                                <i class="fas fa-angle-double-left" style="color:black">Regresar</i>  
                            </a>   
                            <button class="editar btn bg-happy-green pull-right">
                                <i class="fas fa-sync-alt" style="color:black">{{ __('Actualizar') }}</i>
                            </button>  
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@endsection
