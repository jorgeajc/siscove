@extends('welcome') 

@section('content') 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
    <script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script>  
    <link href="/css/sweetAlert2Style.css" rel="stylesheet" />

    <style type="text/css">
    .alert {
        display:inline-block;
    }
  </style>
    <script>
        $(document).ready(function(){ 
              
            $(".agregar").click(function(){ 
                var validarTipoAsientos = cantidadAsientos();
                if(validarTipoAsientos == true){ 
                    crear();
                } 
            });
            $("#rtv").datepicker({
                dateFormat: 'dd/mm/yy',
                numberOfMonths: 1,
                minDate: 0, 
                changeMonth: true,
                changeYear: true,
            });
            $("#marchamo").datepicker({
                dateFormat: 'dd/mm/yy',
                numberOfMonths: 1,
                minDate: 0,  
                changeMonth: true,
                changeYear: true,
            });
        });  
        function cantidadAsientos(){
            var tipo =  $('input:radio[name=tipo]:checked').val();
            var asientos = $('#asientos').val(); 
            var marca = $('#marca').val(); 
            var modelo = $('#modelo').val();
             
            if(tipo == undefined || asientos == "" || marca == "" || modelo == ""){
                var descripcion = " <div class='alert alert-danger alert-dismissable'>"+
                                                        "       <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>"+
                                                        "           &times;"+
                                                        "       </button> "+
                                                        "        Complete todos los campos"+    
                                                        "   </div>";  
                    $("#parent").html(descripcion); 
            }else if(tipo == "moto"){  
                if(asientos <= 2 && asientos > 0){  
                    return true;
                }else{
                    var descripcion = " <div class='alert alert-danger alert-dismissable'>"+
                                                        "       <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>"+
                                                        "           &times;"+
                                                        "       </button> "+
                                                        "        Las motos solo pueden tener 1 o 2 asientos"+    
                                                        "   </div>";  
                    $("#parent").html(descripcion); 
                    return false;
                }
            }else if(tipo == "carro"){ 
                if(asientos > 2){  
                    return true;
                }else{
                    var descripcion = " <div class='alert alert-danger alert-dismissable'>"+
                                                        "       <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>"+
                                                        "           &times;"+
                                                        "       </button> "+
                                                        "        Los carros tienen más de 3 asientos"+    
                                                        "   </div>";
                    $("#parent").html(descripcion); 
                    return false;
                }
            }   
        }
        function crear(){
            var placa = $('#placa').val(); 
            var marca = $('#marca').val(); 
            var modelo = $('#modelo').val();
            var asientos = $('#asientos').val();
            var tipo =  $('input:radio[name=tipo]:checked').val();  
            var rtv = $('#rtv').val(); 
            var marchamo = $('#marchamo').val();  
            var mensaje;
            if(tipo != undefined){
                mensaje = "¿Está Seguro de Guardar Vehículo "+tipo+"?"
            }else{
                mensaje = "¿Está Seguro de Guardar Vehículo?"
            }
            Swal.fire({
                title: mensaje,
                text:  "El Registro Será Agregado al Sistema" ,
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
                        url: "/guardarVehiculo", 
                        type: 'POST', 
                        statusCode: {
                            302: function() { 
                                setTimeout("location.href='/'", 100); 
                            }
                        },
                        data: {
                                "placa" : placa,
                                "marca" : marca, 
                                "modelo" : modelo,
                                "cantidadAsientos" : asientos,
                                "tipo" : tipo,
                                "riteve" : rtv,
                                "marchamo" : marchamo,
                                _token: '{{csrf_token()}}' 
                                },
                        success: function(data) {
                            if($.isEmptyObject(data.errors)){ 
                                Swal.fire({
                                    title: "¡Registro Agregado!",  
                                    type: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Aceptar',
                                    timer: 2000, 
                                }).then(function() {
                                    setTimeout("location.href='/vehiculos'"); 
                                });
                            }else{    
                                    var descripcion = " <div class='alert alert-danger alert-dismissable'>"+
                                                    "       <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>"+
                                                    "           &times;"+
                                                    "       </button> "+
                                                    "        Solucione los siguientes errores"+    
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
                            text: "Registro No Agregado",
                            type: "error", 
                            buttons: "Aceptar", 
                            confirmButtonText: 'Aceptar',
                            timer: 2000,
                        });
                }
            });
        }  
   </script>

</head>
<body> 
<br>
<br>
<br>
    <div class="container">
        <div class="row">
            <div id="parent">   
            </div> 
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-heading text-center">
                        <br>
                        <h2 style="color:black;">Nuevo Vehículo</h2>
                        <br>
                    </div> 
                    <div class="card-body"> 
                        <div class="form-group row" class="text-center" id="tipo">
                            <label for="tipo" class="col-md-4 col-form-label text-md-right" style="color:black;">{{ __('Seleccione: ') }}</label>  
                            <div class="col-md-6">
                                <input type="radio"  id="tipo" name="tipo" value="carro">Carro 
                                <input type="radio"  id="tipo"  name="tipo" value="moto"> Moto
                            </div> 
                        </div> 
                        <div class="form-group row">
                            <label for="placa" class="col-md-4 col-form-label text-md-right" style="color:black;">{{ __('Placa: ') }}</label> 
                            <div class="col-md-6">
                                <input id="placa" type="text" class="form-control" name="placa" required>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="marca" class="col-md-4 col-form-label text-md-right" style="color:black;">{{ __('Marca: ') }}</label> 
                            <div class="col-md-6">
                                <input id="marca" type="text" class="form-control" name="marca" required>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="modelo" class="col-md-4 col-form-label text-md-right" style="color:black;">{{ __('Modelo: ') }}</label> 
                            <div class="col-md-6">
                                <input id="modelo" type="text" class="form-control" name="modelo" required>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="asientos" class="col-md-4 col-form-label text-md-right" style="color:black;">{{ __('Cantidad de Asientos: ') }}</label> 
                            <div class="col-md-6">
                                <input id="asientos" type="text" class="form-control  " name="asientos"minlength="1" maxlength="1" pattern="[0-9]" required>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="rtv" class="col-md-4 col-form-label text-md-right" style="color:black;">{{ __('Fecha Vencimiento de riteve (RiTeVe): ') }}</label> 
                            <div class="col-md-6">
                                <input id="rtv" type="text" class="form-control  " name="rtv" required readonly>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="marchamo" class="col-md-4 col-form-label text-md-right" style="color:black;">{{ __('Fecha Vencimiento de Marchamo: ') }}</label> 
                            <div class="col-md-6">
                                <input id="marchamo" type="text" class="form-control" name="marchamo" required readonly>
                            </div>
                        </div>  
                        <div>
                            <button class="btn bg-malibu-beach pull-left" onclick="window.location='{{ url('vehiculos') }}'">
                                <i class="fas fa-angle-double-left" style="color:black">Regresar</i>
                            </button>
                            <button class="agregar btn bg-happy-green pull-right">
                                <i class="fas fa-check-double" style="color:black">Guardar</i>  
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