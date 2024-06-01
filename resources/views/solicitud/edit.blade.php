@extends('welcome') 

@section('content')
<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8"> 
    <script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script> 
    <link href="/css/sweetAlert2Style.css" rel="stylesheet" />
    <script type="text/javascript" src="/js/jquery.maskedinput.js"></script> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" integrity="sha256-DOS9W6NR+NFe1fUhEE0PGKY/fubbUCnOfTje2JMDw3Y=" crossorigin="anonymous" />    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha256-FEqEelWI3WouFOo2VWP/uJfs1y8KJ++FLh2Lbqc8SJk=" crossorigin="anonymous"></script> 
    <script src="/js/toastr.min.js"> type="text/javascript"</script>
    <link rel="stylesheet" href="/css/pretty-checkbox.min.css"/>
    <style type="text/css">
        .alert{
            display:inline-block;
        }   
        #necesitaC{
            display:none;
        }
    </style>
    <script>
        $(document).ready(function()
        {
            var fechaEntrega    = convertirFechaHora('{{$solicitud->fechaEntrega}}', '{{$solicitud->horaEntrega}}'); 
            var fechaDevolucion = convertirFechaHora('{{$solicitud->fechaDevolucion}}', '{{$solicitud->horaDevolucion}}'); 
            $(".actualizar").click(function(){
                //obteniendo datos comunes
                var idSoli = '{{$solicitud->idSolicitud}}';
                var id = $('#id').val();
                var departamento = $('#departamento').val();
                var telefono = $('#telefono').val();
                var email = $('#email').val();
                var descripcion = $('#descripcion').val();
                var destino = $('#destino').val();
                var numPersonas = $('input:radio[name=cantPersonas]:checked').val();
                var NecesitaConduc =  $('input:radio[name=necesitaC]:checked').val();  
               
                var fechaEntrega = ExtraerFecha($('#datetimepicker1').val());
                var horaEntrega = ExtraerHora($('#datetimepicker1').val());

                var fechaDevolucion = ExtraerFecha($('#datetimepicker2').val());
                var horaDevolucion = ExtraerHora($('#datetimepicker2').val());
                 
                Swal.fire({
                    title: "¿Está seguro de actualizar la solicitud?",
                    text:  "La solicitud será enviada para revición" ,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar', 
                })
                .then((willDelete) => { 
                    if(willDelete.value){
                        $.ajax({
                            url:"/editarSolicitud/"+idSoli,
                            type: 'POST',
                            statusCode: {
                                302: function() { 
                                    setTimeout("location.href='/'", 100); 
                                }
                            },
                            data: {
                                "idSoli": idSoli,
                                "id" : id,
                                "departamento" : departamento,
                                "telefono" : telefono,
                                "email" : email,
                                "descripcion" : descripcion,
                                "destino" : destino,
                                "numPersonas" : numPersonas, 
                                "fechaEntrega" : fechaEntrega,
                                "horaEntrega" : horaEntrega,
                                "fechaDevolucion" : fechaDevolucion,
                                "horaDevolucion" : horaDevolucion,
                                "NecesitaConduc": NecesitaConduc,
                                _token: '{{csrf_token()}}' 
                            },
                            success: function(data){ 
                                if($.isEmptyObject(data.errors)){ 
                                    Swal.fire({
                                        title: "¡Solicitud Actualizada!",  
                                        type: 'success',
                                        showCancelButton: false,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Aceptar',
                                        timer: 2000,
                                    }).then(function() {
                                        setTimeout("location.href='/misSolicitudes'"); 
                                    });
                                } else {  
                                    toastr.error("Solucione los errores que puede encontrar al inicia de la solicitud", "Problemas al enviar la solicitud",{
                                        timeOut:15000, 
                                        closeButton: true, 
                                        progressBar: true,  
                                    });    
                                    var descripcion = "";
                                                        
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
                    }
                    else {
                        Swal.fire({
                            title:"¡Cancelado!",
                            text:"Solicitud No Enviada", 
                            type: "error",  
                            confirmButtonText: 'Aceptar',
                            timer: 2000,
                        });
                            
                    }
                });
            });   
            $('#datetimepicker1').datetimepicker({ 
                minDate: 0, 
                format: 'd/m/Y H:i',  
                value: fechaEntrega
            });
            $('#datetimepicker1').change(function(){ 
                var fechaEntrega = $('#datetimepicker1').val();
                var hoy = $.datepicker.formatDate('yy-mm-dd', new Date());

                var fechaEntregaP = fechaEntrega.substring(0, fechaEntrega.indexOf(" "));
                var hoyP = hoy.split("-").reverse().join("/") ; 

                var cc = $.datepicker.formatDate('dd/mm/yy', new Date(fechaEntregaP)); 
                if(fechaEntregaP == hoyP){ 
                    $('#datetimepicker1').datetimepicker({  
                        minTime:"dateToday",   
                        step: 30,
                        maxTime: '16:30',
                    });
                }else if(fechaEntregaP != ''){ 
                    $('#datetimepicker1').datetimepicker({   
                        minTime: '7:30',  
                        step: 30,
                        maxTime: '16:30', 
                    });
                }
            });
            $('#datetimepicker2').datetimepicker({ 
                format: 'd/m/Y H:i',
                timepicker:false,  
                step: 30, 
                minTime:'7:30',
                maxTime: '16:30',
                value: fechaDevolucion,
                onShow:function( ct ){ 
                    var datetimepicker1 = ($('#datetimepicker1').val().substring(0, $('#datetimepicker1').val().indexOf(" "))).split("/").reverse().join("-");  
                    this.setOptions({ 
                        minDate:datetimepicker1, 
                    })  
                }, 
            }); 
            $('#datetimepicker2').change(function(){ 
                var hora = ExtraerHora($('#datetimepicker1').val());  
                var horaDevolucion = (parseInt(hora.substring(0, 2))+1) + hora.substr(hora.indexOf(":"), hora.length-1);  
                var fechaEntrega =  $('#datetimepicker1').val().substring(0, $('#datetimepicker1').val().indexOf(" "));
                var fechaDevolucion = $('#datetimepicker2').val().substring(0, $('#datetimepicker2').val().indexOf(" "));  

                if(fechaEntrega == fechaDevolucion){ 
                    $('#datetimepicker2').datetimepicker({ 
                        minTime:horaDevolucion, 
                        maxTime: '16:00',
                        step: 30,  
                        timepicker:true, 
                    });
                }else{ 
                    $('#datetimepicker2').datetimepicker({   
                        minTime:'7:30', 
                        maxTime: '16:00',
                        step: 30,  
                        timepicker:true, 
                    });
                } 
            }); 
            $("#cantPersonasID").click(function(){
                var CantPersonas = $('input:radio[name=cantPersonas]:checked').val(); 
                if(CantPersonas == 5){
                    document.getElementById('necesitaC').style.display='none'; 
                    $("#necesitaCsi").attr('checked', false);
                    $("#necesitaCno").attr('checked', true); 
                }else{
                    document.getElementById('necesitaC').style.display='inline-block'; 
                    $("#necesitaCno").attr('checked', false);
                    $("#necesitaCsi").attr('checked', true);  
                } 
            }); 
            necesitaConductor();
        }); 
        function necesitaConductor(){
            var CantPersonas = $('input:radio[name=cantPersonas]:checked').val(); 
            if(CantPersonas == 5){
                document.getElementById('necesitaC').style.display='none'; 
            }else{
                document.getElementById('necesitaC').style.display='inline-block'; 
            } 
        } 
        $(function($){
            $("#numPersonas").mask("9", {  
                autoclear: false
            }); 
        }); 
        function ExtraerFecha(fecha){
            var fechaExtraida = fecha.substring(0, fecha.indexOf(" "));
            var fechaConvertida = fechaExtraida.split("/").reverse().join("-");  
            return fechaConvertida
        }
        function ExtraerHora(fecha){
            var horaExtraida =  fecha.substr(fecha.indexOf(" "), fecha.length-1).replace(/ /gi, "");  
            return horaExtraida + ":00"
        }
        function convertirFechaHora(fecha, hora){ 
            var fechaConvertida = fecha.split("-").reverse().join("/");    
            return fechaConvertida + ' ' + hora;
        } 
  </script> 
</head>
<body>
    <div class="row justify-content-center">
        <div class="col-md-10">  
            <div class="col-md-10">
                <div id="parent">   
                </div> 
            </div>
            <div class="tab-content">
                <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                    <div class="main-card mb-3 card"> 
                        <br> 
                        <div class="card-heading" align="center">
                            <h3 style="color:black; text-align:center;">PRESTAMO VEHICULAR</h3> 
                            <div class="form-row" style="margin:1%">   
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                    <h6><label for="cedula" style="color:black">{{ __('Cédula: ') }}</label></h6> 
                                        <input id="id" type="text" class="form-control" name="cedula" value="{{$solicitud->id}}" readonly>
                                    </div> 
                                </div>  
                                <div  class="col-md-6">
                                    <div class="position-relative form-group">
                                        <h6><label for="nombreCompleto"  style="color: black">{{ __('Nombre Completo: ') }}</label></h6>
                                        <input id="nombreCompleto" type="text" class="form-control" name="nombreCompleto" value="{{$solicitud->primerNombre}} {{$solicitud->segundoNombre}} {{$solicitud->primerApellido}} {{$solicitud->segundoApellido }}" readonly>                                </div> 
                                </div>   
                            </div> 
                            <div class="form-row" style="margin:1% ">  
                                <div  class="col-md-4">
                                    <div class="position-relative form-group">
                                        <h6><label for="departamento" style="color:black">{{ __('Departamento: ') }}</label></h6>
                                        <input id="departamento" type="text" class="form-control" name="departamento" value="{{$solicitud->departamento }}" readonly>
                                    </div> 
                                </div>  
                                <div  class="col-md-4">
                                    <div class="position-relative form-group">
                                        <h6><label for="telefono"  style="color: black;">{{ __('Teléfono: ') }}</label></h6>
                                        <input id="telefono" type="text" class="form-control" name="telefono" value="{{$solicitud->telefono }}" required autofocus readonly>
                                    </div> 
                                </div> 
                                <div  class="col-md-4">
                                    <div class="position-relative form-group">
                                        <h6><label for="email"  style="color: black">{{ __('Email: ') }}</label></h6>
                                        <input id="email" type="text" class="form-control" name="email" value="{{$solicitud->email }}" readonly>
                                    </div> 
                                </div>   
                            </div> 
                            <br>     
                        </div>
                        <br>
                        <hr>
                        <div class="form-horizontal">
                            <br>
                            <h4 style="color:black" class="text-center">Datos del Viaje</h4>
                            <br>
                            <div class="form-row" style="margin:1%">  
                                <div class="form-group row">
                                    <label for="descripcion" class="col-md-10 col-form-label" style="color:black"><h6>{{ __('Motivo de la Solicitud: ') }}</h6></label> 
                                    <div class="col-md-12">
                                        <textarea id="descripcion" type="text" rows="6" cols="50" class="form-control " name="descripcion">{{ $solicitud->descripcion }}</textarea>
                                    </div>
                                </div>   
                            </div> 
                            <div class="form-row" style="margin:1% ">  
                                <div  class="col-md-5">
                                    <div class="position-relative form-group">
                                        <h6><label for="destino"  style="color: black">{{ __('Destino del Viaje: ') }}</label></h6>
                                        <input id="destino" class="form-control " name="destino" value="{{ $solicitud->destino  }}"autofocus>
                                    </div> 
                                </div>  
                                <div  class="form-group">
                                    <div class="position-relative form-group">
                                        <div id="cantPersonasID">
                                            <h6><label style="color:black">{{ __('¿Número de Personas? ') }}</label></h6>
                                            <div class="col-md-8">
                                                <div class="pretty p-icon p-curve p-tada">
                                                    <input type="radio" name="cantPersonas" value="1" {{$solicitud->numPersonas == 1? 'checked':''}}>
                                                    <div class="state p-success-o">
                                                        <i class="icon mdi mdi-check"></i>
                                                        <label style="color:black">1</label>
                                                    </div>
                                                </div>
                                                <div class="pretty p-icon p-curve p-tada">
                                                    <input type="radio" name="cantPersonas" value="2" {{$solicitud->numPersonas == 2? 'checked':''}}>
                                                    <div class="state p-success-o">
                                                        <i class="icon mdi mdi-check"></i>
                                                        <label style="color:black">2</label>
                                                    </div>
                                                </div>
                                                <div class="pretty p-icon p-curve p-tada">
                                                    <input type="radio" name="cantPersonas" value="3" {{$solicitud->numPersonas == 3? 'checked':''}}>
                                                    <div class="state p-success-o">
                                                        <i class="icon mdi mdi-check"></i>
                                                        <label style="color:black">3</label>
                                                    </div>
                                                </div>
                                                <div class="pretty p-icon p-curve p-tada">
                                                    <input type="radio" name="cantPersonas" value="4" {{$solicitud->numPersonas == 4? 'checked':''}}>
                                                    <div class="state p-success-o">
                                                        <i class="icon mdi mdi-check"></i>
                                                        <label style="color:black">4</label>
                                                    </div>
                                                </div>
                                                <div class="pretty p-icon p-curve p-tada">
                                                    <input type="radio" name="cantPersonas" value="5" {{$solicitud->numPersonas == 5? 'checked':''}}>
                                                    <div class="state p-success-o">
                                                        <i class="icon mdi mdi-check"></i>
                                                        <label style="color:black">5</label>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div> 
                                </div> 
                                <div class="form-group">
                                    <div class="position-relative form-group">
                                        <div id="necesitaC">
                                            <h6><label style="color:black">¿Necesita Conductor?</label><br></h6>
                                            <div class="col-md-6">
                                                <div class="pretty p-icon p-curve p-tada">
                                                    <input type="radio" id="necesitaCsi" name="necesitaC" value="si" {{$solicitud->NecesitaConduc == 1? 'checked':''}}>
                                                    <div class="state p-success-o">
                                                        <i class="icon mdi mdi-check"></i>
                                                        <label style="color:black">Sí</label>
                                                    </div>
                                                </div>
                                                <div class="pretty p-icon p-curve p-tada">
                                                    <input type="radio" id="necesitaCno" name="necesitaC" value="no" {{$solicitud->NecesitaConduc == 0? 'checked':''}}>
                                                    <div class="state p-danger-o">
                                                        <i class="icon mdi mdi-close"></i>
                                                        <label style="color:black">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div> 
                                </div>     
                            </div> 
                            <br>    
                            <div class="form-row" style="margin:1% ">  
                                <div  class="col-md-6">
                                    <div class="position-relative form-group">
                                        <h6><label for="datetimepicker1" style="color:black">{{ __('Fecha y Hora de Entrega: ') }}</label></h6>
                                        <input id="datetimepicker1" class="form-control"type="text" readonly>
                                    </div> 
                                </div>   
                                <div  class="col-md-6">
                                    <div class="position-relative form-group">
                                        <h6><label for="datetimepicker2"  style="color: black;">{{ __('Fecha y Hora de Devolución: ') }}</label><h6>
                                        <input id="datetimepicker2" class="form-control"type="text" readonly>
                                    </div> 
                                </div>   
                            </div>  
                        </div> 
                        <br>
                        <div class="form-row" style="margin:1% ">
                            <div class="col-md-12"> 
                                <div class="position-relative form-group">
                                    <button class="btn bg-malibu-beach pull-left btn-lg">
                                        <a href="{{ route('home')}}" >
                                            <i class="fas fa-angle-double-left" style="color:black">Regresar</i>
                                        </a>  
                                    </button>  
                                    <button class="actualizar btn bg-happy-green pull-right btn-lg">
                                        <i class="fas fa-sync-alt" style="color:black">Actualizar</i>
                                    </button>    
                                </div>
                            </div>
                        </div> 
                    </div> 
                </div>
            </div>
        </div>
    </div> 
</body>
</html>
@endsection
