@extends('welcome')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script> 
    <link href="/css/sweetAlert2Style.css" rel="stylesheet" />
    <style type="text/css">
        .alert {
            display:inline-block;
        }
        .columna2, .columna { 
            width: 100%;
            padding: 20px; 
        }
    </style>
    <script> 
        window.onload=inicioProcedencia();
        $(document).ready(function(){
            procedencia();
            editarUsuario(); 
            licencia();
            vencimiento(); 
            window.onload=inicioLicencia();
        });     
        function editarUsuario(){
            $(".editar").click(function(){
                var tipoLicencia = []; 
                var selectTipo = document.querySelectorAll('.selectTipo'); 
                for (var i = 0; i < selectTipo.length; i++) {   
                    if(selectTipo[i].value != ''){
                        tipoLicencia.push(selectTipo[i].value);
                    } 
                }  
                var vencimiento = []; 
                var vencimientos = document.querySelectorAll('.vencimiento'); 
                for (var i = 0; i < vencimientos.length; i++) {  
                    if(vencimientos[i].value != ''){
                        vencimiento.push(vencimientos[i].value);
                    } 
                }  
                console.log(tipoLicencia, vencimiento);
                var id = $('#id').val();
                var primerNombre = $('#primerNombre').val();
                var segundoNombre = $('#segundoNombre').val();
                var primerApellido = $('#primerApellido').val();
                var segundoApellido = $('#segundoApellido').val();
                var telefono = $('#telefono').val();
                var email = $('#email').val(); 
                var tipoUsuario = $('#tipoUsuario').val();
                var descripcion = $('#descripcion').val();    
                
                var licencia =  $('input:radio[name=licencia]:checked').val(); 
                if(licencia == "si"){
                    if(tipoLicencia == "" || vencimiento == "" && tipoLicencia.length != vencimiento.length){
                        var descripcion=" <div class='alert alert-danger alert-dismissable'>"+
                                        "       <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>"+
                                        "           &times;"+
                                        "       </button> "+
                                        "        Por favor seleccione tipo de licencia e ingrese fecha de vencimiento"+    
                                        "   </div>";

                        $("#parent").html(descripcion);  
                    } 
                }
                if(tipoLicencia != "" && vencimiento != "" && tipoLicencia.length == vencimiento.length || licencia =="no"){    
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
                                url: "/editarUser/"+id, 
                                type: 'POST', 
                                statusCode: {
                                    302: function() { 
                                        setTimeout("location.href='/'", 100); 
                                    }
                                },
                                data: {
                                    "id" : id,
                                    "primerNombre" :primerNombre,
                                    "segundoNombre" :segundoNombre,
                                    "primerApellido" :primerApellido,
                                    "segundoApellido" :segundoApellido,
                                    "telefono" :telefono,
                                    "email" :email, 
                                    "tipoUsuario" : tipoUsuario,
                                    "descripcion" :descripcion,  
                                    "tipoLicencia" :tipoLicencia,
                                    "vencimiento" :vencimiento,
                                    "licencia": licencia,
                                    _token: '{{csrf_token()}}' 
                                },
                                success: function(data) {
                                    if($.isEmptyObject(data.errors)){ 
                                        Swal.fire({
                                            title: "¡Actualizado!",  
                                            type: 'success',
                                            showCancelButton: false,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'Aceptar'
                                        }).then(function() {
                                            setTimeout("location.href='/User'", 100); 
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
        function inicioProcedencia(){ 
            $.get('/buscarProcedencia/{{ $user[0]->tipoId }}', function(data)
                {
                    var descripcion;
                    var validar = false;
                    if("{{ $user[0]->descripcion }}" == "{{ $user[0]->tallerCedula }}"){
                        //console.log("entro a primer taller");
                        descripcion += '<option value="{{ $user[0]->tallerCedula }}">'+"{{ $user[0]->taller }}"+'</option>';
                        validar = true;
                    }
                    else if("{{ $user[0]->descripcion }}" == "{{ $user[0]->gasolineraCedula }}"){
                        //console.log("entro a primer gasolinera");
                        descripcion += '<option value="{{ $user[0]->gasolineraCedula }}">'+"{{ $user[0]->gasolinera }}"+'</option>';
                        validar = true;
                    }
                    else if("{{ $user[0]->descripcion }}" == "{{ $user[0]->departamentoId }}"){
                        //console.log("entro a primer departa");
                        descripcion += '<option value="{{ $user[0]->departamentoId }}">'+"{{ $user[0]->departamento }}"+'</option>';
                    } 
                    for (var i=0; i<data.length;i++){  
                        if((data[i].CedulaJuridica != undefined) && (data[i].CedulaJuridica != "{{ $user[0]->descripcion }}"))
                        { 
                            //console.log("entro a segundo taller");
                            descripcion+='<option value="'+data[i].CedulaJuridica+'">'+data[i].nombre+'</option>';
                        }
                        else if((data[i].cedulaJuridica != undefined) && (data[i].cedulaJuridica != "{{ $user[0]->descripcion }}"))
                        { 
                            //console.log("entro a segunda gasolinera");
                            descripcion+='<option value="'+data[i].cedulaJuridica+'">'+data[i].nombre+'</option>';
                        }  
                        else if( (data[i].id != undefined) && (data[i].id != "{{ $user[0]->descripcion }}") && ( validar == false)){  
                            //console.log("entro a segundo departa");
                            descripcion += '<option value="'+data[i].id+'">'+data[i].nombreDeparta+'</option>';
                        } 
                    } 
                    $("#descripcion").html(descripcion);
            });
        }
        function inicioLicencia(){
            if("{{$licencias->count()}}" > 0){
                document.getElementById("licenciasi").checked = true;
                document.getElementById('licenciaDin').style.display='inline-block'; 
                crearSelect();
            }else{
                document.getElementById("licenciano").checked = true;
                document.getElementById('licenciaDin').style.display='none'; 
            } 
        }
        function procedencia(){
            $("#tipoUsuario").change(function()
            {
                var idTipoUsuario = $(this).val();
                $.get('/buscarProcedencia/'+idTipoUsuario, function(data)
                {
                    var descripcion = '<option value="">Seleccione</option>'
                        for (var i=0; i<data.length;i++){
                            if((data[i].id != undefined) && (data[i].nombreDeparta != undefined)){ 
                                descripcion+='<option value="'+data[i].id+'">'+data[i].nombreDeparta+'</option>';
                            }
                            if(data[i].cedulaJuridica != undefined)
                            {
                                descripcion+='<option value="'+data[i].cedulaJuridica+'">'+data[i].nombre+'</option>';
                            }if(data[i].CedulaJuridica != undefined)
                            {
                                descripcion+='<option value="'+data[i].CedulaJuridica+'">'+data[i].nombre+'</option>';
                            }
                        }  
                        $("#descripcion").html(descripcion);
                });
            });
        }
        function licencia(){
            $("#licencia").click(function(){
                $('input[name="vencimiento"]').attr("placeholder","Seleccionar"); 
                var licencia =  $('input:radio[name=licencia]:checked').val();  
                if(licencia == "si"){ 
                    document.getElementById('licenciaDin').style.display='inline-block';
                    crearSelect();
                }else if(licencia == "no"){ 
                    document.getElementById('licenciaDin').style.display='none';   
                    const myNode = document.getElementById("licenciaDinamic");
                    while (myNode.firstChild) {
                        myNode.removeChild(myNode.lastChild);
                    }
                } 
            });
        }
        function deleteRow(index){
            var elements = document.getElementsByClassName("fila"+index);
            while(elements.length > 0){
                elements[0].parentNode.removeChild(elements[0]);
            } 
        }
        function vencimiento(){
             $("#vencimiento").datepicker({
                dateFormat: 'dd/mm/yy',
                numberOfMonths: 1,
                minDate: 0, 
                changeMonth: true,
                changeYear: true, 
            });
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
                    var columna3 = document.createElement("div")
                    columna3.setAttribute("class", "col-md-2" );  
                    fila.appendChild(columna1);
                    fila.appendChild(columna2);
                    fila.appendChild(columna3);
                    //creamos un hr licenciaDinamic
                    var hr1 = document.createElement("hr");
                    columna1.appendChild(hr1);
                    var hr2 = document.createElement("hr");
                    columna2.appendChild(hr2);
                    var hr3 = document.createElement("hr");
                    columna3.appendChild(hr3);

                    //creamos un label para el select tipo de licencia  y lo adjuntamos a la columna 1
                    var labelTipo = document.createElement("label"); 
                    labelTipo.setAttribute("for",'selectTipo'+contador);
                    labelTipo.innerHTML = "Tipo de licencia:";
                    columna1.appendChild(labelTipo);   

                    var selectTipo = document.createElement("select");  
                    selectTipo.setAttribute("class", "form-control selectTipo" );
                    selectTipo.id = 'selectTipo'+contador;
                    columna1.appendChild(selectTipo);  

                    for (var i = 0; i < options.length; i++) {  
                        var option = document.createElement("option");
                        option.setAttribute("class", "form-control" ); 
                        option.value = i == 0 ? '' : options[i];
                        option.text = options[i]; 
                        selectTipo.appendChild(option);
                    }
                    $(selectTipo).val(item['tipo']);
                   
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
                    $(inputFecha).datepicker({
                        dateFormat: 'dd/mm/yy',
                        numberOfMonths: 1,
                        minDate: 0,
                        changeMonth: true,
                        changeYear: true,   
                    });
                    $(inputFecha).val(item['vencimiento']);
                    columna2.appendChild(inputFecha);     

                    var br = document.createElement("br");
                    columna3.appendChild(br);  

                    var btn = document.createElement("button");  
                    btn.setAttribute("onclick", 'deleteRow('+contador+')');
                    btn.setAttribute("class", "form-control btn btn-danger" );
                    btn.appendChild(document.createTextNode("Borrar")); 
                    columna3.appendChild(btn);  
                    licenciaDinamic.appendChild(fila);  
                    contador++;
                });  
            } else {
                var licenciaDinamic =document.getElementById("licenciaDinamic"); 

                //creamos un div row y dos div columns
                var fila = document.createElement("div")
                fila.setAttribute("class", "row fila" + contador);  
                var columna1 = document.createElement("div")
                columna1.setAttribute("class", "col-md-4" ); 
                var columna2 = document.createElement("div")
                columna2.setAttribute("class", "col-md-4" ); 
                var columna3 = document.createElement("div")
                columna3.setAttribute("class", "col-md-2" );  
                fila.appendChild(columna1);
                fila.appendChild(columna2);
                fila.appendChild(columna3);
                //creamos un hr licenciaDinamic
                var hr1 = document.createElement("hr");
                columna1.appendChild(hr1);
                var hr2 = document.createElement("hr");
                columna2.appendChild(hr2);
                var hr3 = document.createElement("hr");
                columna3.appendChild(hr3);
                //creamos un label para el select tipo de licencia  y lo adjuntamos a la columna 1
                var labelTipo = document.createElement("label"); 
                labelTipo.setAttribute("for",'selectTipo'+contador);
                labelTipo.innerHTML = "Tipo de licencia:";
                columna1.appendChild(labelTipo);   

                var selectTipo = document.createElement("select");  
                    selectTipo.setAttribute("class", "form-control selectTipo" );
                    selectTipo.id = 'selectTipo'+contador;
                    columna1.appendChild(selectTipo); 
                for (var i = 0; i < options.length; i++) {
                    var option = document.createElement("option");
                    option.setAttribute("class", "form-control" ); 
                    option.value = i == 0 ? '' : options[i];
                    option.text = options[i];
                    selectTipo.appendChild(option);
                }
                
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
                $(inputFecha).datepicker({
                    dateFormat: 'dd/mm/yy',
                    numberOfMonths: 1,
                    minDate: 0,
                    changeMonth: true,
                    changeYear: true,  
                });
                columna2.appendChild(inputFecha);

                var br = document.createElement("br");
                columna3.appendChild(br);  

                var btn = document.createElement("button");  
                    btn.setAttribute("onclick", 'deleteRow('+contador+')');
                    btn.setAttribute("class", "form-control btn btn-danger" );
                    btn.appendChild(document.createTextNode("Borrar")); 
                    columna3.appendChild(btn);  
                    licenciaDinamic.appendChild(fila);  
                contador++;
            }   
        }
    </script>
</head>
<body > 
    <div class="row">
        <div class="col-md-10">
            <div id="parent">   
            </div> 
        </div> 
    </div> 
    <div class="tab-content">
        <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Editar Usuario</h5>   
                    <div class="form-row">
                        <div class="col-md-5">
                            <div class="position-relative form-group">
                                <label for="id"    style="color: black;">{{ __('Cédula: ') }}</label> 
                                <input id="id" type="text" class="form-control" name="id" value="{{ $user[0]->id}}" required autofocus readonly> 
                            </div>
                        </div> 
                    </div> 
                    <div class="form-row">   
                        <div  class="col-md-3">
                            <div class="position-relative form-group">
                                <label for="primerNombre"    style="color: black;">{{ __('Primer Nombre: ') }}</label>
                                <input id="primerNombre" type="text" class="form-control{{ $errors->has('primerNombre') ? ' is-invalid' : '' }}" name="primerNombre" value="{{ $user[0]->primerNombre }}" required autofocus>
                            </div> 
                        </div>  
                        <div  class="col-md-3">
                            <div class="position-relative form-group">
                                <label for="segundoNombre"    style="color: black;">{{ __('Segundo Nombre: ') }}</label>
                                <input id="segundoNombre" type="text" class="form-control{{ $errors->has('segundoNombre') ? ' is-invalid' : '' }}" name="segundoNombre" value="{{  $user[0]->segundoNombre }}" autofocus>
                            </div> 
                        </div>  
                        <div  class="col-md-3">
                            <div class="position-relative form-group">
                                <label for="primerApellido"    style="color: black;">{{ __('Primer Apellido: ') }}</label>
                                <input id="primerApellido" type="text" class="form-control{{ $errors->has('primerApellido') ? ' is-invalid' : '' }}" name="primerApellido" value="{{ $user[0]->primerApellido }}" required autofocus>
                            </div> 
                        </div>  
                        <div  class="col-md-3">
                            <div class="position-relative form-group">
                                <label for="segundoApellido"    style="color: black;">{{ __('Segundo Apellido: ') }}</label>
                                <input id="segundoApellido" type="text" class="form-control{{ $errors->has('segundoApellido') ? ' is-invalid' : '' }}" name="segundoApellido" value="{{ $user[0]->segundoApellido }}" required autofocus>
                            </div>  
                        </div>  
                    </div> 
                    <div class="form-row">    
                        <div  class="col-md-3">
                            <div class="position-relative form-group">
                                <label for="telefono"    style="color: black;">{{ __('Teléfono: ') }}</label>
                                <input id="telefono" type="text" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefono" value="{{ $user[0]->telefono }}" required autofocus>
                            </div> 
                        </div>  
                        <div  class="col-md-4">
                            <div class="position-relative form-group">
                                <label for="email"    style="color: black;">{{ __('Email: ') }}</label>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user[0]->email }}" required>
                            </div> 
                        </div>   
                    </div> 
                    <div class="form-row">  
                        <div  class="col-md-3">
                            <div class="position-relative form-group">
                                <label    style="color: black;">{{ __('Tipo de Usuario: ') }}</label> 
                                <select class="form-control" id="tipoUsuario" name="tipoUsuario">  
                                    <option value="{{ $user[0]->tipoId }}">{{ $user[0]->tipo }} </option>
                                    @foreach($tipoUsuario as $item)
                                        @if($item->id != $user[0]->tipoId) 
                                            <option value="{{$item->id}}" required> {{$item->name}} </option>
                                        @endif 
                                    @endforeach
                                </select> 
                            </div> 
                        </div>  
                        <div  class="col-md-4">
                            <div class="position-relative form-group">
                                <label for="descripcion"   >Departamento: </label>  
                                <select name="descripcion" id="descripcion" class="form-control" >
                                    <option value=""></option>
                                </select>
                            </div> 
                        </div>   
                    </div>   
                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="position-relative form-group">
                                <div id="licencia">  
                                    <label for="licencia"  style="color: black;">¿Licencia?: </label>    
                                    <input type="radio"  id="licenciasi" name="licencia" class="licencia" value="si">Sí 
                                    <input type="radio"  id="licenciano" name="licencia" class="licencia" value="no">No
                                </div> 
                            </div>
                        </div> 
                        <div class="col-md-8" id="licenciaDin"> 
                            <div class="position-relative form-group">
                                <input type="button" id="btn_agregar" value="+ Nueva licencia" onclick="crearSelect()" class="btn btn-info" > 
                                <div id="licenciaDinamic"></div> 
                            </div>
                        </div> 
                    </div>  
                    <div >  
                        <a href="{{ route('User.index') }}" class="btn bg-malibu-beach">
                            <i class="fas fa-angle-double-left" style="color:black">Regresar</i> 
                        </a>  
                        <button class="editar pull-right btn bg-happy-green">
                            <i class="fas fa-sync-alt" style="color:black">{{ __('Actualizar') }}</i> 
                        </button> 
                    </div> 
                </div>   
            </div>   
        </div>   
    </div> 
    
</body>
</html>
@endsection 