$(document).ready(function() {  
    window.onload(kmRecorridos()); 
    agregar(); 
    checkClick(); 
    inicioTable();   
    setInterval(function(){ $("#tooltipCheck").fadeTo(500, .1).fadeTo(500, 1); } , 1000); 
    timePicker();
    datePicker();
    
});   
function dateFormat(fecha){
    var fechaConvertida = fecha.split("/").reverse().join("-");  
    return fechaConvertida
}
function agregar(){
    $(".agregar").click(function(){ 
        //datos tabla principal salida entrada
        {
            var oficinaSolicitante          = $('#oficinaSolicitante').val(); 
            var placa                       = $('#placa').val(); 
            var fechaAutorizacionSalida     = dateFormat($('#fechaAutorizacionSalida').val());
            var fechaAutorizacionIngreso    = dateFormat($('#fechaAutorizacionIngreso').val());
            var totalKm = $('#totalKm').val();  
        } 
        //datos tabla control kilometros combustibles
        var dias = { 'lunes': null, 'martes': null, 'miercoles': null, 'jueves': null, 'viernes': null, 'sabado': null, 'domingo': null};
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
            var accesSalid = {  'radioSalida'       : $('input:radio[name=radio]:checked').val(),
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
            var carroceria   = {'bumperT'           : $('input:radio[name=bumperT]:checked').val(),
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
            var accesEntrad = { 'radioEntrada'       : $('input:radio[name=radioE]:checked').val(),
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
                title: "¿Está seguro?",
                text:  "El Registro será Agregado al Sistema" ,
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
                        url: "/guardarSalidaVehicular", 
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
                                    title: "¡Registro Agregado!",
                                    type: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Aceptar',
                                }).then(function() {
                                    setTimeout("location.href='/vistaInicial/"+placa+"'", 100); 
                                });
                            }else{
                                mensajes(data);               
                            } 
                        }
                    });
                }else{
                    Swal.fire({
                        title:"¡Cancelado!", 
                        text: "Registro No Agregado",
                        type: "error",  
                        confirmButtonText: 'Aceptar',
                        timer: 2000,
                    });
                }
            });
        }
    });
}
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
//funcion para los kilometros recorridos y funcion resta entre kilometro entrada y salida
function kmRecorridos () {  
    {
        var inputkmSalidaL      = $('#kmSalidaL');   
        var inputkmIngresoL     = $("#kmIngresoL"); 

        var inputkmSalidaMA     = $("#kmSalidaMA");   
        var inputkmIngresoMA    = $("#kmIngresoMA");    

        var inputkmSalidaMI     = $("#kmSalidaMI");   
        var inputkmIngresoMI    = $("#kmIngresoMI");    

        var inputkmSalidaJ      = $("#kmSalidaJ");   
        var inputkmIngresoJ     = $("#kmIngresoJ");    

        var inputkmSalidaV      = $("#kmSalidaV");   
        var inputkmIngresoV     = $("#kmIngresoV");    

        var inputkmSalidaS      = $("#kmSalidaS");   
        var inputkmIngresoS     = $("#kmIngresoS");    

        var inputkmSalidaD      = $("#kmSalidaD");   
        var inputkmIngresoD     = $("#kmIngresoD");   
    }   
    (inputkmIngresoL).keyup(function() {     
        var resultado       = resta($(this).prop('value'), inputkmSalidaL.val());
        var martesRes       = resta(inputkmIngresoMA.val(),inputkmSalidaMA.val()); 
        var miercolesRes    = resta(inputkmIngresoMI.val(),inputkmSalidaMI.val());
        var juevesRes       = resta(inputkmIngresoJ.val(), inputkmSalidaJ.val());
        var viernesRes      = resta(inputkmIngresoV.val(), inputkmSalidaV.val());
        var sabadoRes       = resta(inputkmIngresoS.val(), inputkmSalidaS.val());
        var domingoRes      = resta(inputkmIngresoD.val(), inputkmSalidaD.val()); 
        var suma = martesRes + miercolesRes + juevesRes + viernesRes + sabadoRes + domingoRes + resultado; 
        document.getElementById("totalKm").value = suma;
    }); 
    (inputkmIngresoMA).keyup(function() {     
        var resultado       = resta($(this).prop('value'), inputkmSalidaMA.val()); 
        var lunesRes        = resta(inputkmIngresoL.val(), inputkmSalidaL.val());
        var miercolesRes    = resta(inputkmIngresoMI.val(),inputkmSalidaMI.val());
        var juevesRes       = resta(inputkmIngresoJ.val(), inputkmSalidaJ.val());
        var viernesRes      = resta(inputkmIngresoV.val(), inputkmSalidaV.val());
        var sabadoRes       = resta(inputkmIngresoS.val(), inputkmSalidaS.val());
        var domingoRes      = resta(inputkmIngresoD.val(), inputkmSalidaD.val());
        var suma = lunesRes + miercolesRes + juevesRes + viernesRes + sabadoRes + domingoRes + resultado;
        document.getElementById("totalKm").value = suma;
    }); 
    (inputkmIngresoMI).keyup(function() {     
        var resultado = resta($(this).prop('value'), inputkmSalidaMI.val());
        var lunesRes        = resta(inputkmIngresoL.val(), inputkmSalidaL.val());
        var martesRes       = resta(inputkmIngresoMA.val(),inputkmSalidaMA.val()); 
        var juevesRes       = resta(inputkmIngresoJ.val(), inputkmSalidaJ.val());
        var viernesRes      = resta(inputkmIngresoV.val(), inputkmSalidaV.val());
        var sabadoRes       = resta(inputkmIngresoS.val(), inputkmSalidaS.val());
        var domingoRes      = resta(inputkmIngresoD.val(), inputkmSalidaD.val());
        var suma = lunesRes + martesRes + juevesRes + viernesRes + sabadoRes + domingoRes + resultado;
        document.getElementById("totalKm").value = suma;
    }); 
    (inputkmIngresoJ).keyup(function() {     
        var resultado = resta($(this).prop('value'), inputkmSalidaJ.val());
        var lunesRes        = resta(inputkmIngresoL.val(), inputkmSalidaL.val());
        var martesRes       = resta(inputkmIngresoMA.val(),inputkmSalidaMA.val()); 
        var miercolesRes    = resta(inputkmIngresoMI.val(),inputkmSalidaMI.val());
        var viernesRes      = resta(inputkmIngresoV.val(), inputkmSalidaV.val());
        var sabadoRes       = resta(inputkmIngresoS.val(), inputkmSalidaS.val());
        var domingoRes      = resta(inputkmIngresoD.val(), inputkmSalidaD.val());
        var suma = lunesRes + martesRes + miercolesRes + viernesRes + sabadoRes + domingoRes + resultado;
        document.getElementById("totalKm").value = suma;
    }); 
    (inputkmIngresoV).keyup(function() {     
        var resultado = resta($(this).prop('value'), inputkmSalidaV.val());
        var lunesRes        = resta(inputkmIngresoL.val(), inputkmSalidaL.val());
        var martesRes       = resta(inputkmIngresoMA.val(),inputkmSalidaMA.val()); 
        var miercolesRes    = resta(inputkmIngresoMI.val(),inputkmSalidaMI.val());
        var juevesRes       = resta(inputkmIngresoJ.val(), inputkmSalidaJ.val());
        var sabadoRes       = resta(inputkmIngresoS.val(), inputkmSalidaS.val());
        var domingoRes      = resta(inputkmIngresoD.val(), inputkmSalidaD.val());
        var suma = lunesRes + martesRes + miercolesRes + juevesRes + sabadoRes + domingoRes + resultado;
        document.getElementById("totalKm").value = suma;
    }); 
    (inputkmIngresoS).keyup(function() {     
        var resultado = resta($(this).prop('value'), inputkmSalidaS.val());
        var lunesRes        = resta(inputkmIngresoL.val(), inputkmSalidaL.val());
        var martesRes       = resta(inputkmIngresoMA.val(),inputkmSalidaMA.val()); 
        var miercolesRes    = resta(inputkmIngresoMI.val(),inputkmSalidaMI.val());
        var juevesRes       = resta(inputkmIngresoJ.val(), inputkmSalidaJ.val());
        var viernesRes      = resta(inputkmIngresoV.val(), inputkmSalidaV.val());
        var domingoRes      = resta(inputkmIngresoD.val(), inputkmSalidaD.val());
        var suma = lunesRes + martesRes + miercolesRes + juevesRes + viernesRes + domingoRes + resultado;
        document.getElementById("totalKm").value = suma;
    }); 
    (inputkmIngresoD).keyup(function() {     
        var resultado = resta($(this).prop('value'), inputkmSalidaD.val());
        var lunesRes        = resta(inputkmIngresoL.val(), inputkmSalidaL.val());
        var martesRes       = resta(inputkmIngresoMA.val(),inputkmSalidaMA.val()); 
        var miercolesRes    = resta(inputkmIngresoMI.val(),inputkmSalidaMI.val());
        var juevesRes       = resta(inputkmIngresoJ.val(), inputkmSalidaJ.val());
        var viernesRes      = resta(inputkmIngresoV.val(), inputkmSalidaV.val());
        var sabadoRes       = resta(inputkmIngresoS.val(), inputkmSalidaS.val()); 
        var suma = lunesRes + martesRes + miercolesRes + juevesRes + viernesRes + sabadoRes + resultado;
        document.getElementById("totalKm").value = suma;
    });
}
function resta(segundoInput, primerInput){ 
    var resta = parseInt(segundoInput - primerInput)  
    if(isNaN(resta)){
        return 0;
    }else if(resta < 1){
        return 0;
    }else{
        return resta;  
    } 
}
//Funcion dependiente para el cambio de estado habilitado a desabilitado de las filas de la tabla
function inicioTable(){
    changeState("#checkL","#fechaSalidaL", "#horaSalidaL", "#horaIngresoL", "#kmSalidaL", "#kmIngresoL", "#combustibleSalidaL", "#combustibleIngresoL", "#choferSalidaL", "#choferIngresoL","#guardaSalidaL", "#guardaIngresoL");
    changeState("#checkMA","#fechaSalidaMA", "#horaSalidaMA", "#horaIngresoMA", "#kmSalidaMA", "#kmIngresoMA", "#combustibleSalidaMA", "#combustibleIngresoMA", "#choferSalidaMA", "#choferIngresoMA","#guardaSalidaMA", "#guardaIngresoMA");
    changeState("#checkMI","#fechaSalidaMI", "#horaSalidaMI", "#horaIngresoMI", "#kmSalidaMI", "#kmIngresoMI", "#combustibleSalidaMI", "#combustibleIngresoMI", "#choferSalidaMI", "#choferIngresoMI","#guardaSalidaMI", "#guardaIngresoMI");
    changeState("#checkJ","#fechaSalidaJ", "#horaSalidaJ", "#horaIngresoJ", "#kmSalidaJ", "#kmIngresoJ", "#combustibleSalidaJ", "#combustibleIngresoJ", "#choferSalidaJ", "#choferIngresoJ","#guardaSalidaJ", "#guardaIngresoJ");
    changeState("#checkV","#fechaSalidaV", "#horaSalidaV", "#horaIngresoV", "#kmSalidaV", "#kmIngresoV", "#combustibleSalidaV", "#combustibleIngresoV", "#choferSalidaV", "#choferIngresoV","#guardaSalidaV", "#guardaIngresoV");
    changeState("#checkS","#fechaSalidaS", "#horaSalidaS", "#horaIngresoS", "#kmSalidaS", "#kmIngresoS", "#combustibleSalidaS", "#combustibleIngresoS", "#choferSalidaS", "#choferIngresoS","#guardaSalidaS", "#guardaIngresoS");
    changeState("#checkD","#fechaSalidaD", "#horaSalidaD", "#horaIngresoD", "#kmSalidaD", "#kmIngresoD", "#combustibleSalidaD", "#combustibleIngresoD", "#choferSalidaD", "#choferIngresoD","#guardaSalidaD", "#guardaIngresoD");
}
function checkClick(){
    $('#checkL').click(function(){ 
        changeState("#checkL","#fechaSalidaL", "#horaSalidaL", "#horaIngresoL", "#kmSalidaL", "#kmIngresoL", "#combustibleSalidaL", "#combustibleIngresoL", "#choferSalidaL", "#choferIngresoL","#guardaSalidaL", "#guardaIngresoL");
    }); 
    $('#checkMA').click(function(){ 
        changeState("#checkMA","#fechaSalidaMA", "#horaSalidaMA", "#horaIngresoMA", "#kmSalidaMA", "#kmIngresoMA", "#combustibleSalidaMA", "#combustibleIngresoMA", "#choferSalidaMA", "#choferIngresoMA","#guardaSalidaMA", "#guardaIngresoMA");
    }); 
    $('#checkMI').click(function(){ 
        changeState("#checkMI","#fechaSalidaMI", "#horaSalidaMI", "#horaIngresoMI", "#kmSalidaMI", "#kmIngresoMI", "#combustibleSalidaMI", "#combustibleIngresoMI", "#choferSalidaMI", "#choferIngresoMI","#guardaSalidaMI", "#guardaIngresoMI");
    }); 
    $('#checkJ').click(function(){ 
        changeState("#checkJ","#fechaSalidaJ", "#horaSalidaJ", "#horaIngresoJ", "#kmSalidaJ", "#kmIngresoJ", "#combustibleSalidaJ", "#combustibleIngresoJ", "#choferSalidaJ", "#choferIngresoJ","#guardaSalidaJ", "#guardaIngresoJ");
    }); 
    $('#checkV').click(function(){ 
        changeState("#checkV","#fechaSalidaV", "#horaSalidaV", "#horaIngresoV", "#kmSalidaV", "#kmIngresoV", "#combustibleSalidaV", "#combustibleIngresoV", "#choferSalidaV", "#choferIngresoV","#guardaSalidaV", "#guardaIngresoV");
    }); 
    $('#checkS').click(function(){ 
        changeState("#checkS","#fechaSalidaS", "#horaSalidaS", "#horaIngresoS", "#kmSalidaS", "#kmIngresoS", "#combustibleSalidaS", "#combustibleIngresoS", "#choferSalidaS", "#choferIngresoS","#guardaSalidaS", "#guardaIngresoS");
    }); 
    $('#checkD').click(function(){ 
        changeState("#checkD","#fechaSalidaD", "#horaSalidaD", "#horaIngresoD", "#kmSalidaD", "#kmIngresoD", "#combustibleSalidaD", "#combustibleIngresoD", "#choferSalidaD", "#choferIngresoD","#guardaSalidaD", "#guardaIngresoD");
    });  
}
function changeState(check, fechaSalida, horaSalida, horaIngreso, kmSalida, kmIngreso, combustibleSalida, combustibleIngreso, choferSalida, choferIngreso, guardaSalida, guardaIngreso){
    if( !$(check).is(':checked') ) { 
        $(fechaSalida).prop('disabled', true);
        $(horaSalida).prop('disabled', true);
        $(horaIngreso).prop('disabled', true);
        $(kmSalida).prop('disabled', true);
        $(kmIngreso).prop('disabled', true);
        $(combustibleSalida).prop('disabled', true);
        $(combustibleIngreso).prop('disabled', true);
        $(choferSalida).prop('disabled', true);
        $(choferIngreso).prop('disabled', true);
        $(guardaSalida).prop('disabled', true);
        $(guardaIngreso).prop('disabled', true);  
    }else{ 
        $(fechaSalida).prop('disabled', false);
        $(horaSalida).prop('disabled', false);
        $(horaIngreso).prop('disabled', false);
        $(kmSalida).prop('disabled', false);
        $(kmIngreso).prop('disabled', false);
        $(combustibleSalida).prop('disabled', false);
        $(combustibleIngreso).prop('disabled', false);
        $(choferSalida).prop('disabled', false);
        $(choferIngreso).prop('disabled', false);
        $(guardaSalida).prop('disabled', false);
        $(guardaIngreso).prop('disabled', false);  
    }
}   
//funcion para aplicar timepicker a los select de houra
function timePicker(){
    $(".timepicker").datetimepicker({ 
        datepicker:false,
        format:'H:i', 
    });
}
function datePicker(){
    $(".datepicker").datetimepicker({ 
        timepicker:false,
        format:'d/m/yy', 
    });
}
