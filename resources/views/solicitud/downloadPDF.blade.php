<!DOCTYPE html>  
<html lang="en"> 
  <head>
    <title>{{ $title }}</title> 
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet" /> -->
    <link href="css/PDF_style.css" rel="stylesheet" />
  </head> 
  <body>
    <main role="main" class="container">   
      <div id="header">
        <h3 class="titulos">MUNICIPALIDAD DE NICOYA</h3> 
        <h4 class="titulos">Préstamo Vehicular</h4> 
        <h4 class="titulos">Departamento de Servicios Generales</h4> 
        <h5 class="titulos">Teléfono: 2685 6450 Ext: 8722 <a class="borrar">.............</a> serviciosgenerales@municoya.go.cr</h5>  
        <img class="img" src="images/logo.jpg" alt="Logo">
      </div>  
      <h2 class="titulos">Comprobante De Solicitud</h2>               
      <h3 class="subtitulo">Motivo de la Solicitud: </h3>
        <p>{{$descripcion}}</p> 
      <h3 class="subtitulo">Destino del Viaje: </h3>
        <p>{{$destino}}</p>
      <table> 
            <tr class="tr-titulo">  
                <th colspan="5"><h4 class="subtitulo">Datos de Solicitante</h4></th> 
            </tr>
            <tr class="tr-subtitulo">
                <th>Cédula</th>
                <th>Nombre Completo</th>
                <th>Departamento</th>
                <th>Teléfono</th>
                <th>Email</th>
            </tr> 
            <tr>
                <td>{{$id}}</th>
                <td>{{$primerNombre}} {{$segundoNombre}} {{$primerApellido}} {{$segundoApellido }}</td> 
                <td>{{$departamento }}</td> 
                <td>{{$telefono }}</td> 
                <td>{{$email }}</td> 
            </tr>
            <tr class="tr-titulo">  
                <th colspan="5"><h3 class="titulos">Datos De Viaje</h3>    </th> 
            </tr> 
            <tr class="tr-subtitulo">  
                <th>Número de Personas</th>
                <th>Vehículo</th>
                <th colspan="2">Fecha de Entrega</th> 
                <th>Fecha de Devolución</th>
            </tr> 
            <tr>  
                <td>{{$numPersonas }}</td> 
                <td>{{$placa }}</td> 
                <td colspan="2">{{ date('d/m/Y', strtotime($fechaEntrega)) }} - {{ $horaEntrega}}</td> 
                <td>{{ date('d/m/Y', strtotime($fechaDevolucion)) }} - {{$horaDevolucion}}</td>  
            </tr>   
      </table>    
      <div id="footer"> 
        <center><h3 class="titulos">SISCOVE</h3> </center>
      </div>  
    </main>
  </body> 
</html>
<thead>