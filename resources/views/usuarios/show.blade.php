@extends('welcome')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script> 
    <link href="/css/sweetAlert2Style.css" rel="stylesheet" />
    <style type="text/css">    
    </style>
    <script>
        $(document).ready(function(){  
            inicioLicencia();
            inicioProcedencia();
        }); 
        function inicioProcedencia(){ 
            $.get('/buscarProcedencia/{{ $user[0]->tipoId }}', function(data)
                {
                    var descripcion; 
                    if("{{ $user[0]->descripcion }}" == "{{ $user[0]->tallerCedula }}"){  
                        $("#descripcion").val('{{ $user[0]->taller }}');
                    }
                    else if("{{ $user[0]->descripcion }}" == "{{ $user[0]->gasolineraCedula }}"){  
                        $("#descripcion").val('{{ $user[0]->gasolinera }}');
                    }
                    else if("{{ $user[0]->descripcion }}" == "{{ $user[0]->departamentoId }}"){  
                        $("#descripcion").val('{{ $user[0]->departamento }}');
                    }  
                    $("#descripcion").html(descripcion); 
            });
        }  
        function inicioLicencia(){
            if("{{$licencias->count()}}" > 0){
                document.getElementById("licenciasi").checked = true;
                document.getElementById("licenciano").disabled = true;
                document.getElementById('licenciaDin').style.display='inline-block'; 
                crearSelect();
            }else{
                document.getElementById("licenciano").checked = true;
                document.getElementById("licenciasi").disabled = true;
                document.getElementById('licenciaDin').style.display='none'; 
            } 
        }
        var contador = 0; 
        //creacion de licencias dinamicas 
        function crearSelect(){ 
            //creamos cada opción para el select tipo de licencia 
            var options = ["seleccione", "A1", "A2", "A3", "B1", "B2", "B3", "B4"]; 
            if("{{$licencias->count()}}" > 0 && contador == 0){ 
                $.each(@json($licencias), function(index, item) {  
                    var licenciaDinamic =document.getElementById("licenciaDinamic");  
                    //creamos un div row y dos div columns
                    var fila = document.createElement("div")
                    fila.setAttribute("class", "row fila" + contador);  
                    var columna1 = document.createElement("div")
                    columna1.setAttribute("class", "col-md-4" ); 
                    var columna2 = document.createElement("div")
                    columna2.setAttribute("class", "col-md-4" );  
                    fila.appendChild(columna1);
                    fila.appendChild(columna2); 
                    //creamos un hr licenciaDinamic
                    var hr1 = document.createElement("hr");
                    columna1.appendChild(hr1);
                    var hr2 = document.createElement("hr");
                    columna2.appendChild(hr2); 

                    //creamos un label para el select tipo de licencia  y lo adjuntamos a la columna 1
                    var labelTipo = document.createElement("label"); 
                    labelTipo.setAttribute("for",'selectTipo'+contador);
                    labelTipo.innerHTML = "Tipo de licencia:";
                    columna1.appendChild(labelTipo);   

                    var inputTipo = document.createElement("input");  
                    inputTipo.type = 'text'; 
                    inputTipo.setAttribute("class", "form-control tipo" ); 
                    $(inputTipo).prop('readonly',true); 
                    $(inputTipo).val(item['tipo']);
  
                    columna1.appendChild(inputTipo);    
                   
                    //creamos el label para vencimiento y lo adjuntamos a la columna 2
                    var labelFecha = document.createElement("label"); 
                    labelFecha.setAttribute("for",'selectFecha'+contador);
                    labelFecha.innerHTML = "Vencimiento:";
                    columna2.appendChild(labelFecha); 
                    //creamos el input vencimiento y lo adjuntamos a la columna 2
                    var inputFecha = document.createElement("input");  
                    inputFecha.type = 'text';
                    inputFecha.setAttribute("class", "form-control vencimiento" );
                    inputFecha.id = 'selectFecha'+contador;
                    $(inputFecha).prop('readonly',true); 
                    $(inputFecha).val(item['vencimiento']);
                    columna2.appendChild(inputFecha);       
                    licenciaDinamic.appendChild(fila);  
                    contador++;
                });  
            }    
        }
    </script>
</head>
<body>     
    <div class="tab-content">
        <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
            <div class="main-card mb-3 card">
                <div class="card-body"><h5 class="card-title">Perfil De Usuario</h5>
                    <form class="">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="exampleEmail11" class="">id</label>
                                    <input name="id" id="id" value="{{ $user[0]->id }}" type="email" class="form-control" readonly>
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="examplePassword11" class="">Email</label>
                                    <input name="email" id="email" value="{{ $user[0]->email }}" type="text" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="form-row">
                            <div class="col-md-5">
                                <div class="position-relative form-group">
                                    <label for="exampleCity" class=""> Nombre </label>
                                    <input name="Nombre" id="Nombre" type="text" class="form-control" value="{{ $user[0]->primerNombre }} {{ $user[0]->segundoNombre }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="position-relative form-group">
                                    <label for="exampleState" class="">  Apellidos </label>
                                    <input name="state" id="exampleState" type="text" class="form-control" value="{{ $user[0]->primerApellido }} {{ $user[0]->segundoApellido }}" readonly>
                                </div>
                            </div>  
                        </div>
                        <div class="divider"></div>
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="exampleCity" class=""> Teléfono </label>
                                    <input name="city" id="exampleCity" type="text" class="form-control" value="{{ $user[0]->telefono }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="exampleState" class=""> Tipo De Usuario </label>
                                    @foreach($tipoUsuario as $item)
                                        @if($item->id == $user[0]->tipoId)  
                                            <input name="state" id="exampleState" type="text" class="form-control" value="{{$item->name}}" readonly>
                                        @endif 
                                    @endforeach 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="exampleZip" class=""> Departamento </label>    
                                    <input name="descripcion" id="descripcion" class="form-control" value="" readonly> 
                            </div>
                            </div>
                        </div>
                        <div class="divider"></div> 
                        <div class="form-group" id="licencia">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="position-relative form-group">
                                        <div id="licencia">  
                                            <label for="licencia"  style="color: black;">¿Licencia?: </label>    
                                            <input type="radio"  id="licenciasi" name="licencia" class="licencia" value="si" >Sí 
                                            <input type="radio"  id="licenciano" name="licencia" class="licencia" value="no" >No
                                        </div> 
                                    </div>
                                </div> 
                                <div class="col-md-8" id="licenciaDin"> 
                                    <div class="position-relative form-group">
                                        <div id="licenciaDinamic"></div> 
                                    </div>
                                </div> 
                            </div> 
                        </div>                        
                    </form>
                </div>
            </div> 
        </div> 
    </div>   
</body>
</html>
@endsection 