@component('mail::message')
    @component('mail::panel')
        <table class="wrapper" width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td align="center">
                    <table class="content" width="100%" cellpadding="0" cellspacing="0"> 
                        <tr> 
                            <td class="body" width="100%" cellpadding="0" cellspacing="0"> 
                                <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td class="content-cell">
                                            <div class="panel panel-success" background="Mecanica carro.jpg">
                                                <div class="container"> 
                                                    <div class="row justify-content-center">
                                                        <div class="col-md-12">
                                                            <div class="card">
                                                                <br>
                                                                @component('mail::panel')
                                                                    <div class="card-heading text-center" align="center">
                                                                        <h4 style="color:black">MUNICIPALIDAD DE NICOYA</h4> 
                                                                        <h4 style="color:black">Prestamo Vehicular</h4> 
                                                                        <h4 style="color:black">Departamento de Servicios Generales</h4> 
                                                                        <h4 style="color:black">Teléfono: 2685 6450 Ext 8722</h4> 
                                                                        <h4 style="color:black">serviciosgenerales@municoya.go.cr</h4> 
                                                                    </div>
                                                                @endcomponent
                                                                <div class="card-body ">
                                                                    <div class="form-horizontal" style="border:ridge black 1.5px"> 
                                                                        <h4 style="color:black" align="center">Respuesta de la solicitud<h4> 
                                                                        <div style="margin-left: 25%"> 
                                                                            <div class="form-group row">
                                                                                <div class="col-md-6">
                                                                                    <p>
                                                                                        <h3>
                                                                                            Señor/a <?php echo e($email->nombreSolicitante); ?> del departamento de <?php echo e($email->departamento); ?>
                                                                                        <br>
                                                                                            La solicitud de un vehículo enviada por su por su persona el día <?php echo e($email->fechaCreacion); ?> 
                                                                                            donde solicita la siguiente información:
                                                                                        <br>
                                                                                            Un vehículo para <?php echo e($email->numPersonas); ?> personas
                                                                                        <br>
                                                                                            Con el motivo: <?php echo e($email->motivo); ?> y destino: <?php echo e($email ->destino); ?>
                                                                                        <br>
                                                                                            Dicha solicitud la hace para utilizar el vehículo desde el día <?php echo e(date('d/m/Y', strtotime($email->fechaEntrega))); ?> y la hora <?php echo e($email->horaEntrega); ?>
                                                                                        <br>
                                                                                            Hasta el <?php echo e(date('d/m/Y', strtotime($email->fechaDevolucion))); ?> a la hora <?php echo e($email->horaDevolucion); ?>                                                
                                                                                        </h3>
                                                                                    </p> 
                                                                                </div>
                                                                            </div>                                             
                                                                        </div> 
                                                                    </div>
                                                                    <br>
                                                                    <div class="form-horizontal" style="border:ridge black 1.5px">  
                                                                        <div style="margin-left: 25%">  
                                                                            <div class="row">
                                                                               
                                                                                <div class="col-lg-6">
                                                                                    <div class="form-group row" > 
                                                                                        <div class="col-md-6"> 
                                                                                            <p>
                                                                                                <h2>
                                                                                                    LA SOLICITUD HA SIDO <?php echo e($email->estado); ?>
                                                                                                </h2>
                                                                                            </p> 
                                                                                        </div> 
                                                                                    </div>
                                                                                </div> 
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                                                </div>
                                                            </div>
                                                        </div>    
                                                    </div>
                                                </div> 
                                            </div> 
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr> 
                    </table>
                </td>
            </tr>
        </table> 
    @endcomponent
@endcomponent