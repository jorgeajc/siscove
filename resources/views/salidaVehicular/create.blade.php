@extends('welcome')
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head> 
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />        
        <link rel="stylesheet" href="/css/sweetAlert2Style.css"/> 
        <link rel="stylesheet" href="/css/pretty-checkbox.min.css"/>
        <link rel="stylesheet" href="/css/salidadiseno.css"/> 
        <link rel="stylesheet" href="/css/toastr.min.css"/>   

        <script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script> 
        <script type="text/javascript" src="/js/bootstrap.min.js"></script> 
        <script type="text/javascript" src="/js/jquery.maskedinput.js"></script>   
        <script type="text/javascript" src="/js/eventSalidaVehicular.js"></script> 
        <script type="text/javascript" src="/js/toastr.min.js"> </script>             

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css"/>    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>  
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
                            <h2 class="titulo">REGISTROS DE INGRESO Y SALIDA DE VEHÍCULOS</h2> 
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
                                            <select class="form-control" name="oficinaSolicitante" id="oficinaSolicitante">
                                                <option value=" "> -SELECCIONE- </option>
                                                @foreach($oficinas as $oficina)
                                                <option value="{{$oficina->id}}">  {{$oficina->nombreDeparta}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>  
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group row">
                                        <label for="placa" class=" col-form-label text-md-right subtitulo">Placa:</label> 
                                        <div class="col-md-8">
                                            <input id="placa" type="text" class="form-control" name="placa" value="{{$placa}}" readonly> 
                                        </div>
                                    </div>  
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group row">
                                        <label for="fechaAutorizacionSalida" class=" col-form-label text-md-right subtitulo">Fecha Autorización Paso De Vehículo:  Del</label> 
                                        <div class="col-md-5"> 
                                            <input id="fechaAutorizacionSalida" type="text" class="form-control datepicker" name="fechaAutorizacionSalida">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group row">
                                        <label for="fechaAutorizacionIngreso" class="col-form-label text-md-right subtitulo" >{{ __('al ') }}</label> 
                                        <div class="col-md-10">
                                            <input id="fechaAutorizacionIngreso" type="text" class="form-control datepicker" name="fechaAutorizacionIngreso">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <br> 
                        <div class="card-heading text-center">
                            <h3 > Control de Kilometraje y Combustible</h3>  
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
                                                <input type="checkbox" id="checkL" /> 
                                                <div class="state p-success">
                                                    <label>LUNES</label>
                                                </div>
                                            </div> 
                                        </td>
                                        <td class="td td2">
                                            <input id="fechaSalidaL" type="text" readonly class="clearBorder form-control datepicker"  name="fechaSalidaL">
                                        </td>
                                        <td class="td td3">
                                            <input id="horaSalidaL" type="text" class="clearBorder form-control timepicker" readonly name="horaSalidaL">
                                        </td>
                                        <td class="td td4">
                                            <input id="horaIngresoL" type="text" class="clearBorder form-control timepicker" readonly name="horaIngresoL">
                                        </td>
                                        <td class="td td5">
                                            <input id="kmSalidaL"  type="number" class="clearBorder form-control conteo" name="kmSalidaL">
                                        </td>
                                        <td class="td td6">
                                            <input id="kmIngresoL"  type="number" class="clearBorder form-control conteo" name="kmIngresoL">
                                        </td>
                                        <td class="td td7">
                                            <input id="combustibleSalidaL"  type="number" class="clearBorder form-control" name="combustibleSalidaL">
                                        </td>
                                        <td class="td td8">
                                            <input id="combustibleIngresoL"  type="number" class="clearBorder form-control" name="combustibleIngresoL">
                                        </td>
                                        <td class="td td9">
                                            <select name="choferSalidaL" id="choferSalidaL" class="clearBorder">
                                                <option value=""> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario) 
                                                    <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                @endforeach
                                            </select> 
                                        </td>
                                        <td class="td td10">
                                            <select name="choferIngresoL" id="choferIngresoL" class="clearBorder">
                                                <option value=""> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario)
                                                <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                @endforeach
                                            </select> 
                                        </td>
                                        <td class="td td11">
                                            <select name="guardaSalidaL" id="guardaSalidaL" class="clearBorder">
                                                <option value=""> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario)
                                                <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                @endforeach
                                            </select>  
                                        </td>
                                        <td class="td td12">
                                            <select name="guardaIngresoL" id="guardaIngresoL" class="clearBorder">
                                                <option value=""> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario)
                                                <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                @endforeach
                                            </select>  
                                        </td>  
                                    </tr> 
                                    <!--MARTES -->
                                    <tr>
                                        <td class="td td1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="checkbox" id="checkMA"/> 
                                                <div class="state p-success">
                                                    <label>MARTES</label>
                                                </div>
                                            </div> 
                                        </td>
                                        <td class="td td2">
                                            <input id="fechaSalidaMA" type="text" readonly class="clearBorder form-control datepicker" name="fechaSalidaMA">
                                        </td>
                                        <td class="td td3">
                                            <input id="horaSalidaMA" type="text" class="clearBorder form-control timepicker" readonly name="horaSalidaMA" >
                                        </td>
                                        <td class="td td4">
                                            <input id="horaIngresoMA" type="text" class="clearBorder form-control timepicker" readonly name="horaIngresoMA">
                                        </td>
                                        <td class="td td5">
                                            <input id="kmSalidaMA"  type="number" class="clearBorder form-control conteo" name="kmSalidaMA">
                                        </td>
                                        <td class="td td6">
                                            <input id="kmIngresoMA"  type="number" class="clearBorder form-control conteo" name="kmIngresoMA">
                                        </td>
                                        <td class="td td7">
                                            <input id="combustibleSalidaMA"  type="number" class="clearBorder form-control" name="combustibleSalidaMA">
                                        </td>
                                        <td class="td td8">
                                            <input id="combustibleIngresoMA"  type="number" class="clearBorder form-control" name="combustibleIngresoMA">
                                        </td>
                                        <td class="td td9">
                                            <select name="choferSalidaMA" id="choferSalidaMA" class="clearBorder">
                                                <option value=""> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario)
                                                <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                @endforeach
                                            </select> 
                                        </td>
                                        <td class="td td10"> 
                                            <select name="choferIngresoMA" id="choferIngresoMA" class="clearBorder">
                                                <option value=""> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario)
                                                <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                @endforeach
                                            </select> 
                                        </td>
                                        <td class="td td11"> 
                                            <select name="guardaSalidaMA" id="guardaSalidaMA" class="clearBorder">
                                                <option value=""> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario)
                                                <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                @endforeach
                                            </select> 
                                        </td>
                                        <td class="td td12">
                                            <select name="guardaIngresoMA" id="guardaIngresoMA" class="clearBorder">
                                                <option value=""> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario)
                                                <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                @endforeach
                                            </select> 
                                        </td>   
                                    </tr> 
                                    <!--MIERCOLES -->
                                    <tr>
                                        <td class="td td1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="checkbox" id="checkMI"/> 
                                                <div class="state p-success">
                                                    <label>MIERCOLES</label>
                                                </div>
                                            </div> 
                                        </td>
                                        <td class="td td2">
                                            <input id="fechaSalidaMI" type="text" readonly class="clearBorder form-control datepicker" name="fechaSalidaMI">
                                        </td>
                                        <td class="td td3">
                                            <input id="horaSalidaMI" type="text" class="clearBorder form-control timepicker" readonly name="horaSalidaMI" >
                                        </td>
                                        <td class="td td4">
                                            <input id="horaIngresoMI" type="text" class="clearBorder form-control timepicker" readonly name="horaIngresoMI">
                                        </td>
                                        <td class="td td5">
                                            <input id="kmSalidaMI"  type="number" class="clearBorder form-control" name="kmSalidaMI">
                                        </td>
                                        <td class="td td6">
                                            <input id="kmIngresoMI"  type="number" class="clearBorder form-control" name="kmIngresoMI">
                                        </td>
                                        <td class="td td7">
                                            <input id="combustibleSalidaMI"  type="number" class="clearBorder form-control" name="combustibleSalidaMI">
                                        </td>
                                        <td class="td td8">
                                            <input id="combustibleIngresoMI"  type="number" class="clearBorder form-control conteo" name="combustibleIngresoMI">
                                        </td>
                                        <td class="td td9">
                                            <select name="choferSalidaMI" id="choferSalidaMI" class="clearBorder">
                                                <option value=""> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario)
                                                <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                @endforeach
                                            </select> 
                                        </td>
                                        <td class="td td10">
                                            <select name="choferIngresoMI" id="choferIngresoMI" class="clearBorder">
                                                <option value=""> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario)
                                                <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                @endforeach
                                            </select> 
                                        </td>
                                        <td class="td td11">
                                            <select name="guardaSalidaMI" id="guardaSalidaMI" class="clearBorder">
                                                <option value=""> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario)
                                                <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                @endforeach
                                            </select> 
                                        </td>
                                        <td class="td td12">
                                            <select name="guardaIngresoMI" id="guardaIngresoMI" class="clearBorder">
                                                <option value=""> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario)
                                                <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                @endforeach
                                            </select> 
                                        </td>  
                                    </tr> 
                                    <!--JUEVES -->
                                    <tr>
                                        <td class="td td1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="checkbox" id="checkJ"/> 
                                                <div class="state p-success">
                                                    <label>JUEVES</label>
                                                </div>
                                            </div> 
                                        </td>
                                        <td class="td td2">
                                            <input id="fechaSalidaJ" type="text" readonly class="clearBorder form-control datepicker" name="fechaSalidaJ">
                                        </td>
                                        <td class="td td3">
                                            <input id="horaSalidaJ" type="text" class="clearBorder form-control timepicker" readonly name="horaSalidaJ" >
                                        </td>
                                        <td class="td td4">
                                            <input id="horaIngresoJ" type="text" class="clearBorder form-control timepicker" readonly name="horaIngresoJ">
                                        </td>
                                        <td class="td td5">
                                            <input id="kmSalidaJ"  type="number" class="clearBorder form-control conteo" name="kmSalidaJ">
                                        </td>
                                        <td class="td td6">
                                            <input id="kmIngresoJ"  type="number" class="clearBorder form-control conteo" name="kmIngresoJ">
                                        </td>
                                        <td class="td td7">
                                            <input id="combustibleSalidaJ"  type="number" class="clearBorder form-control" name="combustibleSalidaJ">
                                        </td>
                                        <td class="td td8">
                                            <input id="combustibleIngresoJ"  type="number" class="clearBorder form-control" name="combustibleIngresoJ">
                                        </td>
                                        <td class="td td9">
                                            <select name="choferSalidaJ" id="choferSalidaJ" class="clearBorder">
                                                <option value=""> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario)
                                                <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                @endforeach
                                            </select> 
                                        </td>
                                        <td class="td td10">
                                            <select name="choferIngresoJ" id="choferIngresoJ" class="clearBorder">
                                                <option value=""> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario)
                                                <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                @endforeach
                                            </select> 
                                        </td>
                                        <td class="td td11">
                                            <select name="guardaSalidaJ" id="guardaSalidaJ" class="clearBorder">
                                                <option value=""> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario)
                                                <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                @endforeach
                                            </select> 
                                        </td>
                                        <td class="td td12">
                                            <select name="guardaIngresoJ" id="guardaIngresoJ" class="clearBorder">
                                                <option value=""> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario)
                                                <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                @endforeach
                                            </select> 
                                        </td>   
                                    </tr> 
                                    <!--VIERNES -->
                                    <tr>
                                        <td class="td td1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="checkbox" id="checkV"/> 
                                                <div class="state p-success">
                                                    <label>VIERNES</label>
                                                </div>
                                            </div> 
                                        </td>
                                        <td class="td td2">
                                            <input id="fechaSalidaV" type="text" readonly class="clearBorder form-control datepicker" name="fechaSalidaV">
                                        </td>
                                        <td class="td td3">
                                            <input id="horaSalidaV" type="text" class="clearBorder form-control timepicker" readonly name="horaSalidaV" >
                                        </td>
                                        <td class="td td4">
                                            <input id="horaIngresoV" type="text" class="clearBorder form-control timepicker" readonly name="horaIngresoV">
                                        </td>
                                        <td class="td td5">
                                            <input id="kmSalidaV"  type="number" class="clearBorder form-control conteo" name="kmSalidaV">
                                        </td>
                                        <td class="td td6">
                                            <input id="kmIngresoV"  type="number" class="clearBorder form-control conteo" name="kmIngresoV">
                                        </td>
                                        <td class="td td7">
                                            <input id="combustibleSalidaV"  type="number" class="clearBorder form-control" name="combustibleSalidaV">
                                        </td>
                                        <td class="td td8">
                                            <input id="combustibleIngresoV"  type="number" class="clearBorder form-control" name="combustibleIngresoV">
                                        </td>
                                        <td class="td td9">
                                            <select name="choferSalidaV" id="choferSalidaV" class="clearBorder">
                                                <option value=""> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario)
                                                <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                @endforeach
                                            </select> 
                                        </td>
                                        <td class="td td10">
                                            <select name="choferIngresoV" id="choferIngresoV" class="clearBorder">
                                                <option value=""> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario)
                                                <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                @endforeach
                                            </select> 
                                        </td>
                                        <td class="td td11">
                                            <select name="guardaSalidaV" id="guardaSalidaV" class="clearBorder">
                                                <option value=""> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario)
                                                <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                @endforeach
                                            </select> 
                                        </td>
                                        <td class="td td12">
                                            <select name="guardaIngresoV" id="guardaIngresoV" class="clearBorder">
                                                <option value=""> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario)
                                                <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                @endforeach
                                            </select> 
                                        </td>  
                                    </tr> 
                                    <!--SABADO -->
                                    <tr>
                                        <td class="td td1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="checkbox" id="checkS"/> 
                                                <div class="state p-success">
                                                    <label>SÁBADO</label>
                                                </div>
                                            </div> 
                                        </td>
                                        <td class="td td2">
                                            <input id="fechaSalidaS" type="text" readonly class="clearBorder form-control datepicker" name="fechaSalidaS">
                                        </td>
                                        <td class="td td3">
                                            <input id="horaSalidaS" type="text" class="clearBorder form-control timepicker" readonly name="horaSalidaS">
                                        </td>
                                        <td class="td td4">
                                            <input id="horaIngresoS" type="text" class="clearBorder form-control timepicker" readonly name="horaIngresoS">
                                        </td>
                                        <td class="td td5">
                                            <input id="kmSalidaS"  type="number" class="clearBorder form-control conteo" name="kmSalidaS">
                                        </td>
                                        <td class="td td6">
                                            <input id="kmIngresoS"  type="number" class="clearBorder form-control conteo" name="kmIngresoS">
                                        </td>
                                        <td class="td td7">
                                            <input id="combustibleSalidaS"  type="number" class="clearBorder form-control" name="combustibleSalidaS">
                                        </td>
                                        <td class="td td8">
                                            <input id="combustibleIngresoS"  type="number" class="clearBorder form-control" name="combustibleIngresoS">
                                        </td>
                                        <td class="td td9">
                                            <select name="choferSalidaS" id="choferSalidaS" class="clearBorder">
                                                <option value=""> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario)
                                                <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                @endforeach
                                            </select> 
                                        </td>
                                        <td class="td td10">
                                            <select name="choferIngresoS" id="choferIngresoS" class="clearBorder">
                                                <option value=""> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario)
                                                <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                @endforeach
                                            </select> 
                                        </td>
                                        <td class="td td11">
                                            <select name="guardaSalidaS" id="guardaSalidaS" class="clearBorder">
                                                <option value=""> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario)
                                                <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                @endforeach
                                            </select> 
                                        </td>
                                        <td class="td td12">
                                            <select name="guardaIngresoS" id="guardaIngresoS" class="clearBorder">
                                                <option value=""> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario)
                                                <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                @endforeach
                                            </select> 
                                        </td>    
                                    </tr> 
                                    <!--DOMINGO-->
                                    <tr>
                                        <td class="td td1">
                                            <div class="pretty p-switch p-fill">
                                                <input type="checkbox" id="checkD"/> 
                                                <div class="state p-success">
                                                    <label>DOMINGO</label>
                                                </div>
                                            </div> 
                                        </td> 
                                        <td class="td td2">
                                            <input id="fechaSalidaD" type="text" readonly class="clearBorder form-control datepicker" name="fechaSalidaD">
                                        </td>
                                        <td class="td td3">
                                            <input id="horaSalidaD" type="text" class="clearBorder form-control timepicker" readonly name="horaSalidaD" >
                                        </td>
                                        <td class="td td4">
                                            <input id="horaIngresoD" type="text" class="clearBorder form-control timepicker" readonly name="horaIngresoD">
                                        </td>
                                        <td class="td td5">
                                            <input id="kmSalidaD"  type="number" class="clearBorder form-control conteo" name="kmSalidaD">
                                        </td>
                                        <td class="td td6">
                                            <input id="kmIngresoD"  type="number" class="clearBorder form-control conteo" name="kmIngresoD">
                                        </td>
                                        <td class="td td7">
                                            <input id="combustibleSalidaD"  type="number" class="clearBorder form-control" name="combustibleSalidaD">
                                        </td>
                                        <td class="td td8">
                                            <input id="combustibleIngresoD"  type="number" class="clearBorder form-control" name="combustibleIngresoD">
                                        </td>
                                        <td class="td td9"> 
                                            <select name="choferSalidaD" id="choferSalidaD" class="clearBorder">
                                                <option value=""> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario)
                                                <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                @endforeach
                                            </select> 
                                        </td>
                                        <td class="td td10"> 
                                            <select name="choferIngresoD" id="choferIngresoD" class="clearBorder">
                                                <option value=""> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario)
                                                <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                @endforeach
                                            </select> 
                                        </td>
                                        <td class="td td11">
                                            <select name="guardaSalidaD" id="guardaSalidaD" class="clearBorder">
                                                <option value=""> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario)
                                                <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                @endforeach
                                            </select> 
                                        </td>
                                        <td class="td td12">
                                            <select name="guardaIngresoD" id="guardaIngresoD" class="clearBorder">
                                                <option value=""> -SELECIONE- </option>
                                                @foreach($usuarios as $usuario)
                                                <option value="{{$usuario->id}}"> {{$usuario->id}} {{$usuario->primerNombre}} {{$usuario->primerApellido}} {{$usuario->segundoApellido}} </option>
                                                @endforeach
                                            </select> 
                                        </td>  
                                    </tr> 
                                    <!--TOTAL-->
                                    <tr class="trT">
                                        <td colspan="4"></td> 
                                        <td class="td" colspan="2">
                                            <label class="col-form-label text-md-right">Total de Kilometros recorridos</label>                                  
                                            <input id="totalKm" type="number" class="form-control clearBorder" name="totalKm" value="0" readonly>
                                        </td>
                                        <td colspan="6"></td>  
                                    </tr> 
                                </tbody>
                            </table>  
                        </div>
                        <div class="form-horizontal controlCA">
                            <div class="row">  
                                <!-- CONTROL DE ACCESORIOS SALIDA VEHÍCULO -->
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
                                            <input type="radio" name="radio" value="si" checked>
                                            <div class="state p-success-o">
                                                <i class="icon mdi mdi-check"></i>
                                                <label>SI</label>
                                            </div>
                                        </div>
                                        <div class="pretty p-icon p-curve p-tada">
                                            <input type="radio" name="radio" value="no">
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
                                                <input type="radio" name="encendedor" value="si" checked>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="encendedor" value="no">
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
                                                <input type="radio" name="alfombras" value="si" checked>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="alfombras" value="no">
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
                                                <input type="radio" name="antena" value="si" checked>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="antena" value="no">
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
                                                <input type="radio" name="espejoExt" value="si" checked>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="espejoExt" value="no">
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
                                                <input type="radio" name="espejoInt" value="si" checked>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="espejoInt" value="no">
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
                                                <input type="radio" name="extintor" value="si" checked>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="extintor" value="no">
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
                                                <input type="radio" name="gata" value="si" checked>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="gata" value="no">
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
                                                <input type="radio" name="llaveRana" value="si" checked>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="llaveRana" value="no">
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
                                                <input type="radio" name="llaveRepuesto" value="si" checked>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="llaveRepuesto" value="no">
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
                                                <input type="radio" name="triangulos" value="si" checked>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="triangulos" value="no">
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
                                            <textarea id="observacionesS" rows="6" cols="40" name="descripcion"></textarea>
                                        </div>     
                                    </div>  
                                </div>
                                <!-- CONTROL DE CARROCERÍA VEHÍCULO -->
                                <div class="col-lg-6 controlCarroceria">
                                    <br> 
                                    <div class="form-group row"> 
                                        <div class="col-md-7">
                                            <h4 class="titulo text-center">CONTROL DE CARROCERÍA VEHÍCULO</h4>  
                                            <h5 class="subtitulo text-center">Señalamiento de daños exteriores de carrocería</h5>
                                            <img src="/images/vehiculo_inspeccion.jpg" alt="Muni" class="responsive">
                                            <div class="form-group row">
                                                <label  class="col-md-6 text-md-right subtitulo">PUERTA DELANTERA DERECHA</label><br>
                                                <div class="col-md-6"> 
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="puertaDD" value="si">
                                                        <div class="state p-success-o">
                                                            <i class="icon mdi mdi-check"></i>
                                                            <label>SI</label>
                                                        </div>
                                                    </div>
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="puertaDD" value="no" checked>
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
                                                        <input type="radio" name="puertaDI" value="si">
                                                        <div class="state p-success-o">
                                                            <i class="icon mdi mdi-check"></i>
                                                            <label>SI</label>
                                                        </div>
                                                    </div>
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="puertaDI" value="no" checked>
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
                                                        <input type="radio" name="puertaTD" value="si">
                                                        <div class="state p-success-o">
                                                            <i class="icon mdi mdi-check"></i>
                                                            <label>SI</label>
                                                        </div>
                                                    </div>
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="puertaTD" value="no" checked>
                                                        <div class="state p-danger-o">
                                                            <i class="icon mdi mdi-close"></i>
                                                            <label>NO</label>
                                                        </div>
                                                    </div>
                                                </div>     
                                            </div>
                                            <div class="form-group row">
                                                <label  class="col-md-6 text-md-right subtitulo">BUMPER TRASERO</label><br>
                                                <div class="col-md-6"> 
                                                <div class="pretty p-icon p-curve p-tada">
                                                    <input type="radio" name="bumperT" value="si">
                                                    <div class="state p-success-o">
                                                        <i class="icon mdi mdi-check"></i>
                                                        <label>SI</label>
                                                    </div>
                                                </div>
                                                <div class="pretty p-icon p-curve p-tada">
                                                    <input type="radio" name="bumperT" value="no" checked>
                                                    <div class="state p-danger-o">
                                                        <i class="icon mdi mdi-close"></i>
                                                        <label>NO</label>
                                                    </div>
                                                </div>
                                                </div>     
                                            </div> 
                                        </div>
                                        <div class="col-md-5" > 
                                            <div class="form-group row">
                                                <label  class="col-md-6 text-md-right subtitulo">BUMPER DELANTERO</label><br>
                                                <div class="col-md-6"> 
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="bumperD" value="si">
                                                        <div class="state p-success-o">
                                                            <i class="icon mdi mdi-check"></i>
                                                            <label>SI</label>
                                                        </div>
                                                    </div>
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="bumperD" value="no" checked>
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
                                                        <input type="radio" name="guardaBDT" value="si">
                                                        <div class="state p-success-o">
                                                            <i class="icon mdi mdi-check"></i>
                                                            <label>SI</label>
                                                        </div>
                                                    </div>
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="guardaBDT" value="no" checked>
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
                                                        <input type="radio" name="guardaBIT" value="si">
                                                        <div class="state p-success-o">
                                                            <i class="icon mdi mdi-check"></i>
                                                            <label>SI</label>
                                                        </div>
                                                    </div>
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="guardaBIT" value="no" checked>
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
                                                        <input type="radio" name="guardaBID" value="si">
                                                        <div class="state p-success-o">
                                                            <i class="icon mdi mdi-check"></i>
                                                            <label>SI</label>
                                                        </div>
                                                    </div>
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="guardaBID" value="no" checked>
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
                                                        <input type="radio" name="guardaBDD" value="si">
                                                        <div class="state p-success-o">
                                                            <i class="icon mdi mdi-check"></i>
                                                            <label>SI</label>
                                                        </div>
                                                    </div>
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="guardaBDD" value="no" checked>
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
                                                        <input type="radio" name="tapaBaul" value="si">
                                                        <div class="state p-success-o">
                                                            <i class="icon mdi mdi-check"></i>
                                                            <label>SI</label>
                                                        </div>
                                                    </div>
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="tapaBaul" value="no" checked>
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
                                                        <input type="radio" name="tapaMotor" value="si">
                                                        <div class="state p-success-o">
                                                            <i class="icon mdi mdi-check"></i>
                                                            <label>SI</label>
                                                        </div>
                                                    </div>
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="tapaMotor" value="no" checked>
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
                                                        <input type="radio" name="parabrisasT" value="si">
                                                        <div class="state p-success-o">
                                                            <i class="icon mdi mdi-check"></i>
                                                            <label>SI</label>
                                                        </div>
                                                    </div>
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="parabrisasT" value="no" checked>
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
                                                        <input type="radio" name="parabrisasD" value="si">
                                                        <div class="state p-success-o">
                                                            <i class="icon mdi mdi-check"></i>
                                                            <label>SI</label>
                                                        </div>
                                                    </div>
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="parabrisasD" value="no" checked>
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
                                                        <input type="radio" name="puertaTI" value="si">
                                                        <div class="state p-success-o">
                                                            <i class="icon mdi mdi-check"></i>
                                                            <label>SI</label>
                                                        </div>
                                                    </div>
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="puertaTI" value="no" checked>
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
                                                        <input type="radio" name="quicioD" value="si">
                                                        <div class="state p-success-o">
                                                            <i class="icon mdi mdi-check"></i>
                                                            <label>SI</label>
                                                        </div>
                                                    </div>
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="quicioD" value="no" checked>
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
                                                        <input type="radio" name="quicioI" value="si">
                                                        <div class="state p-success-o">
                                                            <i class="icon mdi mdi-check"></i>
                                                            <label>SI</label>
                                                        </div>
                                                    </div>
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="quicioI" value="no" checked>
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
                                                        <input type="radio" name="techo" value="si">
                                                        <div class="state p-success-o">
                                                            <i class="icon mdi mdi-check"></i>
                                                            <label>SI</label>
                                                        </div>
                                                    </div>
                                                    <div class="pretty p-icon p-curve p-tada">
                                                        <input type="radio" name="techo" value="no" checked>
                                                        <div class="state p-danger-o">
                                                            <i class="icon mdi mdi-close"></i>
                                                            <label>NO</label>
                                                        </div>
                                                    </div>
                                                </div>     
                                            </div>  
                                            <div class="form-group row">
                                                <div class="col-md-8"> 
                                                    <label  class="text-md-right subtitulo">OBSERVACIONES</label><br>
                                                    <textarea id="observacionesCarro" rows="6" cols="40"name="descripcion"></textarea>
                                                </div>     
                                            </div> 
                                        </div> 
                                    </div> 
                                </div>
                                <!-- CONTROL DE ACCESORIOS ENTRADA VEHÍCULO -->
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
                                            <input type="radio" name="radioE" value="si" checked>
                                            <div class="state p-success-o">
                                                <i class="icon mdi mdi-check"></i>
                                                <label>SI</label>
                                            </div>
                                        </div>
                                        <div class="pretty p-icon p-curve p-tada">
                                            <input type="radio" name="radioE" value="no">
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
                                                <input type="radio" name="encendedorE" value="si" checked>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="encendedorE" value="no">
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
                                                <input type="radio" name="alfombrasE" value="si" checked>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="alfombrasE" value="no">
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
                                                <input type="radio" name="antenaE" value="si" checked>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="antenaE" value="no">
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
                                                <input type="radio" name="espejoExtE" value="si" checked>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="espejoExtE" value="no">
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
                                                <input type="radio" name="espejoIntE" value="si" checked>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="espejoIntE" value="no">
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
                                                <input type="radio" name="extintorE" value="si" checked>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="extintorE" value="no">
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
                                                <input type="radio" name="gataE" value="si" checked>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="gataE" value="no">
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
                                                <input type="radio" name="llaveRanaE" value="si" checked>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="llaveRanaE" value="no">
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
                                                <input type="radio" name="llaveRepuestoE" value="si" checked>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="llaveRepuestoE" value="no">
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
                                                <input type="radio" name="triangulosE" value="si" checked>
                                                <div class="state p-success-o">
                                                    <i class="icon mdi mdi-check"></i>
                                                    <label>SI</label>
                                                </div>
                                            </div>
                                            <div class="pretty p-icon p-curve p-tada">
                                                <input type="radio" name="triangulosE" value="no">
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
                                            <textarea id="observacionesE" rows="6" cols="40"name="descripcion"></textarea>
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
                                    <button class="agregar btn bg-happy-green btn-lg pull-right">
                                        <i class="fas fa-check-double" >Guardar</i>  
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