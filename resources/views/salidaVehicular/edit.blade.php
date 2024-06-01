@extends('welcome')
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head> 
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0"  http-equiv="X-UA-Compatible" content="ie=edge">   
        <link rel="stylesheet" href="/css/sweetAlert2Style.css"/> 
        <link rel="stylesheet" href="/css/pretty-checkbox.min.css"/>
        <link rel="stylesheet" href="/css/salidadiseno.css"/> 
        <link rel="stylesheet" href="/css/toastr.min.css"/> 
        <script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script>  
        <script type="text/javascript" src="/js/jquery.maskedinput.js"></script>   
        <script type="text/javascript" src="/js/eventSalidaVehicular.js"></script> 
        <script type="text/javascript" src="/js/toastr.min.js"> </script> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css"/>    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>  
        <script>   
        $(document).ready(function() {  
            window.onload( inicioSelects());  
            update();
        }); 
        //funcion para habilitar los selects dependiendo si hay registro o no
        function inicioSelects(){
            var array1 = ["L", "MA", "MI", "J", "V", "S", "D"]
            var array2 = ['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo']
            var json = @json($indices);
            for (let index = 0; index < 7 ; index++) {     
                if(json[array2[index]] === false){ 
                    $("#choferSalida" + array1[index]).prop('disabled', true);  
                    
                    $("#choferIngreso" + array1[index]).prop('disabled', true);  
                    $("#guardaSalida" + array1[index]).prop('disabled', true);  
                    $("#guardaSalida" + array1[index]).prop('disabled', true);  
                }else{ 
                    $("#choferSalida" + array1[index]).prop('disabled', false);  
                    $("#choferIngreso" + array1[index]).prop('disabled', false);  
                    $("#guardaSalida" + array1[index]).prop('disabled', false);  
                    $("#guardaSalida" + array1[index]).prop('disabled', false);  
                }  
            } 
        } 
        //funcion para el actualizado de los registro
        function update(){
            $(".editar").click(function(){     
                //datos tabla principal salida entrada
                {
                    var id =  $('#id').val();
                    var oficinaSolicitante          = $('#oficinaSolicitante').val(); 
                    var placa                       = $('#placa').val() ; 
                    var fechaAutorizacionSalida     = dateFormat($('#fechaAutorizacionSalida').val());
                    var fechaAutorizacionIngreso    = dateFormat($('#fechaAutorizacionIngreso').val());
                    var totalKm = $('#totalKm').val();
                } 
                //datos tabla control kilometros combustibles
                var dias = { 'lunes': null, 'martes': null, 'miercoles': null, 'jueves': null, 'viernes': null, 'sabado': null, 'domingo': null}
                var data = { 'errors' : [] };     
                //datos lunes
                if($('#checkL').is(':checked')){
                    var fechaSalidaL      = $('#fechaSalidaL').val();
                    var horaSalidaL       = $('#horaSalidaL').val();
                    var horaIngresoL      = $('#horaIngresoL').val();
                    var kmSalidaL         = $('#kmSalidaL').val();
                    var kmIngresoL        = $('#kmIngresoL').val();
                    var combustibleSalidaL= $('#combustibleSalidaL').val();
                    var combustibleIngresoL= $('#combustibleIngresoL').val();
                    var choferSalidaL     = $('#choferSalidaL').val();
                    var choferIngresoL    = $('#choferIngresoL').val();
                    var guardaSalidaL     = $('#guardaSalidaL').val();
                    var guardaIngresoL    = $('#guardaIngresoL').val();   
                    if(fechaSalidaL=='' || horaSalidaL=='' || horaIngresoL=='' || kmSalidaL=='' || kmIngresoL=='' || combustibleSalidaL=='' || 
                        combustibleIngresoL=='' || choferSalidaL=='' || choferIngresoL=='' || guardaSalidaL=='' || guardaIngresoL==''){
                        data.errors.push('Complete todos los datos del día Lunes'); 
                    } 
                    dias['lunes'] = {
                                    'id'               : '{{$indices['lunes']  !== false ?  $resConSVKC[$indices['lunes']]->id : null }}',
                                    'fechaSalida'      : dateFormat(fechaSalidaL),
                                    'horaSalida'       : horaSalidaL,
                                    'horaIngreso'      : horaIngresoL,
                                    'kmSalida'         : kmSalidaL,
                                    'kmIngreso'        : kmIngresoL,
                                    'combustibleSalida': combustibleSalidaL,
                                    'combustibleIngreso': combustibleIngresoL,
                                    'choferSalida'     : choferSalidaL,
                                    'choferIngreso'    : choferIngresoL,
                                    'guardaSalida'     : guardaSalidaL,
                                    'guardaIngreso'    : guardaIngresoL
                                }  
                } 
                //datos martes
                if($('#checkMA').is(':checked')){
                    var fechaSalidaMA      = $('#fechaSalidaMA').val();
                    var horaSalidaMA       = $('#horaSalidaMA').val();
                    var horaIngresoMA      = $('#horaIngresoMA').val();
                    var kmSalidaMA         = $('#kmSalidaMA').val();
                    var kmIngresoMA        = $('#kmIngresoMA').val();
                    var combustibleSalidaMA= $('#combustibleSalidaMA').val();
                    var combustibleIngresoMA= $('#combustibleIngresoMA').val();
                    var choferSalidaMA     = $('#choferSalidaMA').val();
                    var choferIngresoMA    = $('#choferIngresoMA').val();
                    var guardaSalidaMA     = $('#guardaSalidaMA').val();
                    var guardaIngresoMA    = $('#guardaIngresoMA').val(); 
                    if(fechaSalidaMA=='' || horaSalidaMA=='' || horaIngresoMA=='' || kmSalidaMA=='' || kmIngresoMA=='' || combustibleSalidaMA=='' || 
                        combustibleIngresoMA=='' || choferSalidaMA=='' || choferIngresoMA=='' || guardaSalidaMA=='' || guardaIngresoMA==''){
                        data.errors.push('Complete todos los datos del día Martes'); 
                    }  
                    dias['martes'] = {
                                    'id'               : '{{$indices['martes']  !== false ?  $resConSVKC[$indices['martes']]->id : null }}',
                                    'fechaSalida'      : dateFormat(fechaSalidaMA),
                                    'horaSalida'       : horaSalidaMA,
                                    'horaIngreso'      : horaIngresoMA,
                                    'kmSalida'         : kmSalidaMA,
                                    'kmIngreso'        : kmIngresoMA,
                                    'combustibleSalida': combustibleSalidaMA,
                                    'combustibleIngreso': combustibleIngresoMA,
                                    'choferSalida'     : choferSalidaMA,
                                    'choferIngreso'    : choferIngresoMA,
                                    'guardaSalida'     : guardaSalidaMA,
                                    'guardaIngreso'    : guardaIngresoMA
                                } 
                } 
                //datos miercoles
                if($('#checkMI').is(':checked')){
                    var fechaSalidaMI        = $('#fechaSalidaMI').val();
                    var horaSalidaMI         = $('#horaSalidaMI').val();
                    var horaIngresoMI        = $('#horaIngresoMI').val();
                    var kmSalidaMI           = $('#kmSalidaMI').val();
                    var kmIngresoMI          = $('#kmIngresoMI').val();
                    var combustibleSalidaMI  = $('#combustibleSalidaMI').val();
                    var combustibleIngresoMI = $('#combustibleIngresoMI').val();
                    var choferSalidaMI       = $('#choferSalidaMI').val();
                    var choferIngresoMI      = $('#choferIngresoMI').val();
                    var guardaSalidaMI       = $('#guardaSalidaMI').val();
                    var guardaIngresoMI      = $('#guardaIngresoMI').val();
                    if(fechaSalidaMI=='' || horaSalidaMI=='' || horaIngresoMI=='' || kmSalidaMI=='' || kmIngresoMI=='' || combustibleSalidaMI=='' || 
                        combustibleIngresoMI=='' || choferSalidaMI=='' || choferIngresoMI=='' || guardaSalidaMI=='' || guardaIngresoMI==''){
                        data.errors.push('Complete todos los datos del día Miercoles'); 
                    } 
                    dias['miercoles'] = {
                                        'id'                 : '{{$indices['miercoles']  !== false ?  $resConSVKC[$indices['miercoles']]->id : null }}',
                                        'fechaSalida'        : dateFormat(fechaSalidaMI),
                                        'horaSalida'         : horaSalidaMI,
                                        'horaIngreso'        : horaIngresoMI,
                                        'kmSalida'           : kmSalidaMI,
                                        'kmIngreso'          : kmIngresoMI,
                                        'combustibleSalida'  : combustibleSalidaMI,
                                        'combustibleIngreso' : combustibleIngresoMI,
                                        'choferSalida'       : choferSalidaMI,
                                        'choferIngreso'      : choferIngresoMI,
                                        'guardaSalida'       : guardaSalidaMI,
                                        'guardaIngreso'      : guardaIngresoMI
                                    }  
                }
                //datos jueves
                if($('#checkJ').is(':checked')){
                    var fechaSalidaJ           = $('#fechaSalidaJ').val(); 
                    var horaSalidaJ            = $('#horaSalidaJ').val(); 
                    var horaIngresoJ           = $('#horaIngresoJ').val(); 
                    var kmSalidaJ              = $('#kmSalidaJ').val(); 
                    var kmIngresoJ             = $('#kmIngresoJ').val(); 
                    var combustibleSalidaJ     = $('#combustibleSalidaJ').val(); 
                    var combustibleIngresoJ    = $('#combustibleIngresoJ').val(); 
                    var choferSalidaJ          = $('#choferSalidaJ').val(); 
                    var choferIngresoJ         = $('#choferIngresoJ').val(); 
                    var guardaSalidaJ          = $('#guardaSalidaJ').val(); 
                    var guardaIngresoJ         = $('#guardaIngresoJ').val();
                    if(fechaSalidaJ=='' || horaSalidaJ=='' || horaIngresoJ=='' || kmSalidaJ=='' || kmIngresoJ=='' || combustibleSalidaJ=='' || 
                        combustibleIngresoJ=='' || choferSalidaJ=='' || choferIngresoJ=='' || guardaSalidaJ=='' || guardaIngresoJ==''){
                        data.errors.push('Complete todos los datos del día Jueves'); 
                    } 
                    dias['jueves'] = {
                                        'id'                    : '{{$indices['jueves']  !== false ?  $resConSVKC[$indices['jueves']]->id : null }}',
                                        'fechaSalida'           : dateFormat(fechaSalidaJ), 
                                        'horaSalida'            : horaSalidaJ, 
                                        'horaIngreso'           : horaIngresoJ, 
                                        'kmSalida'              : kmSalidaJ, 
                                        'kmIngreso'             : kmIngresoJ, 
                                        'combustibleSalida'     : combustibleSalidaJ, 
                                        'combustibleIngreso'    : combustibleIngresoJ, 
                                        'choferSalida'          : choferSalidaJ, 
                                        'choferIngreso'         : choferIngresoJ, 
                                        'guardaSalida'          : guardaSalidaJ, 
                                        'guardaIngreso'         : guardaIngresoJ
                                    } 
                }
                //datos viernes
                if($('#checkV').is(':checked')){
                    var fechaSalidaV          = $('#fechaSalidaV').val(); 
                    var horaSalidaV           = $('#horaSalidaV').val(); 
                    var horaIngresoV          = $('#horaIngresoV').val(); 
                    var kmSalidaV             = $('#kmSalidaV').val(); 
                    var kmIngresoV            = $('#kmIngresoV').val(); 
                    var combustibleSalidaV    = $('#combustibleSalidaV').val(); 
                    var combustibleIngresoV   = $('#combustibleIngresoV').val(); 
                    var choferSalidaV         = $('#choferSalidaV').val(); 
                    var choferIngresoV        = $('#choferIngresoV').val(); 
                    var guardaSalidaV         = $('#guardaSalidaV').val(); 
                    var guardaIngresoV        = $('#guardaIngresoV').val();
                    if(fechaSalidaV=='' || horaSalidaV=='' || horaIngresoV=='' || kmSalidaV=='' || kmIngresoV=='' || combustibleSalidaV=='' || 
                        combustibleIngresoV=='' || choferSalidaV=='' || choferIngresoV=='' || guardaSalidaV=='' || guardaIngresoV==''){
                        data.errors.push('Complete todos los datos del día Viernes'); 
                    }
                    dias['viernes'] = {
                                        'id'                   : '{{$indices['viernes']  !== false ?  $resConSVKC[$indices['viernes']]->id : null }}',
                                        'fechaSalida'          : dateFormat(fechaSalidaV), 
                                        'horaSalida'           : horaSalidaV, 
                                        'horaIngreso'          : horaIngresoV, 
                                        'kmSalida'             : kmSalidaV, 
                                        'kmIngreso'            : kmIngresoV, 
                                        'combustibleSalida'    : combustibleSalidaV, 
                                        'combustibleIngreso'   : combustibleIngresoV, 
                                        'choferSalida'         : choferSalidaV, 
                                        'choferIngreso'        : choferIngresoV, 
                                        'guardaSalida'         : guardaSalidaV, 
                                        'guardaIngreso'        : guardaIngresoV
                                    } 
                }
                //datos sabado
                if($('#checkS').is(':checked')){
                    var fechaSalidaS           = $('#fechaSalidaS').val();
                    var horaSalidaS            = $('#horaSalidaS').val(); 
                    var horaIngresoS           = $('#horaIngresoS').val(); 
                    var kmSalidaS              = $('#kmSalidaS').val(); 
                    var kmIngresoS             = $('#kmIngresoS').val(); 
                    var combustibleSalidaS     = $('#combustibleSalidaS').val(); 
                    var combustibleIngresoS    = $('#combustibleIngresoS').val(); 
                    var choferSalidaS          = $('#choferSalidaS').val(); 
                    var choferIngresoS         = $('#choferIngresoS').val(); 
                    var guardaSalidaS          = $('#guardaSalidaS').val(); 
                    var guardaIngresoS         = $('#guardaIngresoS').val();
                    if(fechaSalidaS=='' || horaSalidaS=='' || horaIngresoS=='' || kmSalidaS=='' || kmIngresoS=='' || combustibleSalidaS=='' || 
                        combustibleIngresoS=='' || choferSalidaS=='' || choferIngresoS=='' || guardaSalidaS=='' || guardaIngresoS==''){
                        data.errors.push('Complete todos los datos del día Sábado'); 
                    } 
                    dias['sabado'] = {
                                        'id'                    : '{{$indices['sabado']  !== false ?  $resConSVKC[$indices['sabado']]->id : null }}',
                                        'fechaSalida'           : dateFormat(fechaSalidaS), 
                                        'horaSalida'            : horaSalidaS, 
                                        'horaIngreso'           : horaIngresoS, 
                                        'kmSalida'              : kmSalidaS, 
                                        'kmIngreso'             : kmIngresoS, 
                                        'combustibleSalida'     : combustibleSalidaS, 
                                        'combustibleIngreso'    : combustibleIngresoS, 
                                        'choferSalida'          : choferSalidaS, 
                                        'choferIngreso'         : choferIngresoS, 
                                        'guardaSalida'          : guardaSalidaS, 
                                        'guardaIngreso'         : guardaIngresoS
                                }  
                }
                //datos domingo
                if($('#checkD').is(':checked')){ 
                    var fechaSalidaD          = $('#fechaSalidaD').val(); 
                    var horaSalidaD           = $('#horaSalidaD').val(); 
                    var horaIngresoD          = $('#horaIngresoD').val(); 
                    var kmSalidaD             = $('#kmSalidaD').val(); 
                    var kmIngresoD            = $('#kmIngresoD').val(); 
                    var combustibleSalidaD    = $('#combustibleSalidaD').val(); 
                    var combustibleIngresoD   = $('#combustibleIngresoD').val(); 
                    var choferSalidaD         = $('#choferSalidaD').val(); 
                    var choferIngresoD        = $('#choferIngresoD').val(); 
                    var guardaSalidaD         = $('#guardaSalidaD').val(); 
                    var guardaIngresoD        = $('#guardaIngresoD').val();
                    if(fechaSalidaD=='' || horaSalidaD=='' || horaIngresoD=='' || kmSalidaD=='' || kmIngresoD=='' || combustibleSalidaD=='' || 
                        combustibleIngresoD=='' || choferSalidaD=='' || choferIngresoD=='' || guardaSalidaD=='' || guardaIngresoD==''){
                        data.errors.push('Complete todos los datos del día Domingo'); 
                    } 
                    dias['domingo'] = {
                                    'id'                   : '{{$indices['domingo']  !== false ?  $resConSVKC[$indices['domingo']]->id : null }}',
                                    'fechaSalida'          : dateFormat(fechaSalidaD), 
                                    'horaSalida'           : horaSalidaD, 
                                    'horaIngreso'          : horaIngresoD, 
                                    'kmSalida'             : kmSalidaD, 
                                    'kmIngreso'            : kmIngresoD, 
                                    'combustibleSalida'    : combustibleSalidaD, 
                                    'combustibleIngreso'   : combustibleIngresoD, 
                                    'choferSalida'         : choferSalidaD, 
                                    'choferIngreso'        : choferIngresoD, 
                                    'guardaSalida'         : guardaSalidaD, 
                                    'guardaIngreso'        : guardaIngresoD
                                } 
                } 
                //datos control accesorios salida
                { 
                    var accesSalid = {  'id'                : "{{$salVeAcce->idca}}",
                                        'radioSalida'       : $('input:radio[name=radio]:checked').val(),
                                        'encendedorSalida'  : $('input:radio[name=encendedor]:checked').val(),
                                        'alfombrasSalida'   : $('input:radio[name=alfombras]:checked').val(),
                                        'antenaSalida'      : $('input:radio[name=antena]:checked').val(),
                                        'espejoExtSalida'   : $('input:radio[name=espejoExt]:checked').val(),
                                        'espejoIntSalida'   : $('input:radio[name=espejoInt]:checked').val(),
                                        'extintorSalida'    : $('input:radio[name=extintor]:checked').val(),
                                        'gataSalida'        : $('input:radio[name=gata]:checked').val(),
                                        'llaveRanaSalida'   : $('input:radio[name=llaveRana]:checked').val(),
                                        'llaveRepuestoSalida': $('input:radio[name=llaveRepuesto]:checked').val(),
                                        'triangulosSalida'  : $('input:radio[name=triangulos]:checked').val(),
                                        'observacionesSalida': $('#observacionesS').val()};
                } 
                //datos control carrocería
                { 
                    var carroceria   = {'id'                : "{{$salVehiCarrPrinc->idcc}}",
                                        'bumperT'           : $('input:radio[name=bumperT]:checked').val(),
                                        'bumperD'           : $('input:radio[name=bumperD]:checked').val(),
                                        'guardaBDT'         : $('input:radio[name=guardaBDT]:checked').val(),
                                        'guardaBIT'         : $('input:radio[name=guardaBIT]:checked').val(),
                                        'guardaBID'         : $('input:radio[name=guardaBID]:checked').val(),
                                        'guardaBDD'         : $('input:radio[name=guardaBDD]:checked').val(),
                                        'tapaBaul'          : $('input:radio[name=tapaBaul]:checked').val(),
                                        'tapaMotor'         : $('input:radio[name=tapaMotor]:checked').val(),
                                        'parabrisasT'       : $('input:radio[name=parabrisasT]:checked').val(),
                                        'parabrisasD'       : $('input:radio[name=parabrisasD]:checked').val(),
                                        'puertaTI'          : $('input:radio[name=puertaTI]:checked').val(),
                                        'puertaTD'          : $('input:radio[name=puertaTD]:checked').val(), 
                                        'puertaDI'          : $('input:radio[name=puertaDI]:checked').val(),
                                        'puertaDD'          : $('input:radio[name=puertaDD]:checked').val(),
                                        'quicioD'           : $('input:radio[name=quicioD]:checked').val(),
                                        'quicioI'           : $('input:radio[name=quicioI]:checked').val(),
                                        'techo'             : $('input:radio[name=techo]:checked').val(),
                                        'observacionesCarro': $('#observacionesCarro').val()};
                }
                //datos control accesorios entrada
                {   
                    var accesEntrad = { 'id'                 : "{{$entVeAcce->idca}}",
                                        'radioEntrada'       : $('input:radio[name=radioE]:checked').val(),
                                        'encendedorEntrada'  : $('input:radio[name=encendedorE]:checked').val(),
                                        'alfombrasEntrada'   : $('input:radio[name=alfombrasE]:checked').val(),
                                        'antenaEntrada'      : $('input:radio[name=antenaE]:checked').val(),
                                        'espejoExtEntrada'   : $('input:radio[name=espejoExtE]:checked').val(),
                                        'espejoIntEntrada'   : $('input:radio[name=espejoIntE]:checked').val(),
                                        'extintorEntrada'    : $('input:radio[name=extintorE]:checked').val(),
                                        'gataEntrada'        : $('input:radio[name=gataE]:checked').val(),
                                        'llaveRanaEntrada'   : $('input:radio[name=llaveRanaE]:checked').val(),
                                        'llaveRepuestoEntrada': $('input:radio[name=llaveRepuestoE]:checked').val(),
                                        'triangulosEntrada'  : $('input:radio[name=triangulosE]:checked').val(),
                                        'observacionesSEntrada': $('#observacionesE').val()};
                }  
                if(data.errors.length > 0){
                    mensajes(data);
                }else{
                    Swal.fire({
                        title: "¿Está Seguro de Realizar la Actualización?",
                        text:  "El Registro será Actualizado en el Sistema" ,
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
                                url: "/editarSalidaVehicular/" + id, 
                                type: 'POST',  
                                statusCode: {
                                    302: function() { 
                                        setTimeout("location.href='/'", 100); 
                                    }
                                },
                                data: {
                                    "oficinaSolicitante"        : oficinaSolicitante, 
                                    "fechaAutorizacionSalida"   : fechaAutorizacionSalida,
                                    "fechaAutorizacionIngreso"  : fechaAutorizacionIngreso, 
                                    "placa"                     : placa,  
                                    "totalKm"                   : totalKm,
                                    "accesoriosSalida"          : accesSalid,
                                    "accesoriosEntrada"         : accesEntrad,
                                    "carroceria"                : carroceria,
                                    "dias"                      : dias,
                                    "_token": $("meta[name='csrf-token']").attr("content"),
                                },  
                                success: function (data){
                                    if($.isEmptyObject(data.errors)){ 
                                        Swal.fire({
                                            title: "¡Registro Actualizado!",
                                            type: 'success',
                                            showCancelButton: false,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'Aceptar',
                                        }).then(function() {
                                         setTimeout("location.href='/vistaInicial/"+placa+"'", 100); 
                                        });
                                    }
                                    else{
                                        mensajes(data);                 
                                    }
                                    
                                }
                            });
                        } 
                        else 
                        {
                            Swal.fire
                            ({
                                title:"¡Cancelado!", 
                                text: "Registro No Editado",
                                type: "error", 
                                buttons: "Aceptar", 
                                confirmButtonText: 'Aceptar',
                                timer: 2000,
                            });
                        }
                    });
                }
            }); 
        } 
        //funcion mostrar mensajes
        function mensajes(data){
            var descripcion = ""; 
            $.each(data.errors, function(i, item) {
                descripcion+=   "<div class='alert alert-danger alert-dismissable'>"+
                                " <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times; </button> "+  
                                item + 
                                "</div>";
            }); 
            $("#parent").html(descripcion);  
            toastr.error("Soluciones los errores que se encuentra listados arriba",{ timeOut:5000, closeButton: true, preventDuplicates: true});
        }
        </script>
    </head>
    <body> 
        <div class="row">
            <div id="parent">   
            </div> 
        </div>      
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-heading text-center">
                        <br>
                            <h2 class="titulo">REGISTRO DE INGRESO Y SALIDA DEL VEHÍCULO <div style="color: blue;">{{$placa}}</div></h2> 
                            <h3 class="subtitulo">Unidad Tecnica Administrativa Transporte </h3>  
                            <input type="text" id="placa" value="{{$placa}}" style="display: none;">
                            <input type="text" id="id" value="{{ $salVehiCarrPrinc->id }}" style="display: none;">
                        <br>
                    </div>
                    <div class="card-body">  
                        <div class="form-horizontal">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group row">
                                        <label for="oficinaSolicitante" class="col-form-label text-md-right subtitulo"> Oficina Solicitante: </label> 
                                        <div class="col-md-6">
                                            <select class="form-control" name="oficinaSolicitante" id="oficinaSolicitante">
                                                <option value=" "> -SELECCIONE- </option>
                                                @foreach($oficinas as $oficina)
                                                    @if($oficina->id == $salVehiCarrPrinc->idDepartamento)<option value="{{$oficina->id}}" selected="true">  {{$oficina->nombreDeparta}} </option>
                                                        @else <option value="{{$oficina->id}}">  {{$oficina->nombreDeparta}} </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>  
                                </div> 
                                <div class="col-lg-4">
                                    <div class="form-group row">
                                        <label for="fechaAutorizacionSalida" class=" col-form-label text-md-right subtitulo">Fecha Autorización Paso De Vehículo:  Del</label> 
                                        <div class="col-md-5"> 
                                            <input id="fechaAutorizacionSalida" type="text" readonly class="form-control datepicker" name="fechaAutorizacionSalida" value="{{date('d/m/Y', strtotime($salVehiCarrPrinc->fechaAutorizacionSalida))}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group row">
                                        <label for="fechaAutorizacionIngreso" class="col-form-label text-md-right subtitulo" >{{ __('al ') }}</label> 
                                        <div class="col-md-10">
                                            <input id="fechaAutorizacionIngreso" type="text" readonly class="form-control datepicker" name="fechaAutorizacionIngreso" value="{{date('d/m/Y', strtotime($salVehiCarrPrinc->fechaAutorizacionIngreso))}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <br> 
                        <div class="card-heading text-center">
                            <h3 class="titulo"> Control de Kilometraje y Combustible</h3>  
                        </div>
                        <div class="table table-responsive"> 
                            <table class="table">
                                <thead>  
                                    <tr>
                                        <th class="text-center thtitulo1" rowspan="2">
                                            <div id="tooltipCheck" class="fa fa-question fa-lg" data-toggle="tooltip" data-placement="bottom" title="Solo se guardan los días selecionados" style="color: blue"></div> 
                                            <br>
                                            DÍA     
                                        </th>  
                                        <th class="text-center thtitulo1" rowspan="2">FECHA</th>   
                                        <th class="text-center thtitulo2" rowspan="2">HORA SALIDA PLANTEL</th>  
                                        <th class="text-center thtitulo2" rowspan="2">HORA ENTRADA PLANTEL</th>  
                                        <th class="text-center thtitulo3" colspan="2">KILOMETRAJE</th>   
                                        <th class="text-center thtitulo3" colspan="2">COMBUSTIBLE EN TANQUE</th>   
                                        <th class="text-center thtitulo3" colspan="2">CHOFER</th>     
                                        <th class="text-center thtitulo3" colspan="2">GUARDA</th>   
                                    </tr>
                                    <tr> 
                                        <th>SAL.PLANTEL</th>  
                                        <th>ENT.PLANTEL</th>   
                                        <th>INICIAL</th>  
                                        <th>FINAL</th>   
                                        <th>SALIDA</th>   
                                        <th>ENTRADA</th>    
                                        <th>SALIDA</th>   
                                        <th>ENTRADA</th>   
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--lUNES --> 
                                    <tr>
                                        <td class="td td1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="checkbox" id="checkL" {{$indices['lunes'] !== false ? 'checked':''}}/> 
                                                <div class="state p-success">
                                                    <label>LUNES</label>
                                                </div>
                                            </div> 
                                        </td>
                                        <td class="td td2">
                                            @if($indices['lunes'] !== false)<input id="fechaSalidaL" type="text" readonly class="clearBorder form-control datepicker" name="fechaSalidaL" value="{{date('d/m/Y', strtotime($resConSVKC[$indices['lunes']]->fecha))}}">
                                                @else <input id="fechaSalidaL" type="text" readonly class="clearBorder form-control datepicker" name="fechaSalidaL">
                                            @endif 
                                        </td>
                                        <td class="td td3">
                                            @if($indices['lunes'] !== false)<input id="horaSalidaL" type="text" class="clearBorder form-control timepicker" name="horaSalidaL" value="{{date('H:i', strtotime($resConSVKC[$indices['lunes']]->horaSalida))}}">
                                                @else<input id="horaSalidaL" type="text" class="clearBorder form-control timepicker" name="horaSalidaL">
                                            @endif 
                                        </td>
                                        <td class="td td4">
                                            @if($indices['lunes'] !== false)<input id="horaIngresoL" type="text" class="clearBorder form-control timepicker" name="horaIngresoL" value="{{date('H:i', strtotime($resConSVKC[$indices['lunes']]->horaIngreso))}}">
                                                @else<input id="horaIngresoL" type="text" class="clearBorder form-control timepicker" name="horaIngresoL">
                                            @endif 
                                        </td>
                                        <td class="td td5">
                                            @if($indices['lunes'] !== false)<input id="kmSalidaL" type="number" class="clearBorder form-control" name="kmSalidaL" value="{{$resConSVKC[$indices['lunes']]->kmSalida}}">
                                                @else<input id="kmSalidaL" type="number" class="clearBorder form-control" name="kmSalidaL">
                                            @endif 
                                        </td>
                                        <td class="td td6">
                                            @if($indices['lunes'] !== false)<input id="kmIngresoL" type="number" class="clearBorder form-control" name="kmIngresoL" value="{{$resConSVKC[$indices['lunes']]->kmIngreso}}">
                                                @else<input id="kmIngresoL" type="number" class="clearBorder form-control" name="kmIngresoL">
                                            @endif 
                                        </td>
                                        <td class="td td7">
                                            @if($indices['lunes'] !== false)<input id="combustibleSalidaL" type="number" class="clearBorder form-control" name="combustibleSalidaL" value="{{$resConSVKC[$indices['lunes']]->combustibleSalida}}">
                                                @else<input id="combustibleSalidaL" type="number" class="clearBorder form-control">
                                            @endif 
                                        </td>
                                        <td class="td td8">
                                            @if($indices['lunes'] !== false)<input id="combustibleIngresoL" type="number" class="clearBorder form-control" name="combustibleIngresoL" value="{{$resConSVKC[$indices['lunes']]->combustibleIngreso}}">
                                                @else<input id="combustibleIngresoL" type="number" class="clearBorder form-control" name="combustibleIngresoL">
                                            @endif 
                                        </td>
                                        <td class="td td9">  
                                            <select name="choferSalidaL" id="choferSalidaL" class="clearBorder">
                                                <option value=" "> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario) 
                                                    @if($indices['lunes'] !== false)
                                                        @if($usuario->id == $resConSVKC[$indices['lunes']]->choferSalida)
                                                            <option value="{{$usuario->id}}" selected="true"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @else<option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @endif 
                                                    @else<option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                    @endif 
                                                @endforeach
                                            </select>  
                                        </td>
                                        <td class="td td10">  
                                            <select name="choferIngresoL" id="choferIngresoL" class="clearBorder">
                                                <option value=" "> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario) 
                                                    @if($indices['lunes'] !== false)
                                                        @if($usuario->id == $resConSVKC[$indices['lunes']]->choferIngreso)
                                                            <option value="{{$usuario->id}}" selected="true"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @endif 
                                                    @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                    @endif
                                                @endforeach
                                            </select>   
                                        </td>
                                        <td class="td td11">  
                                            <select name="guardaSalidaL" id="guardaSalidaL" class="clearBorder">
                                                <option value=" "> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario) 
                                                    @if($indices['lunes'] !== false)
                                                        @if($usuario->id == $resConSVKC[$indices['lunes']]->guardaSalida)
                                                            <option value="{{$usuario->id}}" selected="true"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @endif 
                                                    @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                    @endif 
                                                @endforeach
                                            </select>    
                                        </td>
                                        <td class="td td12">
                                            <select name="guardaIngresoL" id="guardaIngresoL" class="clearBorder">
                                                <option value=" "> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario) 
                                                    @if($indices['lunes'] !== false)
                                                        @if($usuario->id == $resConSVKC[$indices['lunes']]->guardaIngreso)
                                                            <option value="{{$usuario->id}}" selected="true"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @endif 
                                                    @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                    @endif 
                                                @endforeach
                                            </select>     
                                        </td>  
                                    </tr> 
                                    <!--MARTES -->
                                    <tr>
                                        <td class="td td1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="checkbox" id="checkMA" {{$indices['martes'] !== false ? 'checked':''}}/> 
                                                <div class="state p-success">
                                                    <label>MARTES</label>
                                                </div>
                                            </div> 
                                        </td>
                                        <td class="td td2">
                                            @if($indices['martes'] !== false)<input id="fechaSalidaMA" type="text" readonly class="clearBorder form-control datepicker" name="fechaSalidaMA" value="{{date('d/m/Y', strtotime($resConSVKC[$indices['martes']]->fecha))}}">
                                                @else<input id="fechaSalidaMA" type="text" readonly class="clearBorder form-control datepicker" name="fechaSalidaMA">
                                            @endif 
                                        </td>
                                        <td class="td td3">
                                            @if($indices['martes'] !== false)<input id="horaSalidaMA" type="text" class="clearBorder form-control timepicker" name="horaSalidaMA" value="{{date('H:i', strtotime($resConSVKC[$indices['martes']]->horaSalida))}}">
                                                @else<input id="horaSalidaMA" type="text" class="clearBorder form-control timepicker" name="horaSalidaMA">
                                            @endif 
                                        </td>
                                        <td class="td td4">
                                            @if($indices['martes'] !== false)<input id="horaIngresoMA" type="text" class="clearBorder form-control timepicker" name="horaIngresoMA" value="{{date('H:i', strtotime($resConSVKC[$indices['martes']]->horaIngreso))}}">
                                                @else<input id="horaIngresoMA" type="text" class="clearBorder form-control timepicker" name="horaIngresoMA" >
                                            @endif 
                                        </td>
                                        <td class="td td5"> 
                                            @if($indices['martes'] !== false) <input id="kmSalidaMA"  type="number" class="clearBorder form-control conteo" name="kmSalidaMA" value="{{$resConSVKC[$indices['martes']]->kmSalida}}">
                                                @else<input id="kmSalidaMA"  type="number" class="clearBorder form-control conteo" name="kmSalidaMA">
                                            @endif 
                                        </td>
                                        <td class="td td6">
                                            @if($indices['martes'] !== false)  <input id="kmIngresoMA"  type="number" class="clearBorder form-control conteo" name="kmIngresoMA" value="{{$resConSVKC[$indices['martes']]->kmIngreso}}">
                                                @else<input id="kmIngresoMA"  type="number" class="clearBorder form-control conteo" name="kmIngresoMA">
                                            @endif 
                                        </td>
                                        <td class="td td7">
                                            @if($indices['martes'] !== false)  <input id="combustibleSalidaMA"  type="number" class="clearBorder form-control" name="combustibleSalidaMA" value="{{$resConSVKC[$indices['martes']]->combustibleSalida}}">
                                                @else<input id="combustibleSalidaMA"  type="number" class="clearBorder form-control" name="combustibleSalidaMA">
                                            @endif 
                                        </td>
                                        <td class="td td8">
                                            @if($indices['martes'] !== false) <input id="combustibleIngresoMA"  type="number" class="clearBorder form-control" name="combustibleIngresoMA" value="{{$resConSVKC[$indices['martes']]->combustibleIngreso}}">
                                                @else<input id="combustibleIngresoMA"  type="number" class="clearBorder form-control" name="combustibleIngresoMA" >
                                            @endif 
                                        </td>
                                        <td class="td td9">
                                            <select name="choferSalidaMA" id="choferSalidaMA" class="clearBorder">
                                                <option value=" "> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario) 
                                                    @if($indices['martes'] !== false)
                                                        @if($usuario->id == $resConSVKC[$indices['martes']]->choferSalida)
                                                            <option value="{{$usuario->id}}" selected="true"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @endif 
                                                    @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                    @endif 
                                                @endforeach
                                            </select>  
                                        </td>
                                        <td class="td td10">
                                            <select name="choferIngresoMA" id="choferIngresoMA" class="clearBorder">
                                                <option value=" "> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario) 
                                                    @if($indices['martes'] !== false)
                                                        @if($usuario->id == $resConSVKC[$indices['martes']]->choferIngreso)
                                                            <option value="{{$usuario->id}}" selected="true"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @endif 
                                                    @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                    @endif 
                                                @endforeach
                                            </select>   
                                        </td>
                                        <td class="td td11">
                                            <select name="guardaSalidaMA" id="guardaSalidaMA" class="clearBorder">
                                                <option value=" "> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario) 
                                                    @if($indices['martes'] !== false)
                                                        @if($usuario->id == $resConSVKC[$indices['martes']]->guardaSalida)
                                                            <option value="{{$usuario->id}}" selected="true"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @endif 
                                                    @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                    @endif 
                                                @endforeach
                                            </select>   
                                        </td>
                                        <td class="td td12">
                                            <select name="guardaIngresoMA" id="guardaIngresoMA" class="clearBorder">
                                                <option value=" "> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario) 
                                                    @if($indices['martes'] !== false)
                                                        @if($usuario->id == $resConSVKC[$indices['martes']]->guardaIngreso)
                                                            <option value="{{$usuario->id}}" selected="true"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @endif 
                                                    @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                    @endif 
                                                @endforeach
                                            </select>   
                                        </td>   
                                    </tr> 
                                    <!--MIERCOLES -->
                                    <tr>
                                        <td class="td td1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="checkbox" id="checkMI" {{$indices['miercoles'] !== false ? 'checked':''}}/> 
                                                <div class="state p-success">
                                                    <label>MIERCOLES</label>
                                                </div>
                                            </div> 
                                        </td>
                                        <td class="td td2">
                                            @if($indices['miercoles'] !== false) <input id="fechaSalidaMI" type="text" readonly class="clearBorder form-control datepicker" name="fechaSalidaMI" value="{{date('d/m/Y', strtotime($resConSVKC[$indices['miercoles']]->fecha))}}"> 
                                                @else<input id="fechaSalidaMI" type="text" readonly class="clearBorder form-control datepicker" name="fechaSalidaMI" >
                                            @endif 
                                        </td>
                                        <td class="td td3">
                                            @if($indices['miercoles'] !== false) <input id="horaSalidaMI" type="text" class="clearBorder form-control timepicker" name="horaSalidaMI" value="{{date('H:i', strtotime($resConSVKC[$indices['miercoles']]->horaSalida))}}"> 
                                                @else<input id="horaSalidaMI" type="text" class="clearBorder form-control timepicker" name="horaSalidaMI">
                                            @endif 
                                        </td>
                                        <td class="td td4">
                                            @if($indices['miercoles'] !== false) <input id="horaIngresoMI" type="text" class="clearBorder form-control timepicker" name="horaIngresoMI" value="{{date('H:i', strtotime($resConSVKC[$indices['miercoles']]->horaIngreso))}}"> 
                                                @else<input id="horaIngresoMI" type="text" class="clearBorder form-control timepicker">
                                            @endif 
                                        </td>
                                        <td class="td td5">
                                            @if($indices['miercoles'] !== false) <input id="kmSalidaMI"  type="number" class="clearBorder form-control" name="kmSalidaMI" value="{{$resConSVKC[$indices['miercoles']]->kmSalida}}"> 
                                                @else<input id="kmSalidaMI"  type="number" class="clearBorder form-control" name="kmSalidaMI">
                                            @endif 
                                        </td>
                                        <td class="td td6">
                                            @if($indices['miercoles'] !== false) <input id="kmIngresoMI"  type="number" class="clearBorder form-control" name="kmIngresoMI" value="{{$resConSVKC[$indices['miercoles']]->kmIngreso}}"> 
                                                @else<input id="kmIngresoMI"  type="number" class="clearBorder form-control" name="kmIngresoMI" >
                                            @endif 
                                        </td>
                                        <td class="td td7">
                                            @if($indices['miercoles'] !== false) <input id="combustibleSalidaMI"  type="number" class="clearBorder form-control" name="combustibleSalidaMI" value="{{$resConSVKC[$indices['miercoles']]->combustibleSalida}}"> 
                                                @else<input id="combustibleSalidaMI"  type="number" class="clearBorder form-control" name="combustibleSalidaMI">
                                            @endif 
                                        </td>
                                        <td class="td td8">
                                            @if($indices['miercoles'] !== false)<input id="combustibleIngresoMI"  type="number" class="clearBorder form-control conteo" name="combustibleIngresoMI" value="{{$resConSVKC[$indices['miercoles']]->combustibleIngreso}}"> 
                                                @else<input id="combustibleIngresoMI"  type="number" class="clearBorder form-control conteo" name="combustibleIngresoMI">
                                            @endif 
                                        </td>
                                        <td class="td td9">
                                            <select name="choferSalidaMI" id="choferSalidaMI" class="clearBorder">
                                                <option value=" "> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario) 
                                                    @if($indices['miercoles'] !== false)
                                                        @if($usuario->id == $resConSVKC[$indices['miercoles']]->choferSalida)
                                                            <option value="{{$usuario->id}}" selected="true"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @endif 
                                                    @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                    @endif 
                                                @endforeach
                                            </select>    
                                        </td>
                                        <td class="td td10">
                                            <select name="choferIngresoMI" id="choferIngresoMI" class="clearBorder">
                                                <option value=" "> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario) 
                                                    @if($indices['miercoles'] !== false)
                                                        @if($usuario->id == $resConSVKC[$indices['miercoles']]->choferIngreso)
                                                            <option value="{{$usuario->id}}" selected="true"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @endif 
                                                    @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                    @endif 
                                                @endforeach
                                            </select>     
                                        </td>
                                        <td class="td td11">
                                            <select name="guardaSalidaMI" id="guardaSalidaMI" class="clearBorder">
                                                <option value=" "> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario) 
                                                    @if($indices['miercoles'] !== false)
                                                        @if($usuario->id == $resConSVKC[$indices['miercoles']]->guardaSalida)
                                                            <option value="{{$usuario->id}}" selected="true"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @endif
                                                    @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                    @endif
                                                @endforeach
                                            </select>      
                                        </td>
                                        <td class="td td12">
                                            <select name="guardaIngresoMI" id="guardaIngresoMI" class="clearBorder">
                                                <option value=" "> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario) 
                                                    @if($indices['miercoles'] !== false)
                                                        @if($usuario->id == $resConSVKC[$indices['miercoles']]->guardaIngreso)
                                                            <option value="{{$usuario->id}}" selected="true"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @endif 
                                                    @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                    @endif 
                                                @endforeach
                                            </select>     
                                        </td>  
                                    </tr> 
                                    <!--JUEVES -->
                                    <tr>
                                        <td class="td td1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="checkbox" id="checkJ" {{$indices['jueves'] !== false ? 'checked':''}}/> 
                                                <div class="state p-success">
                                                    <label>JUEVES</label>
                                                </div>
                                            </div> 
                                        </td>
                                        <td class="td td2">
                                            @if($indices['jueves'] !== false)<input id="fechaSalidaJ" type="text" readonly class="clearBorder form-control datepicker" name="fechaSalidaJ" value="{{date('d/m/Y', strtotime($resConSVKC[$indices['jueves']]->fecha))}}"> 
                                                @else<input id="fechaSalidaJ" type="text" readonly class="clearBorder form-control datepicker" name="fechaSalidaJ" >
                                            @endif
                                        </td>
                                        <td class="td td3">
                                            @if($indices['jueves'] !== false)<input id="horaSalidaJ" type="text" class="clearBorder form-control timepicker" name="horaSalidaJ"  value="{{date('H:i', strtotime($resConSVKC[$indices['jueves']]->horaSalida))}}"> 
                                                @else<input id="horaSalidaJ" type="text" class="clearBorder form-control timepicker" name="horaSalidaJ" >
                                            @endif
                                        </td>
                                        <td class="td td4">
                                            @if($indices['jueves'] !== false)<input id="horaIngresoJ" type="text" class="clearBorder form-control timepicker" name="horaIngresoJ" value="{{date('H:i', strtotime($resConSVKC[$indices['jueves']]->horaIngreso))}}"> 
                                                @else<input id="horaIngresoJ" type="text" class="clearBorder form-control timepicker" name="horaIngresoJ">
                                            @endif
                                        </td>
                                        <td class="td td5">
                                            @if($indices['jueves'] !== false)<input id="kmSalidaJ"  type="number" class="clearBorder form-control conteo" name="kmSalidaJ" value="{{$resConSVKC[$indices['jueves']]->kmSalida}}"> 
                                                @else<input id="kmSalidaJ"  type="number" class="clearBorder form-control conteo" name="kmSalidaJ">
                                            @endif
                                        </td>
                                        <td class="td td6">
                                            @if($indices['jueves'] !== false)<input id="kmIngresoJ"  type="number" class="clearBorder form-control conteo" name="kmIngresoJ" value="{{$resConSVKC[$indices['jueves']]->kmIngreso}}"> 
                                                @else<input id="kmIngresoJ"  type="number" class="clearBorder form-control conteo" name="kmIngresoJ">
                                            @endif
                                        </td>
                                        <td class="td td7">
                                            @if($indices['jueves'] !== false)<input id="combustibleSalidaJ"  type="number" class="clearBorder form-control" name="combustibleSalidaJ" value="{{$resConSVKC[$indices['jueves']]->combustibleSalida}}"> 
                                                @else<input id="combustibleSalidaJ"  type="number" class="clearBorder form-control" name="combustibleSalidaJ">
                                            @endif
                                        </td>
                                        <td class="td td8">
                                            @if($indices['jueves'] !== false)<input id="combustibleIngresoJ"  type="number" class="clearBorder form-control" name="combustibleIngresoJ" value="{{$resConSVKC[$indices['jueves']]->combustibleIngreso}}">
                                                @else<input id="combustibleIngresoJ"  type="number" class="clearBorder form-control" name="combustibleIngresoJ">
                                            @endif 
                                        </td>
                                        <td class="td td9">
                                            <select name="choferSalidaJ" id="choferSalidaJ" class="clearBorder">
                                                <option value=" "> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario) 
                                                    @if($indices['jueves'] !== false)
                                                        @if($usuario->id == $resConSVKC[$indices['jueves']]->choferSalida)
                                                            <option value="{{$usuario->id}}" selected="true"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @endif 
                                                    @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                    @endif 
                                                @endforeach
                                            </select>     
                                        </td>
                                        <td class="td td10">
                                            <select name="choferIngresoJ" id="choferIngresoJ" class="clearBorder">
                                                <option value=" "> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario) 
                                                    @if($indices['jueves'] !== false)
                                                        @if($usuario->id == $resConSVKC[$indices['jueves']]->choferIngreso)
                                                            <option value="{{$usuario->id}}" selected="true"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @endif 
                                                    @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                    @endif
                                                @endforeach
                                            </select>    
                                        </td>
                                        <td class="td td11">
                                            <select name="guardaSalidaJ" id="guardaSalidaJ" class="clearBorder">
                                                <option value=" "> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario) 
                                                    @if($indices['jueves'] !== false)
                                                        @if($usuario->id == $resConSVKC[$indices['jueves']]->guardaSalida)
                                                            <option value="{{$usuario->id}}" selected="true"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @endif 
                                                    @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                    @endif
                                                @endforeach
                                            </select>    
                                        </td>
                                        <td class="td td12">
                                            <select name="guardaIngresoJ" id="guardaIngresoJ" class="clearBorder">
                                                <option value=" "> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario) 
                                                    @if($indices['jueves'] !== false)
                                                        @if($usuario->id == $resConSVKC[$indices['jueves']]->guardaIngreso)
                                                            <option value="{{$usuario->id}}" selected="true"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @endif 
                                                    @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                    @endif  
                                                @endforeach
                                            </select>    
                                        </td>   
                                    </tr> 
                                    <!--VIERNES -->
                                    <tr>
                                        <td class="td td1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="checkbox" id="checkV" {{$indices['viernes'] !== false ? 'checked':''}}/> 
                                                <div class="state p-success">
                                                    <label>VIERNES</label>
                                                </div>
                                            </div> 
                                        </td>
                                        <td class="td td2">
                                            @if($indices['viernes'] !== false)<input id="fechaSalidaV" type="text" readonly class="clearBorder form-control datepicker" name="fechaSalidaV" value="{{date('d/m/Y', strtotime($resConSVKC[$indices['viernes']]->fecha))}}"> 
                                                @else <input id="fechaSalidaV" type="text" readonly class="clearBorder form-control datepicker" name="fechaSalidaV">
                                            @endif
                                        </td>
                                        <td class="td td3">
                                            @if($indices['viernes'] !== false)<input id="horaSalidaV" type="text" class="clearBorder form-control timepicker" name="horaSalidaV" value="{{date('H:i', strtotime($resConSVKC[$indices['viernes']]->horaSalida))}}"> 
                                                @else<input id="horaSalidaV" type="text" class="clearBorder form-control timepicker" name="horaSalidaV">
                                            @endif
                                        </td>
                                        <td class="td td4">
                                            @if($indices['viernes'] !== false)<input id="horaIngresoV" type="text" class="clearBorder form-control timepicker" name="horaIngresoV" value="{{date('H:i', strtotime($resConSVKC[$indices['viernes']]->horaIngreso))}}"> 
                                                @else<input id="horaIngresoV" type="text" class="clearBorder form-control timepicker" name="horaIngresoV">
                                            @endif
                                        </td>
                                        <td class="td td5">
                                            @if($indices['viernes'] !== false)<input id="kmSalidaV"  type="number" class="clearBorder form-control conteo" name="kmSalidaV" value="{{$resConSVKC[$indices['viernes']]->kmSalida}}"> 
                                                @else<input id="kmSalidaV"  type="number" class="clearBorder form-control conteo" name="kmSalidaV">
                                            @endif
                                        </td>
                                        <td class="td td6">
                                            @if($indices['viernes'] !== false)<input id="kmIngresoV"  type="number" class="clearBorder form-control conteo" name="kmIngresoV" value="{{$resConSVKC[$indices['viernes']]->kmIngreso}}"> 
                                                @else<input id="kmIngresoV"  type="number" class="clearBorder form-control conteo" name="kmIngresoV">
                                            @endif
                                        </td>
                                        <td class="td td7">
                                            @if($indices['viernes'] !== false) <input id="combustibleSalidaV"  type="number" class="clearBorder form-control" name="combustibleSalidaV" value="{{$resConSVKC[$indices['viernes']]->combustibleSalida}}"> 
                                                @else <input id="combustibleSalidaV"  type="number" class="clearBorder form-control" name="combustibleSalidaV" >
                                            @endif
                                        </td>
                                        <td class="td td8">
                                            @if($indices['viernes'] !== false)<input id="combustibleIngresoV"  type="number" class="clearBorder form-control" name="combustibleIngresoV" value="{{$resConSVKC[$indices['viernes']]->combustibleIngreso}}"> 
                                                @else<input id="combustibleIngresoV"  type="number" class="clearBorder form-control" name="combustibleIngresoV" >
                                            @endif
                                        </td>
                                        <td class="td td9">
                                            <select name="choferSalidaV" id="choferSalidaV" class="clearBorder">
                                                <option value=" "> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario) 
                                                    @if($indices['viernes'] !== false)
                                                        @if($usuario->id == $resConSVKC[$indices['viernes']]->choferSalida)
                                                            <option value="{{$usuario->id}}" selected="true"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @endif 
                                                    @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                    @endif 
                                                @endforeach
                                            </select>    
                                        </td>
                                        <td class="td td10">
                                            <select name="choferIngresoV" id="choferIngresoV" class="clearBorder">
                                                <option value=" "> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario) 
                                                    @if($indices['viernes'] !== false)
                                                        @if($usuario->id == $resConSVKC[$indices['viernes']]->choferIngreso)
                                                            <option value="{{$usuario->id}}" selected="true"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @endif 
                                                    @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                    @endif
                                                @endforeach
                                            </select>    
                                        </td>
                                        <td class="td td11">
                                            <select name="guardaSalidaV" id="guardaSalidaV" class="clearBorder">
                                                <option value=" "> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario) 
                                                    @if($indices['viernes'] !== false)
                                                        @if($usuario->id == $resConSVKC[$indices['viernes']]->guardaSalida)
                                                            <option value="{{$usuario->id}}" selected="true"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @endif 
                                                    @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                    @endif 
                                                @endforeach
                                            </select>     
                                        </td>
                                        <td class="td td12">
                                            <select name="guardaIngresoV" id="guardaIngresoV" class="clearBorder">
                                                <option value=" "> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario) 
                                                    @if($indices['viernes'] !== false)
                                                        @if($usuario->id == $resConSVKC[$indices['viernes']]->guardaIngreso)
                                                            <option value="{{$usuario->id}}" selected="true"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @endif  
                                                    @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                    @endif
                                                @endforeach
                                            </select>   
                                        </td>  
                                    </tr> 
                                    <!--SABADO -->
                                    <tr>
                                        <td class="td td1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="checkbox" id="checkS" {{$indices['sabado'] !== false ? 'checked':''}}/> 
                                                <div class="state p-success">
                                                    <label>SÁBADO</label>
                                                </div>
                                            </div> 
                                        </td>
                                        <td class="td td2">
                                            @if($indices['sabado'] !== false)<input id="fechaSalidaS" type="text" readonly class="clearBorder form-control datepicker" name="fechaSalidaS" value="{{date('d/m/Y', strtotime($resConSVKC[$indices['sabado']]->fecha))}}"> 
                                                @else<input id="fechaSalidaS" type="text" readonly class="clearBorder form-control datepicker" name="fechaSalidaS">
                                            @endif
                                        </td>
                                        <td class="td td3">
                                            @if($indices['sabado'] !== false)<input id="horaSalidaS" type="text" class="clearBorder form-control timepicker" name="horaSalidaS" value="{{date('H:i', strtotime($resConSVKC[$indices['sabado']]->horaSalida))}}"> 
                                                @else<input id="horaSalidaS" type="text" class="clearBorder form-control timepicker" name="horaSalidaS">
                                            @endif
                                        </td>
                                        <td class="td td4">
                                            @if($indices['sabado'] !== false)<input id="horaIngresoS" type="text" class="clearBorder form-control timepicker" name="horaIngresoS" value="{{date('H:i', strtotime($resConSVKC[$indices['sabado']]->horaIngreso))}}"> 
                                                @else<input id="horaIngresoS" type="text" class="clearBorder form-control timepicker" name="horaIngresoS">
                                            @endif
                                        </td>
                                        <td class="td td5">
                                            @if($indices['sabado'] !== false)<input id="kmSalidaS"  type="number" class="clearBorder form-control conteo" name="kmSalidaS" value="{{$resConSVKC[$indices['sabado']]->kmSalida}}"> 
                                                @else<input id="kmSalidaS"  type="number" class="clearBorder form-control conteo" name="kmSalidaS">
                                            @endif
                                        </td>
                                        <td class="td td6">
                                            @if($indices['sabado'] !== false)<input id="kmIngresoS"  type="number" class="clearBorder form-control conteo" name="kmIngresoS" value="{{$resConSVKC[$indices['sabado']]->kmIngreso}}"> 
                                                @else<input id="kmIngresoS"  type="number" class="clearBorder form-control conteo" name="kmIngresoS" >
                                            @endif
                                        </td>
                                        <td class="td td7">
                                            @if($indices['sabado'] !== false)<input id="combustibleSalidaS"  type="number" class="clearBorder form-control" name="combustibleSalidaS" value="{{$resConSVKC[$indices['sabado']]->combustibleSalida}}"> 
                                                @else<input id="combustibleSalidaS"  type="number" class="clearBorder form-control" name="combustibleSalidaS">
                                            @endif
                                        </td>
                                        <td class="td td8">
                                            @if($indices['sabado'] !== false) <input id="combustibleIngresoS"  type="number" class="clearBorder form-control" name="combustibleIngresoS" value="{{$resConSVKC[$indices['sabado']]->combustibleIngreso}}"> 
                                                @else<input id="combustibleIngresoS"  type="number" class="clearBorder form-control" name="combustibleIngresoS">
                                            @endif
                                        </td>
                                        <td class="td td9">
                                            <select name="choferSalidaS" id="choferSalidaS" class="clearBorder">
                                                <option value=" "> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario) 
                                                    @if($indices['sabado'] !== false)
                                                        @if($usuario->id == $resConSVKC[$indices['sabado']]->choferSalida)
                                                            <option value="{{$usuario->id}}" selected="true"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @endif 
                                                    @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                    @endif 
                                                @endforeach
                                            </select>    
                                        </td>
                                        <td class="td td10">
                                            <select name="choferIngresoS" id="choferIngresoS" class="clearBorder">
                                                <option value=" "> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario) 
                                                    @if($indices['sabado'] !== false)
                                                        @if($usuario->id == $resConSVKC[$indices['sabado']]->choferIngreso)
                                                            <option value="{{$usuario->id}}" selected="true"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @endif 
                                                    @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                    @endif 
                                                @endforeach
                                            </select>        
                                        </td>
                                        <td class="td td11">
                                            <select name="guardaSalidaS" id="guardaSalidaS" class="clearBorder">
                                                <option value=" "> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario) 
                                                    @if($indices['sabado'] !== false)
                                                        @if($usuario->id == $resConSVKC[$indices['sabado']]->guardaSalida)
                                                            <option value="{{$usuario->id}}" selected="true"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @endif 
                                                    @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                    @endif 
                                                @endforeach
                                            </select>      
                                        </td>
                                        <td class="td td12">
                                            <select name="guardaIngresoS" id="guardaIngresoS" class="clearBorder">
                                                <option value=" "> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario) 
                                                    @if($indices['sabado'] !== false)
                                                        @if($usuario->id == $resConSVKC[$indices['sabado']]->guardaIngreso)
                                                            <option value="{{$usuario->id}}" selected="true"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @endif 
                                                    @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                    @endif 
                                                @endforeach
                                            </select>      
                                        </td>    
                                    </tr> 
                                    <!--DOMINGO-->
                                    <tr>
                                        <td class="td td1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="checkbox" id="checkD" {{$indices['domingo'] !== false ? 'checked':''}}/> 
                                                <div class="state p-success">
                                                    <label>DOMINGO</label>
                                                </div>
                                            </div> 
                                        </td> 
                                        <td class="td td2">
                                            @if($indices['domingo'] !== false)<input id="fechaSalidaD" type="text" readonly class="clearBorder form-control datepicker" name="fechaSalidaD" value="{{date('d/m/Y', strtotime($resConSVKC[$indices['domingo']]->fecha))}}"> 
                                                @else<input id="fechaSalidaD" type="text" readonly class="clearBorder form-control datepicker" name="fechaSalidaD">
                                            @endif
                                        </td>
                                        <td class="td td3">
                                            @if($indices['domingo'] !== false)<input id="horaSalidaD" type="text" class="clearBorder form-control timepicker" name="horaSalidaD"  value="{{date('H:i', strtotime($resConSVKC[$indices['domingo']]->horaSalida))}}"> 
                                                @else<input id="horaSalidaD" type="text" class="clearBorder form-control timepicker" name="horaSalidaD">
                                            @endif
                                        </td>
                                        <td class="td td4">
                                            @if($indices['domingo'] !== false) <input id="horaIngresoD" type="text" class="clearBorder form-control timepicker" name="horaIngresoD" value="{{date('H:i', strtotime($resConSVKC[$indices['domingo']]->horaIngreso))}}"> 
                                                @else<input id="horaIngresoD" type="text" class="clearBorder form-control timepicker" name="horaIngresoD">
                                            @endif
                                        </td>
                                        <td class="td td5">
                                            @if($indices['domingo'] !== false)<input id="kmSalidaD"  type="number" class="clearBorder form-control conteo" name="kmSalidaD" value="{{$resConSVKC[$indices['domingo']]->kmSalida}}"> 
                                                @else<input id="kmSalidaD"  type="number" class="clearBorder form-control conteo" name="kmSalidaD">
                                            @endif
                                        </td>
                                        <td class="td td6">
                                            @if($indices['domingo'] !== false)<input id="kmIngresoD"  type="number" class="clearBorder form-control conteo" name="kmIngresoD" value="{{$resConSVKC[$indices['domingo']]->kmIngreso}}"> 
                                                @else<input id="kmIngresoD"  type="number" class="clearBorder form-control conteo" name="kmIngresoD" >
                                            @endif
                                        </td>
                                        <td class="td td7">
                                            @if($indices['domingo'] !== false)<input id="combustibleSalidaD"  type="number" class="clearBorder form-control" name="combustibleSalidaD" value="{{$resConSVKC[$indices['domingo']]->combustibleSalida}}"> 
                                                @else<input id="combustibleSalidaD"  type="number" class="clearBorder form-control" name="combustibleSalidaD">
                                            @endif
                                        </td>
                                        <td class="td td8">
                                            @if($indices['domingo'] !== false)<input id="combustibleIngresoD"  type="number" class="clearBorder form-control" name="combustibleIngresoD" value="{{$resConSVKC[$indices['domingo']]->combustibleIngreso}}"> 
                                                @else<input id="combustibleIngresoD"  type="number" class="clearBorder form-control" name="combustibleIngresoD">
                                            @endif
                                        </td>
                                        <td class="td td9">
                                            <select name="choferSalidaD" id="choferSalidaD" class="clearBorder">
                                                <option value=" "> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario) 
                                                    @if($indices['domingo'] !== false)
                                                        @if($usuario->id == $resConSVKC[$indices['domingo']]->choferSalida)
                                                            <option value="{{$usuario->id}}" selected="true"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @endif 
                                                    @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                    @endif 
                                                @endforeach
                                            </select>       
                                        </td>
                                        <td class="td td10">
                                            <select name="choferIngresoD" id="choferIngresoD" class="clearBorder">
                                                <option value=" "> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario) 
                                                    @if($indices['domingo'] !== false)
                                                        @if($usuario->id == $resConSVKC[$indices['domingo']]->choferIngreso)
                                                            <option value="{{$usuario->id}}" selected="true"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @endif 
                                                    @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                    @endif 
                                                @endforeach
                                            </select>       
                                        </td>
                                        <td class="td td11">
                                            <select name="guardaSalidaD" id="guardaSalidaD" class="clearBorder">
                                                <option value=" "> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario) 
                                                    @if($indices['domingo'] !== false)
                                                        @if($usuario->id == $resConSVKC[$indices['domingo']]->guardaSalida)
                                                            <option value="{{$usuario->id}}" selected="true"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @endif 
                                                    @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                    @endif 
                                                @endforeach
                                            </select>    
                                        </td>
                                        <td class="td td12">
                                            <select name="guardaIngresoD" id="guardaIngresoD" class="clearBorder">
                                                <option value=" "> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario) 
                                                    @if($indices['domingo'] !== false)
                                                        @if($usuario->id == $resConSVKC[$indices['domingo']]->guardaIngreso)
                                                            <option value="{{$usuario->id}}" selected="true"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                        @endif 
                                                    @else <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                    @endif
                                                @endforeach
                                            </select>    
                                        </td>  
                                    </tr> 
                                    <!--TOTAL-->
                                    <tr class="trT">
                                        <td colspan="4"></td> 
                                        <td class="td" colspan="2">
                                            <label class="col-form-label text-md-right">Total de Kilometros recorridos</label>                                  
                                            <input id="totalKm" type="number" class="form-control clearBorder" name="totalKm" value="{{$salVehiCarrPrinc->totalKm}}" readonly>
                                        </td>
                                        <td colspan="6"></td>  
                                    </tr> 
                                </tbody>
                            </table>  
                        </div>
                        <div class="form-horizontal controlCA">  
                            <div class="row">  
                                <div class="col-lg-3" >
                                    <br>
                                    <div class="text-center">
                                        <h4 class="titulo">CONTROL DE ACCESORIOS SALIDA VEHÍCULO</h4>   
                                    </div> 
                                    <br>  
                                    <div class="form-group row">
                                        <label class="col-md-4 text-md-right subtitulo">RADIO</label><br>
                                        <div class="col-md-6"> 
                                        <div class="pretty p-icon p-curve p-tada">
                                            <input type="radio" name="radio" value="si" {{$salVeAcce->radio == 'si'? 'checked':''}}>
                                            <div class="state p-success-o">
                                                <i class="icon mdi mdi-check"></i>
                                                <label>SI</label>
                                            </div>
                                        </div>
                                        <div class="pretty p-icon p-curve p-tada">
                                            <input type="radio" name="radio" value="no" {{$salVeAcce->radio == 'no'? 'checked':''}}>
                                            <div class="state p-danger-o">
                                                <i class="icon mdi mdi-close"></i>
                                                <label>NO</label>
                                            </div>
                                        </div>
                                        </div>     
                                    </div> 
                                    <div class="form-group row">
                                        <label  class="col-md-4 text-md-right subtitulo">ENCENDEDOR</label><br>
                                        <div class="col-md-6"> 
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="encendedor" value="si" {{$salVeAcce->encenderdor == 'si'? 'checked':''}}>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="encendedor" value="no" {{$salVeAcce->encenderdor == 'no'? 'checked':''}}>
                                                <div class="state p-danger-o">
                                                    <i class="icon mdi mdi-close"></i>
                                                    <label>NO</label>
                                                </div>
                                            </div>
                                        </div>     
                                    </div>  
                                    <div class="form-group row">
                                        <label  class="col-md-4 text-md-right subtitulo">ALFOMBRAS</label><br>
                                        <div class="col-md-6"> 
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="alfombras" value="si" {{$salVeAcce->alfombra == 'si'? 'checked':''}}>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="alfombras" value="no" {{$salVeAcce->alfombra == 'no'? 'checked':''}}>
                                                <div class="state p-danger-o">
                                                    <i class="icon mdi mdi-close"></i>
                                                    <label>NO</label>
                                                </div>
                                            </div>
                                        </div>     
                                    </div>   
                                    <div class="form-group row">
                                        <label  class="col-md-4 text-md-right subtitulo">ANTENA</label><br>
                                        <div class="col-md-6"> 
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="antena" value="si" {{$salVeAcce->antena == 'si'? 'checked':''}}>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="antena" value="no" {{$salVeAcce->antena == 'no'? 'checked':''}}>
                                                <div class="state p-danger-o">
                                                    <i class="icon mdi mdi-close"></i>
                                                    <label>NO</label>
                                                </div>
                                            </div>
                                        </div>     
                                    </div>    
                                    <div class="form-group row">
                                        <label  class="col-md-4 text-md-right subtitulo">ESPEJO EXTERIOR</label><br>
                                        <div class="col-md-6"> 
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="espejoExt" value="si" {{$salVeAcce->espejoExterior == 'si'? 'checked':''}}>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="espejoExt" value="no" {{$salVeAcce->espejoExterior == 'no'? 'checked':''}}>
                                                <div class="state p-danger-o">
                                                    <i class="icon mdi mdi-close"></i>
                                                    <label>NO</label>
                                                </div>
                                            </div>
                                        </div>     
                                    </div>   
                                    <div class="form-group row">
                                        <label  class="col-md-4 text-md-right subtitulo">ESPEJO INTERIOR</label><br>
                                        <div class="col-md-6"> 
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="espejoInt" value="si" {{$salVeAcce->espejoInterior == 'si'? 'checked':''}}>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="espejoInt" value="no" {{$salVeAcce->espejoInterior == 'no'? 'checked':''}}>
                                                <div class="state p-danger-o">
                                                    <i class="icon mdi mdi-close"></i>
                                                    <label>NO</label>
                                                </div>
                                            </div>
                                        </div>     
                                    </div>   
                                    <div class="form-group row">
                                        <label  class="col-md-4 text-md-right subtitulo">EXTINTOR</label><br>
                                        <div class="col-md-6"> 
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="extintor" value="si" {{$salVeAcce->extintor == 'si'? 'checked':''}}>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="extintor" value="no" {{$salVeAcce->extintor == 'no'? 'checked':''}}>
                                                <div class="state p-danger-o">
                                                    <i class="icon mdi mdi-close"></i>
                                                    <label>NO</label>
                                                </div>
                                            </div>
                                        </div>     
                                    </div>  
                                    <div class="form-group row">
                                        <label  class="col-md-4 text-md-right subtitulo">GATA</label><br>
                                        <div class="col-md-6"> 
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="gata" value="si" {{$salVeAcce->gata == 'si'? 'checked':''}}>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="gata" value="no" {{$salVeAcce->gata == 'no'? 'checked':''}}>
                                                <div class="state p-danger-o">
                                                    <i class="icon mdi mdi-close"></i>
                                                    <label>NO</label>
                                                </div>
                                            </div>
                                        </div>     
                                    </div>
                                    <div class="form-group row">
                                        <label  class="col-md-4 text-md-right subtitulo">LLAVE RANA</label><br>
                                        <div class="col-md-6"> 
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="llaveRana" value="si" {{$salVeAcce->llaveRana == 'si'? 'checked':''}}>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="llaveRana" value="no" {{$salVeAcce->llaveRana == 'no'? 'checked':''}}>
                                                <div class="state p-danger-o">
                                                    <i class="icon mdi mdi-close"></i>
                                                    <label>NO</label>
                                                </div>
                                            </div>
                                        </div>     
                                    </div>
                                    <div class="form-group row">
                                        <label  class="col-md-4 text-md-right subtitulo">LLAVE REPUESTO</label><br>
                                        <div class="col-md-6"> 
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="llaveRepuesto" value="si" {{$salVeAcce->llaveRepuesto == 'si'? 'checked':''}}>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="llaveRepuesto" value="no" {{$salVeAcce->llaveRepuesto == 'no'? 'checked':''}}>
                                                <div class="state p-danger-o">
                                                    <i class="icon mdi mdi-close"></i>
                                                    <label>NO</label>
                                                </div>
                                            </div>
                                        </div>     
                                    </div> 
                                    <div class="form-group row">
                                        <label  class="col-md-4 text-md-right subtitulo">TRIANGULOS</label><br>
                                        <div class="col-md-6"> 
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="triangulos" value="si" {{$salVeAcce->triangulos == 'si'? 'checked':''}}>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="triangulos" value="no" {{$salVeAcce->triangulos == 'no'? 'checked':''}}>
                                                <div class="state p-danger-o">
                                                    <i class="icon mdi mdi-close"></i>
                                                    <label>NO</label>
                                                </div>
                                            </div>
                                        </div>     
                                    </div> 
                                    <div class="form-group row">  
                                        <div class="col-md-1"></div> 
                                        <div class="col-md-6"> 
                                            <label  class="text-md-right subtitulo">OBSERVACIONES</label>
                                            <textarea id="observacionesS" rows="6" cols="40" name="descripcion">{{$salVeAcce->observacionesCA}}</textarea>
                                        </div>     
                                    </div>  
                                </div>
                                <div class="col-lg-6 controlCarroceria">
                                    <br> 
                                    <div class="form-group row"> 
                                        <div class="col-md-7">
                                            <h4 class="titulo text-center">CONTROL DE CARROCERÍA VEHÍCULO</h4>  
                                            <h5 class="subtitulo text-center">Señalamiento de daños exteriores de carrocería</h5>
                                            <img src="/images/vehiculo_inspeccion.jpg" alt="Muni" >
                                            <div class="form-group row">
                                                <label  class="col-md-6 text-md-right subtitulo">PUERTA DELANTERA DERECHA</label><br>
                                                <div class="col-md-6"> 
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="puertaDD" value="si" {{$salVehiCarrPrinc->puertaDD == 'si'? 'checked':''}}>
                                                        <div class="state p-success-o">
                                                            <i class="icon mdi mdi-check"></i>
                                                            <label>SI</label>
                                                        </div>
                                                    </div>
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="puertaDD" value="no" {{$salVehiCarrPrinc->puertaDD == 'no'? 'checked':''}}>
                                                        <div class="state p-danger-o">
                                                            <i class="icon mdi mdi-close"></i>
                                                            <label>NO</label>
                                                        </div>
                                                    </div>
                                                </div>     
                                            </div> 
                                            <div class="form-group row">
                                                <label  class="col-md-6 text-md-right subtitulo">PUERTA DELANTERA IZQUIERDA</label><br>
                                                <div class="col-md-6"> 
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="puertaDI" value="si" {{$salVehiCarrPrinc->puertaDI == 'si'? 'checked':''}}>
                                                        <div class="state p-success-o">
                                                            <i class="icon mdi mdi-check"></i>
                                                            <label>SI</label>
                                                        </div>
                                                    </div>
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="puertaDI" value="no" {{$salVehiCarrPrinc->puertaDI == 'no'? 'checked':''}}>
                                                        <div class="state p-danger-o">
                                                            <i class="icon mdi mdi-close"></i>
                                                            <label>NO</label>
                                                        </div>
                                                    </div>
                                                </div>     
                                            </div>  
                                            <div class="form-group row">
                                                <label  class="col-md-6 text-md-right subtitulo">PUERTA TRASERA DERECHA</label><br>
                                                <div class="col-md-6"> 
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="puertaTD" value="si" {{$salVehiCarrPrinc->puertaTD == 'si'? 'checked':''}}>
                                                        <div class="state p-success-o">
                                                            <i class="icon mdi mdi-check"></i>
                                                            <label>SI</label>
                                                        </div>
                                                    </div>
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="puertaTD" value="no" {{$salVehiCarrPrinc->puertaTD == 'no'? 'checked':''}}>
                                                        <div class="state p-danger-o">
                                                            <i class="icon mdi mdi-close"></i>
                                                            <label>NO</label>
                                                        </div>
                                                    </div>
                                                </div>     
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6"> 
                                                    <label  class="text-md-right subtitulo">OBSERVACIONES</label><br>
                                                    <textarea id="observacionesCarro" rows="3" cols="70"name="descripcion">{{$salVehiCarrPrinc->observaciones}}</textarea>
                                                </div>     
                                            </div> 
                                        </div>
                                        <div class="col-md-5" >
                                            <div class="form-group row">
                                                <label  class="col-md-6 text-md-right subtitulo">BUMPER TRASERO</label><br>
                                                <div class="col-md-6"> 
                                                <div class="pretty p-icon p-curve p-tada">
                                                    <input type="radio" name="bumperT" value="si" {{$salVehiCarrPrinc->bumperTrasero == 'si'? 'checked':''}}>
                                                    <div class="state p-success-o">
                                                        <i class="icon mdi mdi-check"></i>
                                                        <label>SI</label>
                                                    </div>
                                                </div>
                                                <div class="pretty p-icon p-curve p-tada">
                                                    <input type="radio" name="bumperT" value="no" {{$salVehiCarrPrinc->bumperTrasero == 'no'? 'checked':''}}>
                                                    <div class="state p-danger-o">
                                                        <i class="icon mdi mdi-close"></i>
                                                        <label>NO</label>
                                                    </div>
                                                </div>
                                                </div>     
                                            </div> 
                                            <div class="form-group row">
                                                <label  class="col-md-6 text-md-right subtitulo">BUMPER DELANTERO</label><br>
                                                <div class="col-md-6"> 
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="bumperD" value="si" {{$salVehiCarrPrinc->bumperDelantero == 'si'? 'checked':''}}>
                                                        <div class="state p-success-o">
                                                            <i class="icon mdi mdi-check"></i>
                                                            <label>SI</label>
                                                        </div>
                                                    </div>
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="bumperD" value="no" {{$salVehiCarrPrinc->bumperDelantero == 'no'? 'checked':''}}>
                                                        <div class="state p-danger-o">
                                                            <i class="icon mdi mdi-close"></i>
                                                            <label>NO</label>
                                                        </div>
                                                    </div>
                                                </div>     
                                            </div>  
                                            <div class="form-group row">
                                                <label  class="col-md-6 text-md-right subtitulo">GUARDA BARRO DERECHO TRASERO</label><br>
                                                <div class="col-md-6"> 
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="guardaBDT" value="si" {{$salVehiCarrPrinc->guardaBarroTD == 'si'? 'checked':''}}>
                                                        <div class="state p-success-o">
                                                            <i class="icon mdi mdi-check"></i>
                                                            <label>SI</label>
                                                        </div>
                                                    </div>
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="guardaBDT" value="no" {{$salVehiCarrPrinc->guardaBarroTD == 'no'? 'checked':''}}>
                                                        <div class="state p-danger-o">
                                                            <i class="icon mdi mdi-close"></i>
                                                            <label>NO</label>
                                                        </div>
                                                    </div>
                                                </div>     
                                            </div>   
                                            <div class="form-group row">
                                                <label  class="col-md-6 text-md-right subtitulo">GUARDA BARRO IZQUIERDO TRASERO</label><br>
                                                <div class="col-md-6"> 
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="guardaBIT" value="si" {{$salVehiCarrPrinc->guardaBarroTI == 'si'? 'checked':''}}>
                                                        <div class="state p-success-o">
                                                            <i class="icon mdi mdi-check"></i>
                                                            <label>SI</label>
                                                        </div>
                                                    </div>
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="guardaBIT" value="no" {{$salVehiCarrPrinc->guardaBarroTI == 'no'? 'checked':''}}>
                                                        <div class="state p-danger-o">
                                                            <i class="icon mdi mdi-close"></i>
                                                            <label>NO</label>
                                                        </div>
                                                    </div>
                                                </div>     
                                            </div>    
                                            <div class="form-group row">
                                                <label  class="col-md-6 text-md-right subtitulo">GUARDA BARRO IZQUIERDO DELANTERO</label><br>
                                                <div class="col-md-6"> 
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="guardaBID" value="si" {{$salVehiCarrPrinc->guardaBarroDI == 'si'? 'checked':''}}>
                                                        <div class="state p-success-o">
                                                            <i class="icon mdi mdi-check"></i>
                                                            <label>SI</label>
                                                        </div>
                                                    </div>
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="guardaBID" value="no" {{$salVehiCarrPrinc->guardaBarroDI == 'no'? 'checked':''}}>
                                                        <div class="state p-danger-o">
                                                            <i class="icon mdi mdi-close"></i>
                                                            <label>NO</label>
                                                        </div>
                                                    </div>
                                                </div>     
                                            </div>   
                                            <div class="form-group row">
                                                <label  class="col-md-6 text-md-right subtitulo">GUARDA BARRO DERECHO DELANTERO</label><br>
                                                <div class="col-md-6"> 
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="guardaBDD" value="si" {{$salVehiCarrPrinc->guardaBarroDD == 'si'? 'checked':''}}>
                                                        <div class="state p-success-o">
                                                            <i class="icon mdi mdi-check"></i>
                                                            <label>SI</label>
                                                        </div>
                                                    </div>
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="guardaBDD" value="no" {{$salVehiCarrPrinc->guardaBarroDD == 'no'? 'checked':''}}>
                                                        <div class="state p-danger-o">
                                                            <i class="icon mdi mdi-close"></i>
                                                            <label>NO</label>
                                                        </div>
                                                    </div>
                                                </div>     
                                            </div> 
                                            <div class="form-group row">
                                                <label  class="col-md-6 text-md-right subtitulo">TAPA DEL BAUL</label><br>
                                                <div class="col-md-6"> 
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="tapaBaul" value="si" {{$salVehiCarrPrinc->tapaBaul == 'si'? 'checked':''}}>
                                                        <div class="state p-success-o">
                                                            <i class="icon mdi mdi-check"></i>
                                                            <label>SI</label>
                                                        </div>
                                                    </div>
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="tapaBaul" value="no" {{$salVehiCarrPrinc->tapaBaul == 'no'? 'checked':''}}>
                                                        <div class="state p-danger-o">
                                                            <i class="icon mdi mdi-close"></i>
                                                            <label>NO</label>
                                                        </div>
                                                    </div>
                                                </div>     
                                            </div>  
                                            <div class="form-group row">
                                                <label  class="col-md-6 text-md-right subtitulo">TAPA DEL MOTOR</label><br>
                                                <div class="col-md-6"> 
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="tapaMotor" value="si" {{$salVehiCarrPrinc->tapaMotor == 'si'? 'checked':''}}>
                                                        <div class="state p-success-o">
                                                            <i class="icon mdi mdi-check"></i>
                                                            <label>SI</label>
                                                        </div>
                                                    </div>
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="tapaMotor" value="no" {{$salVehiCarrPrinc->tapaMotor == 'no'? 'checked':''}}>
                                                        <div class="state p-danger-o">
                                                            <i class="icon mdi mdi-close"></i>
                                                            <label>NO</label>
                                                        </div>
                                                    </div>
                                                </div>     
                                            </div>   
                                            <div class="form-group row">
                                                <label  class="col-md-6 text-md-right subtitulo">PARABRISAS TRASERO</label><br>
                                                <div class="col-md-6"> 
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="parabrisasT" value="si" {{$salVehiCarrPrinc->parabrisasTrasero == 'si'? 'checked':''}}>
                                                        <div class="state p-success-o">
                                                            <i class="icon mdi mdi-check"></i>
                                                            <label>SI</label>
                                                        </div>
                                                    </div>
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="parabrisasT" value="no" {{$salVehiCarrPrinc->parabrisasTrasero == 'no'? 'checked':''}}>
                                                        <div class="state p-danger-o">
                                                            <i class="icon mdi mdi-close"></i>
                                                            <label>NO</label>
                                                        </div>
                                                    </div>
                                                </div>     
                                            </div>
                                            <div class="form-group row">
                                                <label  class="col-md-6 text-md-right subtitulo">PARABRISAS DELANTERO</label><br>
                                                <div class="col-md-6"> 
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="parabrisasD" value="si" {{$salVehiCarrPrinc->parabrisasDelantero == 'si'? 'checked':''}}>
                                                        <div class="state p-success-o">
                                                            <i class="icon mdi mdi-check"></i>
                                                            <label>SI</label>
                                                        </div>
                                                    </div>
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="parabrisasD" value="no" {{$salVehiCarrPrinc->parabrisasDelantero == 'no'? 'checked':''}}>
                                                        <div class="state p-danger-o">
                                                            <i class="icon mdi mdi-close"></i>
                                                            <label>NO</label>
                                                        </div>
                                                    </div>
                                                </div>     
                                            </div>  
                                            <div class="form-group row">
                                                <label  class="col-md-6 text-md-right subtitulo">PUERTA TRASERA IZQUIERDA</label><br>
                                                <div class="col-md-6"> 
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="puertaTI" value="si" {{$salVehiCarrPrinc->puertaTI == 'si'? 'checked':''}}>
                                                        <div class="state p-success-o">
                                                            <i class="icon mdi mdi-check"></i>
                                                            <label>SI</label>
                                                        </div>
                                                    </div>
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="puertaTI" value="no" {{$salVehiCarrPrinc->puertaTI == 'no'? 'checked':''}}>
                                                        <div class="state p-danger-o">
                                                            <i class="icon mdi mdi-close"></i>
                                                            <label>NO</label>
                                                        </div>
                                                    </div>
                                                </div>     
                                            </div> 
                                            <div class="form-group row">
                                                <label  class="col-md-6 text-md-right subtitulo">QUICIO DERECHO</label><br>
                                                <div class="col-md-6"> 
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="quicioD" value="si" {{$salVehiCarrPrinc->quisioD == 'si'? 'checked':''}}>
                                                        <div class="state p-success-o">
                                                            <i class="icon mdi mdi-check"></i>
                                                            <label>SI</label>
                                                        </div>
                                                    </div>
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="quicioD" value="no" {{$salVehiCarrPrinc->quisioD == 'no'? 'checked':''}}>
                                                        <div class="state p-danger-o">
                                                            <i class="icon mdi mdi-close"></i>
                                                            <label>NO</label>
                                                        </div>
                                                    </div>
                                                </div>     
                                            </div> 
                                            <div class="form-group row">
                                                <label  class="col-md-6 text-md-right subtitulo">QUICIO IZQUIERDO</label><br>
                                                <div class="col-md-6"> 
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="quicioI" value="si" {{$salVehiCarrPrinc->quisioI == 'si'? 'checked':''}}>
                                                        <div class="state p-success-o">
                                                            <i class="icon mdi mdi-check"></i>
                                                            <label>SI</label>
                                                        </div>
                                                    </div>
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="quicioI" value="no" {{$salVehiCarrPrinc->quisioI == 'no'? 'checked':''}}>
                                                        <div class="state p-danger-o">
                                                            <i class="icon mdi mdi-close"></i>
                                                            <label>NO</label>
                                                        </div>
                                                    </div>
                                                </div>     
                                            </div>  
                                            <div class="form-group row">
                                                <label  class="col-md-6 text-md-right subtitulo">TECHO</label><br>
                                                <div class="col-md-6"> 
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="techo" value="si" {{$salVehiCarrPrinc->techo == 'si'? 'checked':''}}>
                                                        <div class="state p-success-o">
                                                            <i class="icon mdi mdi-check"></i>
                                                            <label>SI</label>
                                                        </div>
                                                    </div>
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="techo" value="no" {{$salVehiCarrPrinc->techo == 'no'? 'checked':''}}>
                                                        <div class="state p-danger-o">
                                                            <i class="icon mdi mdi-close"></i>
                                                            <label>NO</label>
                                                        </div>
                                                    </div>
                                                </div>     
                                            </div> 
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-lg-3">
                                    <br>
                                    <div class="text-center">
                                        <h4 class="titulo">CONTROL DE ACCESORIOS ENTRADA VEHÍCULO</h4>   
                                    </div>
                                    <br>
                                    <div class="form-group row">
                                        <label  class="col-md-4 text-md-right subtitulo">RADIO</label><br>
                                        <div class="col-md-6"> 
                                        <div class="pretty p-icon p-curve p-tada">
                                            <input type="radio" name="radioE" value="si" {{$entVeAcce->radio == 'si'? 'checked':''}}>
                                            <div class="state p-success-o">
                                                <i class="icon mdi mdi-check"></i>
                                                <label>SI</label>
                                            </div>
                                        </div>
                                        <div class="pretty p-icon p-curve p-tada">
                                            <input type="radio" name="radioE" value="no" {{$entVeAcce->radio == 'no'? 'checked':''}}>
                                            <div class="state p-danger-o">
                                                <i class="icon mdi mdi-close"></i>
                                                <label>NO</label>
                                            </div>
                                        </div>
                                        </div>     
                                    </div> 
                                    <div class="form-group row">
                                        <label  class="col-md-4 text-md-right subtitulo">ENCENDEDOR</label><br>
                                        <div class="col-md-6"> 
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="encendedorE" value="si" {{$entVeAcce->encenderdor == 'si'? 'checked':''}}>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="encendedorE" value="no" {{$entVeAcce->encenderdor == 'no'? 'checked':''}}>
                                                <div class="state p-danger-o">
                                                    <i class="icon mdi mdi-close"></i>
                                                    <label>NO</label>
                                                </div>
                                            </div>
                                        </div>     
                                    </div>  
                                    <div class="form-group row">
                                        <label  class="col-md-4 text-md-right subtitulo">ALFOMBRAS</label><br>
                                        <div class="col-md-6"> 
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="alfombrasE" value="si" {{$entVeAcce->triangulos == 'si'? 'checked':''}}>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="alfombrasE" value="no" {{$entVeAcce->triangulos == 'no'? 'checked':''}}>
                                                <div class="state p-danger-o">
                                                    <i class="icon mdi mdi-close"></i>
                                                    <label>NO</label>
                                                </div>
                                            </div>
                                        </div>     
                                    </div>   
                                    <div class="form-group row">
                                        <label  class="col-md-4 text-md-right subtitulo">ANTENA</label><br>
                                        <div class="col-md-6"> 
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="antenaE" value="si" {{$entVeAcce->antena == 'si'? 'checked':''}}>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="antenaE" value="no" {{$entVeAcce->antena == 'no'? 'checked':''}}>
                                                <div class="state p-danger-o">
                                                    <i class="icon mdi mdi-close"></i>
                                                    <label>NO</label>
                                                </div>
                                            </div>
                                        </div>     
                                    </div>    
                                    <div class="form-group row">
                                        <label  class="col-md-4 text-md-right subtitulo">ESPEJO EXTERIOR</label><br>
                                        <div class="col-md-6"> 
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="espejoExtE" value="si" {{$entVeAcce->espejoExterior == 'si'? 'checked':''}}>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="espejoExtE" value="no" {{$entVeAcce->espejoExterior == 'no'? 'checked':''}}>
                                                <div class="state p-danger-o">
                                                    <i class="icon mdi mdi-close"></i>
                                                    <label>NO</label>
                                                </div>
                                            </div>
                                        </div>     
                                    </div>   
                                    <div class="form-group row">
                                        <label  class="col-md-4 text-md-right subtitulo">ESPEJO INTERIOR</label><br>
                                        <div class="col-md-6"> 
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="espejoIntE" value="si" {{$entVeAcce->espejoInterior == 'si'? 'checked':''}}>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="espejoIntE" value="no" {{$entVeAcce->espejoInterior == 'no'? 'checked':''}}>
                                                <div class="state p-danger-o">
                                                    <i class="icon mdi mdi-close"></i>
                                                    <label>NO</label>
                                                </div>
                                            </div>
                                        </div>     
                                    </div>   
                                    <div class="form-group row">
                                        <label  class="col-md-4 text-md-right subtitulo">EXTINTOR</label><br>
                                        <div class="col-md-6"> 
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="extintorE" value="si" {{$entVeAcce->extintor == 'si'? 'checked':''}}>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="extintorE" value="no" {{$entVeAcce->extintor == 'no'? 'checked':''}}>
                                                <div class="state p-danger-o">
                                                    <i class="icon mdi mdi-close"></i>
                                                    <label>NO</label>
                                                </div>
                                            </div>
                                        </div>     
                                    </div>  
                                    <div class="form-group row">
                                        <label  class="col-md-4 text-md-right subtitulo">GATA</label><br>
                                        <div class="col-md-6"> 
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="gataE" value="si" {{$entVeAcce->gata == 'si'? 'checked':''}}>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="gataE" value="no" {{$entVeAcce->gata == 'no'? 'checked':''}}>
                                                <div class="state p-danger-o">
                                                    <i class="icon mdi mdi-close"></i>
                                                    <label>NO</label>
                                                </div>
                                            </div>
                                        </div>     
                                    </div>
                                    <div class="form-group row">
                                        <label  class="col-md-4 text-md-right subtitulo">LLAVE RANA</label><br>
                                        <div class="col-md-6"> 
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="llaveRanaE" value="si" {{$entVeAcce->llaveRana == 'si'? 'checked':''}}>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="llaveRanaE" value="no" {{$entVeAcce->llaveRana == 'no'? 'checked':''}}>
                                                <div class="state p-danger-o">
                                                    <i class="icon mdi mdi-close"></i>
                                                    <label>NO</label>
                                                </div>
                                            </div>
                                        </div>     
                                    </div>
                                    <div class="form-group row">
                                        <label  class="col-md-4 text-md-right subtitulo">LLAVE REPUESTO</label><br>
                                        <div class="col-md-6"> 
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="llaveRepuestoE" value="si" {{$entVeAcce->llaveRepuesto == 'si'? 'checked':''}}>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="llaveRepuestoE" value="no" {{$entVeAcce->llaveRepuesto == 'no'? 'checked':''}}>
                                                <div class="state p-danger-o">
                                                    <i class="icon mdi mdi-close"></i>
                                                    <label>NO</label>
                                                </div>
                                            </div>
                                        </div>     
                                    </div> 
                                    <div class="form-group row">
                                        <label  class="col-md-4 text-md-right subtitulo">TRIANGULOS</label><br>
                                        <div class="col-md-6"> 
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="triangulosE" value="si" {{$entVeAcce->triangulos == 'si'? 'checked':''}}>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="triangulosE" value="no" {{$entVeAcce->triangulos == 'no'? 'checked':''}}>
                                                <div class="state p-danger-o">
                                                    <i class="icon mdi mdi-close"></i>
                                                    <label>NO</label>
                                                </div>
                                            </div>
                                        </div>     
                                    </div>  
                                    <div class="form-group row">
                                        <div class="col-md-1"></div> 
                                        <div class="col-md-6"> 
                                            <label  class="text-md-right subtitulo">OBSERVACIONES</label><br>
                                            <textarea id="observacionesE" rows="6" cols="40" name="descripcion">{{$entVeAcce->observacionesCA}}</textarea>
                                        </div>     
                                    </div> 
                                </div>
                            </div> 
                        </div> 
                        <div class="form-row botones">
                            <div class="col-md-12"> 
                                <div class="position-relative form-group">
                                    <button class="btn bg-malibu-beach btn-lg pull-left" onclick="window.location='{{ url('vistaInicial', $placa) }}'">
                                        <i class="fas fa-angle-double-left" >Regresar</i>
                                    </button>
                                    <button class="editar btn bg-happy-green btn-lg pull-right">
                                        <i class="fas fa-sync-alt" >Actualizar</i>  
                                    </button>    
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div> 
    </body>
</html>
<br>
@endsection  