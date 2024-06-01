@extends('welcome')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="/css/scroll.css" rel="stylesheet" /> 
    <link href="/css/presupuestosTable.css" rel="stylesheet" /> 
    <link href="/css/formatMoney.css" rel="stylesheet" />

    <script src="/js/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script src="/js/formatMoney.js" type="text/javascript"></script> 

    <link href="/css/table.css" rel="stylesheet" />
     
    <script>
        $(document).ready(function(){ 
            eliminar(); 
            $('.table').DataTable({
                "language": {
                    "url": "/json/Spanish.json"
                },
                "lengthMenu": [[5, 10, 25, 50], [5, 10, 25, 50]],
                "order": [[ 0, "desc" ]]
            });  
        });   
        function eliminar(){
            $(".eliminarMeca").click(function(){
                var idPMC = $(this).data("id");
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
                            url: "/eliminarPMC/"+idPMC,
                            type: 'post',
                            statusCode: {
                                302: function() { 
                                    setTimeout("location.href='/'", 100); 
                                }
                            },
                            data: {"idPMC": idPMC, _method: 'delete', _token: token},  
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
                                    text:"El Registro No Puede Ser Eliminado",
                                    type: "error", 
                                    buttons: "Aceptar", 
                                    confirmButtonText: 'Aceptar'});
                                } 
                            }
                        });
                    }else{
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
            $(".eliminarPAA").click(function(){
                var idPAA = $(this).data("id"); 
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
                            url: "/eliminarPAA/"+idPAA,
                            type: 'post',
                            statusCode: {
                                302: function() { 
                                    setTimeout("location.href='/'", 100); 
                                }
                            },
                            data: {"idPAA": idPAA, _method: 'delete', _token: token},  
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
                                    text:"El Registro No Puede Ser Eliminado",
                                    type: "error", 
                                    buttons: "Aceptar", 
                                    confirmButtonText: 'Aceptar'});
                                } 
                            }
                        });
                    }else {
                        Swal.fire({
                            title:"¡Cancelado!", 
                            text: "Registro No Eliminado",
                            type: "error", 
                            buttons: "Aceptar", 
                            confirmButtonText: 'Aceptar',
                            timer: 2000,});
                        }
                });
            });
            $(".eliminarPG").click(function(){
                var idPG = $(this).data("id"); 
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
                            url: "/eliminarPG/"+idPG,
                            type: 'post',
                            statusCode: {
                                302: function() { 
                                    setTimeout("location.href='/'", 100); 
                                }
                            },
                            data: {"idPG": idPG, _method: 'delete', _token: token},  
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
                                    Swal.fire("¡Registro no Eliminado!", {type: 'success',icon: "error", buttons: "Aceptar", });
                                    } 
                            }
                        });
                    }else {
                            Swal.fire("¡Registro no Eliminado!", {type: 'error',icon: "error", buttons: "Aceptar", });
                        }
                });
            }); 
            $(".eliminarPRC").click(function(){
                var idPRC = $(this).data("id"); 
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
                            url: "/eliminarPRC/"+idPRC,
                            type: 'post',
                            statusCode: {
                                302: function() { 
                                    setTimeout("location.href='/'", 100); 
                                }
                            },
                            data: {"idPRC": idPRC, _method: 'delete', _token: token},  
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
                                    text:"El Registro No Puede Ser Eliminado",
                                    type: "error", 
                                    buttons: "Aceptar", 
                                    confirmButtonText: 'Aceptar'});
                                    } 
                            }
                        });
                    }else {
                            Swal.fire({
                            title:"¡Cancelado!", 
                            text: "Registro No Eliminado",
                            type: "error", 
                            buttons: "Aceptar", 
                            confirmButtonText: 'Aceptar',
                            timer: 2000,});
                        }
                });
            }); 
            $(".eliminarPLV").click(function(){
                var idPLV = $(this).data("id");  
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
                            url: "/eliminarPLV/"+idPLV,
                            type: 'post',
                            statusCode: {
                                302: function() { 
                                    setTimeout("location.href='/'", 100); 
                                }
                            },
                            data: {"idPLV": idPLV, _method: 'delete', _token: token},  
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
                                    text:"El Registro No Puede Ser Eliminado",
                                    type: "error", 
                                    buttons: "Aceptar", 
                                    confirmButtonText: 'Aceptar'});
                                    } 
                            }
                        });
                    }else {
                        Swal.fire({
                            title:"¡Cancelado!", 
                            text: "Registro No Eliminado",
                            type: "error", 
                            buttons: "Aceptar", 
                            confirmButtonText: 'Aceptar',
                            timer: 2000,});
                        }
                });
            });
            $(".eliminarCombustible").click(function(){
                var idPC = $(this).data("id");  
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
                            url: "/eliminarPC/"+idPC,
                            type: 'post',
                            statusCode: {
                                302: function() { 
                                    setTimeout("location.href='/'", 100); 
                                }
                            },
                            data: {"idPC": idPC, _method: 'delete', _token: token},  
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
                                    text:"El Registro No Puede Ser Eliminado",
                                    type: "error", 
                                    buttons: "Aceptar", 
                                    confirmButtonText: 'Aceptar'});
                                } 
                            }
                        });
                    }else {
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
            $(".eliminarAdminisCombustible").click(function(){
                var idAC = $(this).data("id");  
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
                            url: "/eliminarAC/"+idAC,
                            type: 'post',
                            statusCode: {
                                302: function() { 
                                    setTimeout("location.href='/'", 100); 
                                }
                            },
                            data: {"idAC": idAC, _method: 'delete', _token: token},  
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
                                    text:"El Registro No Puede Ser Eliminado",
                                    type: "error", 
                                    buttons: "Aceptar", 
                                    confirmButtonText: 'Aceptar'});
                                } 
                            }
                        });
                    }else {
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
            $(".eliminarDesarrUrbanoCombustible").click(function(){
                var idDUC = $(this).data("id");  
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
                            url: "/eliminarDUC/"+idDUC,
                            type: 'post',
                            statusCode: {
                                302: function() { 
                                    setTimeout("location.href='/'", 100); 
                                }
                            },
                            data: {"idDUC": idDUC, _method: 'delete', _token: token},  
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
                                    text:"El Registro No Puede Ser Eliminado",
                                    type: "error", 
                                    buttons: "Aceptar", 
                                    confirmButtonText: 'Aceptar'});
                                } 
                            }
                        });
                    }else {
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
            $(".eliminarDireccionTecnicaCombustible").click(function(){
                var idDTC = $(this).data("id");  
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
                            url: "/eliminarDTC/"+idDTC,
                            type: 'post',
                            statusCode: {
                                302: function() { 
                                    setTimeout("location.href='/'", 100); 
                                }
                            },
                            data: {"idDTC": idDTC, _method: 'delete', _token: token},  
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
                                    text:"El Registro No Puede Ser Eliminado",
                                    type: "error", 
                                    buttons: "Aceptar", 
                                    confirmButtonText: 'Aceptar'});
                                } 
                            }
                        });
                    }else {
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
            $(".eliminarMecaMoto").click(function(){
                var idPMM = $(this).data("id"); 
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
                            url: "/eliminarPMM/"+idPMM,
                            type: 'post',
                            statusCode: {
                                302: function() { 
                                    setTimeout("location.href='/'", 100); 
                                }
                            },
                            data: {"idPMM": idPMM, _method: 'delete', _token: token},  
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
                                    text:"El Registro No Puede Ser Eliminado",
                                    type: "error", 
                                    buttons: "Aceptar", 
                                    confirmButtonText: 'Aceptar'});
                                } 
                            }
                        });
                    }else {
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
            $(".eliminarRepMoto").click(function(){
                var idPRM = $(this).data("id"); 
                var token = $("meta[name='csrf-token']").attr("content");
                    
                Swal.fire({
                    title: "¿Está Seguro de Eliminar el Registro?",
                    text: "El Registro no podrá Recuperarse",
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
                            url: "/eliminarPRM/"+idPRM,
                            type: 'post',
                            statusCode: {
                                302: function() { 
                                    setTimeout("location.href='/'", 100); 
                                }
                            },
                            data: {"idPRM": idPRM, _method: 'delete', _token: token},  
                            success: 
                            function (data){
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
                                    text:"El Registro No Puede Ser Eliminado",
                                    type: "error", 
                                    buttons: "Aceptar", 
                                    confirmButtonText: 'Aceptar'});
                                } 
                            }
                        });
                    }else {
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
        } 
    </script>   
</head> 
<body>      
    <ul class="nav nav-pills" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="pills-mecanica-tab" data-toggle="pill" href="#pills-mecanica" role="tab" aria-controls="pills-mecanica" aria-selected="true">Mecánica</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-repuestos-tab" data-toggle="pill" href="#pills-repuestos" role="tab" aria-controls="pills-repuestos" aria-selected="false">Repuestos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-lavado-tab" data-toggle="pill" href="#pills-lavado" role="tab" aria-controls="pills-lavado" aria-selected="false">Lavado</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-airesAcon-tab" data-toggle="pill" href="#pills-airesAcon" role="tab" aria-controls="pills-airesAcon" aria-selected="false">Aires Acondicionados</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-combustible-tab" data-toggle="pill" href="#pills-combustible" role="tab" aria-controls="pills-combustible" aria-selected="false">Combustible</a>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-mecanica" role="tabpanel" aria-labelledby="pills-mecanica-tab">
            <div class="row"> 
                <!--inicio presupuesto para Mecánica de Motos-->  
                <div class="col-lg-6">  
                    <div class="card"> 
                        <div class="card-heading text-center"> 
                            <h3 style="color:black">Presupuesto para Mecánica de Motos</h3>
                            <h3 style="color:black">02,26,01,08,05</h3>
                        </div>
                        <div style="text-align: right;">      
                            <a class="btn bg-happy-green" href="{{ route('presupuestoMecaMoto.create') }}" style="color:black"><i class="fas fa-plus"></i> Nuevo presupuesto</a> 
                            <br><br>        
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr> 
                                        <th>Fecha Registro</th>
                                        <th>Monto Establecido</th>
                                        <th>Monto Restante</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($presupuestoMM as $MecanicaMoto)
                                    <tr>
                                        <td data-sort="{{ date('Y-m-d', strtotime($MecanicaMoto->fechaRegistro))}}">{{ date('d/m/Y', strtotime($MecanicaMoto->fechaRegistro))}}</td>  
                                        <td class="money">{{$MecanicaMoto->montoEstablecido}}</td>
                                        <td class="money">{{$MecanicaMoto->montoRestante}}</td>
                                        @if($MecanicaMoto->cantFact > 0)
                                            <td>
                                                <a class="btn bg-happy-itmeo" href="{{ route('historicoMM.ver', $MecanicaMoto->idPMM) }}"><i class="fas fa-eye" style="color:black"> Facturas</i></a> 
                                            </td>
                                            @else
                                            <td>
                                                <a class="btn bg-sunny-morning" href="{{ route('presupuestoMecaMoto.edit', $MecanicaMoto->idPMM) }}"><i class="fas fa-edit" style="color:black"> Editar</i> </a>  
                                                <a class="btn bg-happy-itmeo" href="{{ route('historicoMM.ver', $MecanicaMoto->idPMM) }}"><i class="fas fa-eye" style="color:black"> Facturas</i></a> 
                                                <button class="eliminarMecaMoto btn bg-love-kiss" data-id="{{ $MecanicaMoto->idPMM }}" style="color:black"><i class="fas fa-trash"> Eliminar</i> </button>  
                                            </td>
                                        @endif

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table> 
                        </div> 
                    </div>  
                </div> 
                <!--Fin presupuesto para Mecánica de Motos-->
                <!--Inicio Mecanica Carro-->
                <div class="col-lg-6">  
                    <div class="card"> 
                        <div class="card-heading text-center"> 
                            <h3 style="color:black">Presupuesto para Mecánica de Carros</h3>
                            <h3 style="color:black">01,01,01,08,05</h3>
                        </div>
                        <div style="text-align: right;">      
                            <a class="btn bg-happy-green" href="{{ route('presupuestoMecaCarro.create') }}" style="color:black"><i class="fas fa-plus"></i> Nuevo presupuesto</a> 
                            <br><br>        
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr> 
                                        <th>Fecha Registro</th>
                                        <th>Monto Establecido</th>
                                        <th>Monto Restante</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($presupuestoMC as $MecanicaCarro)
                                        <tr>
                                            <td data-sort="{{ date('Y-m-d', strtotime($MecanicaCarro->fechaRegistro))}}">{{ date('d/m/Y', strtotime($MecanicaCarro->fechaRegistro))}}</td>  
                                            <td class="money">{{$MecanicaCarro->montoEstablecido}}</td>
                                            <td class="money">{{$MecanicaCarro->montoRestado}}</td>
                                            @if($MecanicaCarro->cantFact > 0) 
                                                <td> 
                                                    <a class="btn bg-happy-itmeo" href="{{ route('historicoMC.ver', $MecanicaCarro->idPMC) }}"><i class="fas fa-eye" style="color:black"> Facturas</i></a> 
                                                </td>
                                                @else
                                                <td> 
                                                    <a class="btn bg-sunny-morning" href="{{ route('presupuestoMecaCarro.edit', $MecanicaCarro->idPMC) }}"><i class="fas fa-edit" style="color:black"> Editar</i> </a> 
                                                    <a class="btn bg-happy-itmeo" href="{{ route('historicoMC.ver', $MecanicaCarro->idPMC) }}"><i class="fas fa-eye" style="color:black"> Facturas</i></a> 
                                                    <button class="eliminarMeca btn bg-love-kiss" data-id="{{ $MecanicaCarro->idPMC }}" style="color:black"><i class="fas fa-trash"> Eliminar</i> </button>       
                                                </td>
                                            @endif 
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>  
                        </div> 
                    </div> 
                    <br>
                </div> 
                <!--Fin Mecanica Carro-->
            </div>
        </div>
        <div class="tab-pane fade" id="pills-repuestos" role="tabpanel" aria-labelledby="pills-repuestos-tab">
            <div class="row">
                <!--inicio presupuesto para repuesto de motos -->
                <div class="col-lg-6">  
                    <div class="card">  
                        <div class="card-heading text-center">      
                            <h3 style="color:black">Presupuesto para Repuestos de Motos</h3> 
                            <h3 style="color:black">02,26,02,04,02</h3>
                        </div>
                        <div style="text-align: right;">      
                            <a class="btn bg-happy-green" href="{{ route('presupuestoRepuestoMoto.create') }}" style="color:black"><i class="fas fa-plus"></i> Nuevo presupuesto</a> 
                            <br><br>        
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr> 
                                        <th>Fecha Registro</th>
                                        <th>Monto Establecido</th>
                                        <th>Monto Restante</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($presupuestoRM as $RepuestoMoto)
                                    <tr>
                                        <td data-sort="{{ date('Y-m-d', strtotime($RepuestoMoto->fechaRegistro))}}">{{ date('d/m/Y', strtotime($RepuestoMoto->fechaRegistro))}}</td>  
                                        <td class="money">{{$RepuestoMoto->montoEstablecido}}</td>
                                        <td class="money">{{$RepuestoMoto->montoRestante}}</td>
                                        @if($RepuestoMoto->cantFact > 0)
                                            <td>   
                                                <a class="btn bg-happy-itmeo" href="{{ route('historicoRM.ver', $RepuestoMoto->idPRM) }}"><i class="fas fa-eye" style="color:black"> Facturas</i></a> 
                                            </td>
                                            @else
                                            <td>   
                                                <a class="btn bg-sunny-morning" href="{{ route('presupuestoRepuestoMoto.edit', $RepuestoMoto->idPRM) }}"><i class="fas fa-edit" style="color:black"> Editar</i> </a>  
                                                <a class="btn bg-happy-itmeo" href="{{ route('historicoRM.ver', $RepuestoMoto->idPRM) }}"><i class="fas fa-eye" style="color:black"> Facturas</i></a> 
                                                <button class="eliminarRepMoto btn bg-love-kiss" data-id="{{ $RepuestoMoto->idPRM }}"><i class="fas fa-trash" style="color:black"> Eliminar</i> </button>  
                                            </td>
                                        @endif  
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table> 
                        </div>
                    </div>  
                </div> 
                <!--fin presupuesto para repuesto de motos -->       
                <!--Inicio presupuesto para repuesto de carros --> 
                <div class="col-lg-6">  
                    <div class="card">  
                        <div class="card-heading text-center">  
                            <h3 style="color:black">Presupuesto para Repuestos de Carros</h3>
                            <h3 style="color:black">01,01,02,04,02</h3>
                        </div>
                        <div style="text-align: right;">      
                            <a class="btn bg-happy-green pull-left" href="{{ route('PresupuestoRC.create') }}" style="color:black"><i class="fas fa-plus"></i> Nuevo presupuesto</a> 
                            <br><br>        
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr> 
                                        <th>Fecha Registro</th>
                                        <th>Monto Establecido</th>
                                        <th>Monto Restante</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($presupuestoRC as $RespuestoCarro)
                                    <tr>
                                        <td data-sort="{{ date('Y-m-d', strtotime($RespuestoCarro->fechaRegistro))}}">{{ date('d/m/Y', strtotime($RespuestoCarro->fechaRegistro))}}</td>  
                                        <td class="money">{{$RespuestoCarro->montoEstablecido}}</td>
                                        <td class="money">{{$RespuestoCarro->montoRestado}}</td>
                                        @if($RespuestoCarro->cantFact > 0)
                                            <td> 
                                                <a class="btn bg-happy-itmeo" href="{{ route('historicoRC.ver', $RespuestoCarro->idPRC) }}"><i class="fas fa-eye" style="color:black"> Facturas</i></a> 
                                            </td>
                                            @else
                                            <td> 
                                                <a class="btn bg-sunny-morning" href="{{ route('PresupuestoRC.edit', $RespuestoCarro->idPRC) }}"><i class="fas fa-edit" style="color:black"> Editar</i> </a> 
                                                <a class="btn bg-happy-itmeo" href="{{ route('historicoRC.ver', $RespuestoCarro->idPRC) }}"><i class="fas fa-eye" style="color:black"> Facturas</i></a> 
                                                <button class="eliminarPRC btn bg-love-kiss" data-id="{{ $RespuestoCarro->idPRC }}" style="color:black"><i class="fas fa-trash"> Eliminar</i> </button>  
                                            </td>
                                        @endif 
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table> 
                        </div> 
                    </div> 
                    <br>
                </div>   
                <!--fin presupuesto para repuesto de carros -->     
            </div>   
        </div>
        <div class="tab-pane fade" id="pills-lavado" role="tabpanel" aria-labelledby="pills-lavado-tab">  
            <!--inicio lavado de vehiculos--> 
            <div class="col-lg-11" id="col-lavado">
                <div class="card">
                    <div class="text-center">      
                        <h3 style="color:black">Presupuesto para Lavado de Vehículos</h3>
                        <h3 style="color:black">01,01,01,08,05</h3> 
                    </div>  
                    <div style="text-align: right;">
                        <a class="btn bg-happy-green" href="{{ route('presupuestoLavaVehi.create') }}" style="color:black"><i class="fas fa-plus"></i> Nuevo presupuesto</a> 
                        <br><br>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr> 
                                    <th>Fecha Registro</th>
                                    <th>Monto Establecido</th>
                                    <th>Monto Restante</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach($presupuestoLV as $PLV)
                                <tr class="success">
                                    <td data-sort="{{ date('Y-m-d', strtotime($PLV->fecha))}}">{{ date('d/m/Y', strtotime($PLV->fecha))}}</td>  
                                    <td class="money">{{$PLV->monto}}</td>
                                    <td class="money">{{$PLV->montoRestante}}</td> 
                                    @if($PLV->cantFact > 0)
                                        <td>
                                            <a class="btn bg-happy-itmeo" href="{{ route('historicoLV.ver', $PLV->idPLV) }}"><i class="fas fa-eye" style="color:black"> Facturas</i></a>
                                        </td>
                                        @else
                                        <td>
                                            <a class="btn bg-sunny-morning" href="{{ route('presupuestoLavaVehi.edit', $PLV->idPLV) }}"><i class="fas fa-edit" style="color:black"> Editar</i></a> 
                                            <a class="btn bg-happy-itmeo" href="{{ route('historicoLV.ver', $PLV->idPLV) }}"><i class="fas fa-eye" style="color:black"> Facturas</i></a>
                                            <button class="eliminarPLV btn bg-love-kiss" data-id="{{ $PLV->idPLV }}" style="color:black"><i class="fas fa-trash"> Eliminar</i> </button>  
                                        </td>
                                    @endif  
                                </tr>
                                @endforeach
                            </tbody>
                        </table> 
                    </div>   
                </div>  
            </div>  
            <!--fin de presupuesto lavado-->  
        </div>
        <div class="tab-pane fade" id="pills-airesAcon" role="tabpanel" aria-labelledby="pills-airesAcon-tab">
            <!--inicio aires acondicionados-->
            <div class="col-lg-11" id="col-airesAcon">  
                <div class="card"> 
                    <div class="card-heading text-center">      
                        <h3 style="color:black">Presupuesto para Aires Acondicionados</h3> 
                        <h3 style="color:black">01,01,01,08,05</h3>
                    </div>
                    <div style="text-align: right;">      
                        <a class="btn bg-happy-green" href="{{ route('presupuestoAiresAcond.create') }}" style="color:black"><i class="fas fa-plus"></i> Nuevo presupuesto</a> 
                        <br><br>        
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr> 
                                    <th>Fecha Registro</th>
                                    <th>Monto Establecido</th>
                                    <th>Monto Restante</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach($presupuestoAA as $PAA)
                                    <tr class="success">
                                        <td data-sort="{{ date('Y-m-d', strtotime($PAA->fechaRegistro))}}">{{ date('d/m/Y', strtotime($PAA->fechaRegistro))}}</td>  
                                        <td class="money">{{$PAA->montoEstablecido}}</td>
                                        <td class="money">{{$PAA->montoRestante}}</td> 
                                        @if($PAA->cantFact > 0)
                                            <td>
                                                <a class="btn bg-happy-itmeo" href="{{ route('historicoAA.ver', $PAA->idPAA) }}"><i class="fas fa-eye" style="color:black"> Facturas</i></a> 
                                            </td>
                                            @else
                                            <td>
                                                <a class="btn bg-sunny-morning" href="{{ route('presupuestoAiresAcond.edit', $PAA->idPAA) }}"><i class="fas fa-edit" style="color:black"> Editar</i></a> 
                                                <a class="btn bg-happy-itmeo" href="{{ route('historicoAA.ver', $PAA->idPAA) }}"><i class="fas fa-eye" style="color:black"> Facturas</i></a> 
                                                <button class="eliminarPAA btn bg-love-kiss" data-id="{{ $PAA->idPAA }}" style="color:black"><i class="fas fa-trash"> Eliminar</i> </button>  
                                            </td>
                                        @endif   
                                    </tr> 
                                @endforeach
                            </tbody>
                        </table> 
                    </div> 
                </div>   
                <br>
            </div>
            <!--fin aires acondicionados--> 
        </div>
        <div class="tab-pane fade" id="pills-combustible" role="tabpanel" aria-labelledby="pills-combustible-tab">
            <div class="row">     
                <!--inicio Administración para combustible-->   
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-heading text-center">
                            <h3 style="color:black">presupuesto de Administración para combustible</h3>
                        </div>   
                        <div style="text-align: right;">      
                            <a class="btn bg-happy-green" href="{{ route('AdministracionCombustible.create') }}" style="color:black"><i class="fas fa-plus"></i> Nuevo presupuesto</a> <br><br>
                        </div> 
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr> 
                                        <th>Fecha Registro</th>
                                        <th>Monto Establecido</th>
                                        <th>Monto Restante</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($presupuestoAC as $Combustible)
                                        <tr> 
                                            <td data-sort="{{ date('Y-m-d', strtotime($Combustible->fechaRegistro))}}">{{ date('d/m/Y', strtotime($Combustible->fechaRegistro))}}</td> 
                                            <td class="money">{{$Combustible->montoEstablecido}}</td>
                                            <td class="money">{{$Combustible->montoRestante}}</td>  
                                            @if($Combustible->cantFact > 0)
                                                <td>  
                                                    <a class="btn bg-happy-itmeo" href="{{ route('historicoAC.ver', $Combustible->idAC) }}"><i class="fas fa-eye" style="color:black"> Facturas</i></a> 
                                                </td>
                                                @else
                                                <td>  
                                                    <a class="btn bg-sunny-morning" href="{{ route('AdministracionCombustible.edit', $Combustible->idAC) }}" ><i class="fas fa-edit" style="color:black"> Editar</i></a>
                                                    <a class="btn bg-happy-itmeo" href="{{ route('historicoAC.ver', $Combustible->idAC) }}"><i class="fas fa-eye" style="color:black"> Facturas</i></a> 
                                                    <button class="eliminarAdminisCombustible btn bg-love-kiss" data-id="{{ $Combustible->idAC }}"><i class="fas fa-trash" style="color:black"> Eliminar</i> </button>  
                                                </td>
                                            @endif 
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table> 
                        </div>  
                    </div>  
                </div> 
                <!--fin Administración para combustible-->   
                <!--inicio presupuesto desarrollo urbano para combustible-->   
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-heading text-center">
                            <h3 style="color:black">Presupuesto de desarrollo urbano para combustible</h3>
                        </div>   
                        <div style="text-align: right;">      
                            <a class="btn bg-happy-green" href="{{ route('DesarrUrbanoCombustible.create') }}" style="color:black"><i class="fas fa-plus"></i> Nuevo presupuesto</a> <br><br>
                        </div> 
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr> 
                                        <th>Fecha Registro</th>
                                        <th>Monto Establecido</th>
                                        <th>Monto Restante</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($presupuestoDUC as $Combustible)
                                        <tr> 
                                            <td data-sort="{{ date('Y-m-d', strtotime($Combustible->fechaRegistro))}}">{{ date('d/m/Y', strtotime($Combustible->fechaRegistro))}}</td> 
                                            <td class="money">{{$Combustible->montoEstablecido}}</td>
                                            <td class="money">{{$Combustible->montoRestante}}</td> 
                                            @if($Combustible->cantFact > 0)
                                                <td>  
                                                    <a class="btn bg-happy-itmeo" href="{{ route('historicoDUC.ver', $Combustible->idDUC) }}"><i class="fas fa-eye" style="color:black"> Facturas</i></a> 
                                                </td>
                                                @else
                                                <td>  
                                                    <a class="btn bg-sunny-morning" href="{{ route('DesarrUrbanoCombustible.edit', $Combustible->idDUC) }}" ><i class="fas fa-edit" style="color:black"> Editar</i></a>
                                                    <a class="btn bg-happy-itmeo" href="{{ route('historicoDUC.ver', $Combustible->idDUC) }}"><i class="fas fa-eye" style="color:black"> Facturas</i></a> 
                                                    <button class="eliminarDesarrUrbanoCombustible btn bg-love-kiss" data-id="{{ $Combustible->idDUC }}"><i class="fas fa-trash" style="color:black"> Eliminar</i> </button>  
                                                </td>
                                            @endif 
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table> 
                        </div>  
                    </div>  
                </div> 
                <!--fin presupuesto desarrollo urbano para combustible-->  
            </div> 
            <br>
            <div class="row"> 
                <!--inicio dirección técnica para combustible-->   
                <div class="col-lg-8" id="col-combustible">
                    <div class="card">
                        <div class="card-heading text-center">
                            <h3 style="color:black">Presupuesto de dirección técnica para combustible</h3>
                        </div>   
                        <div style="text-align: right;">      
                            <a class="btn bg-happy-green" href="{{ route('DireccionTecnicaCombustible.create') }}" style="color:black"><i class="fas fa-plus"></i> Nuevo presupuesto</a> <br><br>
                        </div> 
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr> 
                                        <th>Fecha Registro</th>
                                        <th>Monto Establecido</th>
                                        <th>Monto Restante</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($presupuestoDTC as $Combustible)
                                        <tr> 
                                            <td data-sort="{{ date('Y-m-d', strtotime($Combustible->fechaRegistro))}}">{{ date('d/m/Y', strtotime($Combustible->fechaRegistro))}}</td> 
                                            <td class="money">{{$Combustible->montoEstablecido}}</td>
                                            <td class="money">{{$Combustible->montoRestante}}</td>  
                                            @if($Combustible->cantFact > 0)
                                                <td>  
                                                    <a class="btn bg-happy-itmeo" href="{{ route('historicoDTC.ver', $Combustible->idDTC) }}"><i class="fas fa-eye" style="color:black"> Facturas</i></a> 
                                                </td>
                                                @else
                                                <td>  
                                                    <a class="btn bg-sunny-morning" href="{{ route('DireccionTecnicaCombustible.edit', $Combustible->idDTC) }}" ><i class="fas fa-edit" style="color:black"> Editar</i></a>
                                                    <a class="btn bg-happy-itmeo" href="{{ route('historicoDTC.ver', $Combustible->idDTC) }}"><i class="fas fa-eye" style="color:black"> Facturas</i></a> 
                                                    <button class="eliminarDireccionTecnicaCombustible btn bg-love-kiss" data-id="{{ $Combustible->idDTC }}"><i class="fas fa-trash" style="color:black"> Eliminar</i> </button>  
                                                </td>
                                            @endif 
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table> 
                        </div>  
                    </div>  
                </div> 
                <!--fin dirección técnica para combustible-->  
            </div> 
        </div>
    </div>   
</body>
</html>

@endsection