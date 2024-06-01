@extends('welcome')

@section('content')

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script>  
        <title>Document</title> 
    </head>
    <body>
        <div class="row">
            <div class="col-lg-12"> 
                <div class="card"> 
                    <div class="card-heading text-center">  
                        <a href="{{ route('solicitud.aceptadoRechazado')}}" class="btn bg-malibu-beach">
                            <i class="fas fa-angle-double-left" style="color:black">Regresar</i>  
                        </a> 
                        @if($solicitudB->estado == "Aceptada")
                                <h2  style="color: green;">Solicitud Aceptada</h2> 
                            @else
                                <h2  style="color: red;">Solicitud Rechazada</h2> 
                        @endif
                        <a href="{{route('solicitud.printpdf',$solicitudB->idSolicitud)}}" class="printPDF btn bg-happy-green" target="_blank"><i class="fas fa-download" style="color:black"> DESCARGAR PDF</i></a> 
                    </div>
                <div class="card-body">
                    <div class="form-horizontal" style="border:ridge black 1px">
                        <br>
                        <h3 style="color:black" class="text-center">Datos de Solicitante</h3>
                        <br>
                        <div class="form row" style="margin:1%">
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <h6><label for="cedula" style="color:black">{{ __('Cédula: ') }}</label></h6>
                                    <input id="id" type="text" class="form-control" name="cedula" value="{{$solicitudB->id}}" required autofocus readonly>
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <h6><label for="nombreCompleto" style="color:black">{{ __('Nombre Completo: ') }}</label></h6>
                                    <input id="nombreCompleto" type="text" class="form-control" name="nombreCompleto" value="{{$solicitudB->primerNombre}} {{$solicitudB->segundoNombre}} {{$solicitudB->primerApellido}} {{$solicitudB->segundoApellido }}" required autofocus readonly>
                                </div>
                            </div> 
                        </div> 
                        <div class="form-row" style="margin:1% ">  
                            <div  class="col-md-4">
                                <div class="position-relative form-group">
                                    <h6><label for="departamento" style="color:black">{{ __('Departamento: ') }}</label></h6>
                                    <input id="departamento" type="text" class="form-control" name="departamento" value="{{$solicitudB->departamento }}" required autofocus readonly>
                                </div> 
                            </div>  
                            <div  class="col-md-4">
                                <div class="position-relative form-group">
                                    <h6><label for="telefono"  style="color: black;">{{ __('Teléfono: ') }}</label></h6>
                                    <input id="telefono" type="text" class="form-control" name="telefono" value="{{$solicitudB->telefono }}" required autofocus readonly>
                                </div> 
                            </div> 
                            <div  class="col-md-4">
                                <div class="position-relative form-group">
                                    <h6><label for="email"  style="color: black">{{ __('Email: ') }}</label></h6>
                                    <input id="email" type="text" class="form-control" name="email" value="{{$solicitudB->email }}" required autofocus readonly>
                                </div> 
                            </div>   
                        </div> 
                    </div>
                    <br>
                    <div class="form-horizontal" style="border:ridge black 1px">
                        <br>
                        <h3 style="color:black" class="text-center">Datos del Viaje</h3>
                        <br>
                        <div class="form-group row" style="margin:1%">
                            <h6><label for="descripcion" style="color:black">{{ __('Motivo de la Solicitud: ') }}</label></h6> 
                            <div class="col-md-6">
                                <textarea id="descripcion" type="text" rows="6" cols="8" class="form-control " name="descripcion" value="{{$solicitudB->descripcion}}" required autofocus readonly>{{$solicitudB->descripcion}}</textarea>
                            </div>
                        </div> 
                        <div class="form row" style="margin:1%"> 
                            <div class="col-md-6">
                                <div class="position-relative form-group"> 
                                    <h6><label for="destino" style="color:black">{{ __('Destino del Viaje: ') }}</label></h6> 
                                    <input id="destino" type="text" class="form-control" name="destino" value="{{ $solicitudB->destino}}" required autofocus readonly>
                                </div>
                            </div> 
                            <div class="col-md-3">
                                <div class="position-relative form-group"> 
                                    <h6><label for="numPersonas"  style="color:black">{{ __('Número de Personas: ') }}</label></h6> 
                                    <input id="numPersonas" type="text" class="form-control " name="numPersonas" value="{{$solicitudB->numPersonas}}" required autofocus readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="position-relative form-group"> 
                                    <h6><label style="color:black"> Vehículo: </label></h6>
                                    <input id="placa" type="text" class="form-control " name="placa" value="{{$solicitudB->placa}}" required autofocus readonly>
                                </div>
                            </div> 
                        </div>
                        <div class="form row" style="margin:1%"> 
                            <div class="col-md-3">
                                <div class="position-relative form-group"> 
                                    <h6><label style="color:black">Fecha de Entrega: </label></h6>
                                    <input id="fechaEntrega" type="date" class="form-control " name="fechaEntrega" value="{{$solicitudB->fechaEntrega}}" required autofocus readonly>
                                </div>
                            </div> 
                            <div class="col-md-3">
                                <div class="position-relative form-group"> 
                                    <h6><label style="color:black">Hora de Entrega: </label></h6>
                                    <input id="horaEntrega" type="time" class="form-control " name="horaEntrega" value="{{$solicitudB->horaEntrega}}" required autofocus readonly>
                                </div>
                            </div> 
                            <div class="col-md-3">
                                <div class="position-relative form-group"> 
                                    <h6><label style="color:black">Fecha de Devolución: </label></h6>
                                    <input id="fechaDevolucion" type="date" class="form-control " name="fechaDevolucion" value="{{$solicitudB->fechaDevolucion}}" required autofocus readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group"> 
                                    <h6><label  style="color:black">Hora de Devolución: </label></h6>
                                    <input id="horaDevolucion" type="time" class="form-control " name="horaDevolucion" value="{{$solicitudB->horaDevolucion}}" required autofocus readonly>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <br> 
                </div>
            </div>
        </div> 
    </body>
    </html>
@endsection  