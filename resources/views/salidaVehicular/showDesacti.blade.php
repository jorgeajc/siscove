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
        <script src="/js/toastr.min.js"> type="text/javascript"</script> 
        <script>
            $(document).ready(function(){
                $('input, textarea').each(function(){ 
                    $(this).prop('disabled', true);
                    $(this).css('background-color' , 'transparent');  
                });   
                $('.state').each(function(){  
                    $(this).css('opacity' , '1');
                });   
            });   
        </script>    
    </head>
    <body>    
        <div class="row justify-content-center" id="show">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-heading text-center">
                        <br>
                            <h2 class="titulo">REGISTRO DE INGRESO Y SALIDA DEL VEHÍCULO <div style="color: blue;">{{$placa}}</div></h2> 
                            <h3 class="subtitulo">Unidad Tecnica Administrativa Transporte </h3>  
                        <br>
                    </div>
                    <div class="card-body">  
                        <div class="form-horizontal">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group row">
                                        <label for="oficinaSolicitante" class="col-form-label text-md-right subtitulo"> Oficina Solicitante: </label> 
                                        <div class="col-md-6">
                                            <input class="form-control" type="text"     name="oficinaSolicitante" id="oficinaSolicitante" value="{{$salVehiCarrPrinc->oficinaSolicitante}}"> 
                                        </div>
                                    </div>  
                                </div> 
                                <div class="col-lg-4">
                                    <div class="form-group row">
                                        <label for="fechaAutorizacionSalida" class=" col-form-label text-md-right subtitulo">Fecha Autorización Paso De Vehículo:  Del</label> 
                                        <div class="col-md-5"> 
                                            <input id="fechaAutorizacionSalida" type="date" class="form-control" name="fechaAutorizacionSalida" value="{{$salVehiCarrPrinc->fechaAutorizacionSalida}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group row">
                                        <label for="fechaAutorizacionIngreso" class="col-form-label text-md-right subtitulo" >{{ __('al ') }}</label> 
                                        <div class="col-md-10">
                                            <input id="fechaAutorizacionIngreso" type="date" class="form-control" name="fechaAutorizacionIngreso" value="{{$salVehiCarrPrinc->fechaAutorizacionIngreso}}">
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
                                        <th class="text-center thtitulo1" rowspan="2">DÍA</th>  
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
                                        <td class="td td1">LUNES</td>
                                        <td class="td td2">   
                                            @if($indices['lunes'] !== false)<input id="fechaSalidaL" type="date" class="clearBorder form-control" name="fechaSalidaL" value="{{$resConSVKC[$indices['lunes']]->fecha}}">@endif 
                                        </td>
                                        <td class="td td3">
                                            @if($indices['lunes'] !== false)<input id="horaSalidaL" type="time" class="clearBorder form-control" name="horaSalidaL" value="{{$resConSVKC[$indices['lunes']]->horaSalida}}">@endif 
                                        </td>
                                        <td class="td td4">
                                            @if($indices['lunes'] !== false)<input id="horaIngresoL" type="time" class="clearBorder form-control" name="horaIngresoL" value="{{$resConSVKC[$indices['lunes']]->horaIngreso}}">@endif 
                                        </td>
                                        <td class="td td5">
                                            @if($indices['lunes'] !== false)<input id="kmSalidaL" type="number" class="clearBorder form-control" name="kmSalidaL" value="{{$resConSVKC[$indices['lunes']]->kmSalida}}">@endif 
                                        </td>
                                        <td class="td td6">
                                            @if($indices['lunes'] !== false)<input id="kmIngresoL" type="number" class="clearBorder form-control" name="kmIngresoL" value="{{$resConSVKC[$indices['lunes']]->kmIngreso}}">@endif 
                                        </td>
                                        <td class="td td7">
                                            @if($indices['lunes'] !== false)<input id="combustibleSalidaL" type="number" class="clearBorder form-control" name="combustibleSalidaL" value="{{$resConSVKC[$indices['lunes']]->combustibleSalida}}">@endif 
                                        </td>
                                        <td class="td td8">
                                            @if($indices['lunes'] !== false)<input id="combustibleIngresoL" type="number" class="clearBorder form-control" name="combustibleIngresoL" value="{{$resConSVKC[$indices['lunes']]->combustibleIngreso}}">@endif 
                                        </td>
                                        <td class="td td9"> 
                                            @if($indices['lunes'] !== false)
                                                @foreach($usuarios as $usuario) 
                                                    @if($usuario->id == $resConSVKC[$indices['lunes']]->choferSalida)
                                                        <input id="choferSalidaL" class="clearBorder" value="{{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} ">
                                                    @endif
                                                @endforeach 
                                             @endif
                                        </td>
                                        <td class="td td10"> 
                                            @if($indices['lunes'] !== false)
                                                @foreach($usuarios as $usuario)
                                                    @if($usuario->id == $resConSVKC[$indices['lunes']]->choferIngreso)
                                                        <input id="choferIngresoL"  class="clearBorder" value="{{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}}">
                                                    @endif
                                                @endforeach 
                                            @endif
                                        </td>
                                        <td class="td td11"> 
                                            @if($indices['lunes'] !== false)
                                                @foreach($usuarios as $usuario)
                                                    @if($usuario->id == $resConSVKC[$indices['lunes']]->guardaSalida)
                                                        <input id="guardaSalidaL" class="clearBorder" value="{{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}}">
                                                    @endif
                                                @endforeach 
                                            @endif
                                        </td>
                                        <td class="td td12"> 
                                            @if($indices['lunes'] !== false)
                                                @foreach($usuarios as $usuario)
                                                    @if($usuario->id == $resConSVKC[$indices['lunes']]->guardaIngreso)
                                                        <input id="guardaIngresoL" class="clearBorder" value="{{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}}">
                                                    @endif
                                                @endforeach 
                                            @endif
                                        </td>  
                                    </tr> 
                                    <!--MARTES -->
                                    <tr>
                                        <td class="td td1">MARTES</td>
                                        <td class="td td2">
                                            @if($indices['martes'] !== false)<input id="fechaSalidaMA" type="date" class="clearBorder form-control" name="fechaSalidaMA" value="{{$resConSVKC[$indices['martes']]->fecha}}">@endif 
                                        </td>
                                        <td class="td td3">
                                            @if($indices['martes'] !== false)<input id="horaSalidaMA" type="time" class="clearBorder form-control" name="horaSalidaMA" value="{{$resConSVKC[$indices['martes']]->horaSalida}}">@endif 
                                        </td>
                                        <td class="td td4">
                                            @if($indices['martes'] !== false)<input id="horaIngresoMA" type="time" class="clearBorder form-control" name="horaIngresoMA" value="{{$resConSVKC[$indices['martes']]->horaIngreso}}">@endif 
                                        </td>
                                        <td class="td td5"> 
                                            @if($indices['martes'] !== false) <input id="kmSalidaMA"  type="number" class="clearBorder form-control conteo" name="kmSalidaMA" value="{{$resConSVKC[$indices['martes']]->kmSalida}}">@endif 
                                        </td>
                                        <td class="td td6">
                                            @if($indices['martes'] !== false)  <input id="kmIngresoMA"  type="number" class="clearBorder form-control conteo" name="kmIngresoMA" value="{{$resConSVKC[$indices['martes']]->kmIngreso}}">@endif 
                                        </td>
                                        <td class="td td7">
                                            @if($indices['martes'] !== false)  <input id="combustibleSalidaMA"  type="number" class="clearBorder form-control" name="combustibleSalidaMA" value="{{$resConSVKC[$indices['martes']]->combustibleSalida}}">@endif 
                                        </td>
                                        <td class="td td8">
                                            @if($indices['martes'] !== false) <input id="combustibleIngresoMA"  type="number" class="clearBorder form-control" name="combustibleIngresoMA" value="{{$resConSVKC[$indices['martes']]->combustibleIngreso}}">@endif 
                                        </td>
                                        <td class="td td9">
                                            @if($indices['martes'] !== false)  
                                                @foreach($usuarios as $usuario)
                                                    @if($usuario->id == $resConSVKC[$indices['martes']]->guardaIngreso)
                                                        <input id="choferSalidaMA" class="clearBorder" value="{{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}}">
                                                    @endif 
                                                @endforeach 
                                            @endif  
                                        </td>
                                        <td class="td td10"> 
                                            @if($indices['martes'] !== false) 
                                               @foreach($usuarios as $usuario)
                                                    @if($usuario->id == $resConSVKC[$indices['martes']]->guardaIngreso)
                                                        <input id="choferIngresoMA" class="clearBorder" value="{{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}}"> 
                                                    @endif 
                                                @endforeach 
                                            @endif   
                                        </td>
                                        <td class="td td11"> 
                                            @if($indices['martes'] !== false) 
                                                @foreach($usuarios as $usuario)
                                                    @if($usuario->id == $resConSVKC[$indices['martes']]->guardaIngreso)
                                                        <input id="guardaSalidaMA" class="clearBorder" value="{{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}}"> 
                                                    @endif   
                                                @endforeach 
                                            @endif   
                                        </td>
                                        <td class="td td12">
                                            @if($indices['martes'] !== false) 
                                                @foreach($usuarios as $usuario)
                                                    @if($usuario->id == $resConSVKC[$indices['martes']]->guardaIngreso)
                                                        <input id="guardaIngresoMA" class="clearBorder" value="{{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}}"> 
                                                    @endif   
                                                @endforeach 
                                            @endif     
                                        </td>   
                                    </tr> 
                                    <!--MIERCOLES -->
                                    <tr>
                                        <td class="td td1">MIERCOLES</td>
                                        <td class="td td2">
                                            @if($indices['miercoles'] !== false) <input id="fechaSalidaMI" type="date" class="clearBorder form-control" name="fechaSalidaMI" value="{{$resConSVKC[$indices['miercoles']]->fecha}}"> @endif 
                                        </td>
                                        <td class="td td3">
                                            @if($indices['miercoles'] !== false) <input id="horaSalidaMI" type="time" class="clearBorder form-control" name="horaSalidaMI" value="{{$resConSVKC[$indices['miercoles']]->horaSalida}}"> @endif 
                                        </td>
                                        <td class="td td4">
                                            @if($indices['miercoles'] !== false) <input id="horaIngresoMI" type="time" class="clearBorder form-control" name="horaIngresoMI" value="{{$resConSVKC[$indices['miercoles']]->horaIngreso}}"> @endif 
                                        </td>
                                        <td class="td td5">
                                            @if($indices['miercoles'] !== false) <input id="kmSalidaMI"  type="number" class="clearBorder form-control" name="kmSalidaMI" value="{{$resConSVKC[$indices['miercoles']]->kmSalida}}"> @endif 
                                        </td>
                                        <td class="td td6">
                                            @if($indices['miercoles'] !== false) <input id="kmIngresoMI"  type="number" class="clearBorder form-control" name="kmIngresoMI" value="{{$resConSVKC[$indices['miercoles']]->kmIngreso}}"> @endif 
                                        </td>
                                        <td class="td td7">
                                            @if($indices['miercoles'] !== false) <input id="combustibleSalidaMI"  type="number" class="clearBorder form-control" name="combustibleSalidaMI" value="{{$resConSVKC[$indices['miercoles']]->combustibleSalida}}"> @endif 
                                        </td>
                                        <td class="td td8">
                                            @if($indices['miercoles'] !== false)<input id="combustibleIngresoMI"  type="number" class="clearBorder form-control conteo" name="combustibleIngresoMI" value="{{$resConSVKC[$indices['miercoles']]->combustibleIngreso}}"> @endif 
                                        </td>
                                        <td class="td td9">
                                            @if($indices['miercoles'] !== false)  
                                                @foreach($usuarios as $usuario)
                                                    @if($usuario->id == $resConSVKC[$indices['miercoles']]->choferSalida)
                                                        <input id="choferSalidaMI" class="clearBorder" value="{{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} ">
                                                    @endif  
                                                @endforeach 
                                            @endif 
                                        </td>
                                        <td class="td td10">
                                            @if($indices['miercoles'] !== false)  
                                                @foreach($usuarios as $usuario)
                                                    @if($usuario->id == $resConSVKC[$indices['miercoles']]->choferIngreso)
                                                    <input id="choferIngresoMI" class="clearBorder" value="{{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}}">
                                                    @endif  
                                                @endforeach 
                                            @endif  
                                        </td>
                                        <td class="td td11">
                                            @if($indices['miercoles'] !== false)  
                                                @foreach($usuarios as $usuario)
                                                    @if($usuario->id == $resConSVKC[$indices['miercoles']]->guardaSalida)
                                                        <input id="guardaSalidaMI" class="clearBorder" value="{{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}}">
                                                    @endif  
                                                @endforeach 
                                            @endif  
                                        </td>
                                        <td class="td td12">
                                            @if($indices['miercoles'] !== false)  
                                                @foreach($usuarios as $usuario)
                                                    @if($usuario->id == $resConSVKC[$indices['miercoles']]->guardaIngreso)
                                                        <input id="guardaIngresoMI" class="clearBorder" value="{{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}}">
                                                    @endif  
                                                @endforeach 
                                            @endif  
                                        </td>  
                                    </tr> 
                                    <!--JUEVES -->
                                    <tr>
                                        <td class="td td1">JUEVES</td>
                                        <td class="td td2">
                                            @if($indices['jueves'] !== false)<input id="fechaSalidaJ" type="date" class="clearBorder form-control" name="fechaSalidaJ" value="{{$resConSVKC[$indices['jueves']]->fecha}}"> @endif
                                        </td>
                                        <td class="td td3">
                                            @if($indices['jueves'] !== false)<input id="horaSalidaJ" type="time" class="clearBorder form-control" name="horaSalidaJ"  value="{{$resConSVKC[$indices['jueves']]->horaSalida}}"> @endif
                                         </td>
                                        <td class="td td4">
                                            @if($indices['jueves'] !== false)<input id="horaIngresoJ" type="time" class="clearBorder form-control" name="horaIngresoJ" value="{{$resConSVKC[$indices['jueves']]->horaIngreso}}"> @endif
                                        </td>
                                        <td class="td td5">
                                            @if($indices['jueves'] !== false)<input id="kmSalidaJ"  type="number" class="clearBorder form-control conteo" name="kmSalidaJ" value="{{$resConSVKC[$indices['jueves']]->kmSalida}}"> @endif
                                        </td>
                                        <td class="td td6">
                                            @if($indices['jueves'] !== false)<input id="kmIngresoJ"  type="number" class="clearBorder form-control conteo" name="kmIngresoJ" value="{{$resConSVKC[$indices['jueves']]->kmIngreso}}"> @endif
                                        </td>
                                        <td class="td td7">
                                            @if($indices['jueves'] !== false)<input id="combustibleSalidaJ"  type="number" class="clearBorder form-control" name="combustibleSalidaJ" value="{{$resConSVKC[$indices['jueves']]->combustibleSalida}}"> @endif
                                        </td>
                                        <td class="td td8">
                                            @if($indices['jueves'] !== false)<input id="combustibleIngresoJ"  type="number" class="clearBorder form-control" name="combustibleIngresoJ" value="{{$resConSVKC[$indices['jueves']]->combustibleIngreso}}">@endif 
                                         </td>
                                        <td class="td td9">
                                            @if($indices['jueves'] !== false)  
                                                @foreach($usuarios as $usuario)
                                                    @if($usuario->id == $resConSVKC[$indices['jueves']]->choferSalida)
                                                        <input id="choferSalidaJ" class="clearBorder" value=" {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}}">
                                                    @endif  
                                                @endforeach 
                                            @endif    
                                        </td>
                                        <td class="td td10"> 
                                            @if($indices['jueves'] !== false)  
                                                @foreach($usuarios as $usuario)
                                                    @if($usuario->id == $resConSVKC[$indices['jueves']]->choferIngreso)
                                                        <input id="choferIngresoJ" class="clearBorder" value=" {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}}">
                                                    @endif  
                                                @endforeach 
                                            @endif  
                                        </td>
                                        <td class="td td11"> 
                                            @if($indices['jueves'] !== false)  
                                                @foreach($usuarios as $usuario)
                                                    @if($usuario->id == $resConSVKC[$indices['jueves']]->guardaSalida)
                                                        <input id="guardaSalidaJ" class="clearBorder" value=" {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}}">
                                                    @endif  
                                                @endforeach 
                                            @endif  
                                        </td>
                                        <td class="td td12"> 
                                            @if($indices['jueves'] !== false)  
                                                @foreach($usuarios as $usuario)
                                                    @if($usuario->id == $resConSVKC[$indices['jueves']]->guardaIngreso)
                                                        <input id="guardaIngresoJ" class="clearBorder" value=" {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}}">
                                                    @endif  
                                                @endforeach 
                                            @endif  
                                        </td>   
                                    </tr> 
                                    <!--VIERNES -->
                                    <tr>
                                        <td class="td td1">VIERNES</td>
                                        <td class="td td2">
                                            @if($indices['viernes'] !== false)<input id="fechaSalidaV" type="date" class="clearBorder form-control" name="fechaSalidaV" value="{{$resConSVKC[$indices['viernes']]->fecha}}"> @endif
                                        </td>
                                        <td class="td td3">
                                            @if($indices['viernes'] !== false)<input id="horaSalidaV" type="time" class="clearBorder form-control" name="horaSalidaV" value="{{$resConSVKC[$indices['viernes']]->horaSalida}}"> @endif
                                        </td>
                                        <td class="td td4">
                                            @if($indices['viernes'] !== false)<input id="horaIngresoV" type="time" class="clearBorder form-control" name="horaIngresoV" value="{{$resConSVKC[$indices['viernes']]->horaIngreso}}"> @endif
                                        </td>
                                        <td class="td td5">
                                            @if($indices['viernes'] !== false)<input id="kmSalidaV"  type="number" class="clearBorder form-control conteo" name="kmSalidaV" value="{{$resConSVKC[$indices['viernes']]->kmSalida}}"> @endif
                                        </td>
                                        <td class="td td6">
                                            @if($indices['viernes'] !== false)<input id="kmIngresoV"  type="number" class="clearBorder form-control conteo" name="kmIngresoV" value="{{$resConSVKC[$indices['viernes']]->kmIngreso}}"> @endif
                                        </td>
                                        <td class="td td7">
                                            @if($indices['viernes'] !== false) <input id="combustibleSalidaV"  type="number" class="clearBorder form-control" name="combustibleSalidaV" value="{{$resConSVKC[$indices['viernes']]->combustibleSalida}}"> @endif
                                        </td>
                                        <td class="td td8">
                                            @if($indices['viernes'] !== false)<input id="combustibleIngresoV"  type="number" class="clearBorder form-control" name="combustibleIngresoV" value="{{$resConSVKC[$indices['viernes']]->combustibleIngreso}}"> @endif
                                        </td>
                                        <td class="td td9">
                                            @if($indices['viernes'] !== false)  
                                                @foreach($usuarios as $usuario)
                                                    @if($usuario->id == $resConSVKC[$indices['viernes']]->choferSalida)
                                                        <input id="choferSalidaV" class="clearBorder" value="{{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}}">
                                                    @endif  
                                                @endforeach 
                                            @endif   
                                        </td>
                                        <td class="td td10"> 
                                            @if($indices['viernes'] !== false)  
                                                @foreach($usuarios as $usuario)
                                                    @if($usuario->id == $resConSVKC[$indices['viernes']]->choferSalida)
                                                        <input id="choferIngresoV" class="clearBorder" value="{{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}}">
                                                    @endif  
                                                @endforeach 
                                            @endif   
                                        </td>
                                        <td class="td td11"> 
                                            @if($indices['viernes'] !== false)  
                                                @foreach($usuarios as $usuario)
                                                    @if($usuario->id == $resConSVKC[$indices['viernes']]->guardaSalida)
                                                        <input id="guardaSalidaV" class="clearBorder" value="{{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}}">
                                                    @endif  
                                                @endforeach 
                                            @endif   
                                        </td>
                                        <td class="td td12">  
                                            @if($indices['viernes'] !== false)  
                                                @foreach($usuarios as $usuario)
                                                    @if($usuario->id == $resConSVKC[$indices['viernes']]->guardaIngreso)
                                                        <input id="guardaIngresoV" class="clearBorder" value="{{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}}">
                                                    @endif  
                                                @endforeach 
                                            @endif   
                                        </td>  
                                    </tr> 
                                    <!--SABADO -->
                                    <tr>
                                        <td class="td td1">SÁBADO</td>
                                        <td class="td td2">
                                            @if($indices['sabado'] !== false)<input id="fechaSalidaS" type="date" class="clearBorder form-control" name="fechaSalidaS" value="{{$resConSVKC[$indices['sabado']]->fecha}}"> @endif
                                        </td>
                                        <td class="td td3">
                                            @if($indices['sabado'] !== false)<input id="horaSalidaS" type="time" class="clearBorder form-control" name="horaSalidaS" value="{{$resConSVKC[$indices['sabado']]->horaSalida}}"> @endif
                                        </td>
                                        <td class="td td4">
                                            @if($indices['sabado'] !== false)<input id="horaIngresoS" type="time" class="clearBorder form-control" name="horaIngresoS" value="{{$resConSVKC[$indices['sabado']]->horaIngreso}}"> @endif
                                         </td>
                                        <td class="td td5">
                                            @if($indices['sabado'] !== false)<input id="kmSalidaS"  type="number" class="clearBorder form-control conteo" name="kmSalidaS" value="{{$resConSVKC[$indices['sabado']]->kmSalida}}"> @endif
                                        </td>
                                        <td class="td td6">
                                            @if($indices['sabado'] !== false)<input id="kmIngresoS"  type="number" class="clearBorder form-control conteo" name="kmIngresoS" value="{{$resConSVKC[$indices['sabado']]->kmIngreso}}"> @endif
                                        </td>
                                        <td class="td td7">
                                            @if($indices['sabado'] !== false)<input id="combustibleSalidaS"  type="number" class="clearBorder form-control" name="combustibleSalidaS" value="{{$resConSVKC[$indices['sabado']]->combustibleSalida}}"> @endif
                                        </td>
                                        <td class="td td8">
                                            @if($indices['sabado'] !== false) <input id="combustibleIngresoS"  type="number" class="clearBorder form-control" name="combustibleIngresoS" value="{{$resConSVKC[$indices['sabado']]->combustibleIngreso}}"> @endif
                                        </td>
                                        <td class="td td9">
                                            @if($indices['sabado'] !== false)  
                                                @foreach($usuarios as $usuario)
                                                    @if($usuario->id == $resConSVKC[$indices['sabado']]->choferSalida)
                                                        <input id="choferSalidaS" class="clearBorder" value=" {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}}" >
                                                    @endif  
                                                @endforeach 
                                            @endif    
                                        </td>
                                        <td class="td td10">
                                            @if($indices['sabado'] !== false)  
                                                @foreach($usuarios as $usuario)
                                                    @if($usuario->id == $resConSVKC[$indices['sabado']]->choferIngreso)
                                                        <input id="choferIngresoS" class="clearBorder" value=" {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}}" >
                                                    @endif  
                                                @endforeach 
                                            @endif     
                                        </td>
                                        <td class="td td11">
                                            @if($indices['sabado'] !== false)  
                                                @foreach($usuarios as $usuario)
                                                    @if($usuario->id == $resConSVKC[$indices['sabado']]->guardaSalida)
                                                        <input id="guardaSalidaS" class="clearBorder" value=" {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}}" >
                                                    @endif  
                                                @endforeach 
                                            @endif    
                                        </td>
                                        <td class="td td12">
                                            @if($indices['sabado'] !== false)  
                                                @foreach($usuarios as $usuario)
                                                    @if($usuario->id == $resConSVKC[$indices['sabado']]->guardaIngreso)
                                                        <input id="guardaIngresoS" class="clearBorder" value="{{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}}" >
                                                    @endif  
                                                @endforeach 
                                            @endif    
                                        </td>    
                                    </tr> 
                                    <!--DOMINGO-->
                                    <tr>
                                        <td class="td td1">DOMINGO</td> 
                                        <td class="td td2">
                                            @if($indices['domingo'] !== false)<input id="fechaSalidaD" type="date" class="clearBorder form-control" name="fechaSalidaD" value="{{$resConSVKC[$indices['domingo']]->fecha}}"> @endif
                                        </td>
                                        <td class="td td3">
                                            @if($indices['domingo'] !== false)<input id="horaSalidaD" type="time" class="clearBorder form-control" name="horaSalidaD"  value="{{$resConSVKC[$indices['domingo']]->horaSalida}}"> @endif
                                        </td>
                                        <td class="td td4">
                                            @if($indices['domingo'] !== false) <input id="horaIngresoD" type="time" class="clearBorder form-control" name="horaIngresoD" value="{{$resConSVKC[$indices['domingo']]->horaIngreso}}"> @endif
                                        </td>
                                        <td class="td td5">
                                            @if($indices['domingo'] !== false)<input id="kmSalidaD"  type="number" class="clearBorder form-control conteo" name="kmSalidaD" value="{{$resConSVKC[$indices['domingo']]->kmSalida}}"> @endif
                                        </td>
                                        <td class="td td6">
                                            @if($indices['domingo'] !== false)<input id="kmIngresoD"  type="number" class="clearBorder form-control conteo" name="kmIngresoD" value="{{$resConSVKC[$indices['domingo']]->kmIngreso}}"> @endif
                                        </td>
                                        <td class="td td7">
                                            @if($indices['domingo'] !== false)<input id="combustibleSalidaD"  type="number" class="clearBorder form-control" name="combustibleSalidaD" value="{{$resConSVKC[$indices['domingo']]->combustibleSalida}}"> @endif
                                        </td>
                                        <td class="td td8">
                                            @if($indices['domingo'] !== false)<input id="combustibleIngresoD"  type="number" class="clearBorder form-control" name="combustibleIngresoD" value="{{$resConSVKC[$indices['domingo']]->combustibleIngreso}}"> @endif
                                        </td>
                                        <td class="td td9">  
                                            @if($indices['domingo'] !== false)  
                                                @foreach($usuarios as $usuario)
                                                    @if($usuario->id == $resConSVKC[$indices['domingo']]->choferSalida)
                                                        <input id="choferSalidaD" class="clearBorder" value=" {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}}" >
                                                    @endif  
                                                @endforeach 
                                            @endif   
                                        </td>
                                        <td class="td td10"> 
                                            @if($indices['domingo'] !== false)  
                                                @foreach($usuarios as $usuario)
                                                    @if($usuario->id == $resConSVKC[$indices['domingo']]->choferIngreso)
                                                    <input id="choferIngresoD" class="clearBorder" value=" {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}}" >
                                                    @endif  
                                                @endforeach 
                                            @endif   
                                        </td>
                                        <td class="td td11">
                                            @if($indices['domingo'] !== false)  
                                                @foreach($usuarios as $usuario)
                                                    @if($usuario->id == $resConSVKC[$indices['domingo']]->guardaSalida)
                                                    <input id="guardaSalidaD" class="clearBorder" value=" {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}}" >
                                                    @endif  
                                                @endforeach 
                                            @endif   
                                        </td>
                                        <td class="td td12">
                                            @if($indices['domingo'] !== false)  
                                                @foreach($usuarios as $usuario)
                                                    @if($usuario->id == $resConSVKC[$indices['domingo']]->guardaIngreso)
                                                    <input id="guardaIngresoD" class="clearBorder" value=" {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}}" >
                                                    @endif  
                                                @endforeach 
                                            @endif   
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
                                    <button class="btn bg-malibu-beach btn-lg pull-left" onclick="window.location='{{ url('indexDesactivadoSE', $placa) }}'">
                                        <i class="fas fa-angle-double-left" >Regresar</i>
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