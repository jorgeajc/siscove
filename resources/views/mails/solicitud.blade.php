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
                                                                        <h4 style="color:black" align="center">Datos del Solicitante<h4> 
                                                                        <div style="margin-left: 25%">
                                                                            <div class="form-group row"> 
                                                                                <div class="col-md-6">
                                                                                    <label for="cedula" class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Cédula: ') }}</label>
                                                                                    <?php echo e($email->cedula); ?>
                                                                                </div>
                                                                            </div> 
                                                                            <div class="form-group row">
                                                                                <div class="col-md-6">
                                                                                    <label for="nombreCompleto" class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Nombre Completo: ') }}</label>
                                                                                    <?php echo e($email->nombreSolicitante); ?>
                                                                                </div>
                                                                            </div> 
                                                                            <div class="form-group row">
                                                                                <div class="col-md-6">
                                                                                    <label for="departamento" class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Departamento: ') }}</label>
                                                                                    <?php echo e($email->departamento); ?>
                                                                                </div>
                                                                            </div> 
                                                                            <div class="form-group row">
                                                                                <div class="col-md-4">
                                                                                    <label for="telefono" class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Telefono: ') }}</label>
                                                                                    <?php echo e($email->telefono); ?>
                                                                                </div>
                                                                            </div> 
                                                                            <div class="form-group row">
                                                                                <div class="col-md-6">
                                                                                    <label for="email" class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Email: ') }}</label>
                                                                                    <?php echo e($email->email); ?>
                                                                                </div>
                                                                            </div>                                            
                                                                        </div> 
                                                                    </div>
                                                                    <br>
                                                                    <div class="form-horizontal" style="border:ridge black 1.5px"> 
                                                                        <h4 style="color:black" align="center">Datos del Viaje<h4> 
                                                                        <div style="margin-left: 25%">
                                                                            <div class="form-group row">
                                                                                <div class="col-md-6">
                                                                                    <label for="descripcion" class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Motivo de la Solicitud: ') }}</label> 
                                                                                    <?php echo e($email->motivo); ?>
                                                                                </div>
                                                                            </div>  
                                                                            <div class="form-group row">
                                                                                <div class="col-md-6">
                                                                                    <label for="destino" class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Destino del Viaje: ') }}</label> 
                                                                                    <?php echo e($email ->destino); ?>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-lg-6">
                                                                                    <div class="form-group row">
                                                                                        <div class="col-md-5"> 
                                                                                            <label for="numPersonas" class="col-md-4 col-form-label text-md-right" style="color:black">{{ __('Número de Personas: ') }}</label> 
                                                                                            <?php echo e($email->numPersonas); ?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div> 
                                                                            </div> 
                                                                            <div class="row">
                                                                                <div class="col-lg-6">
                                                                                    <div class="form-group row" > 
                                                                                        <div class="col-md-7"> 
                                                                                            <label class="col-md-4 col-form-label text-md-right" style="color:black">Fecha de Entrega: </label>
                                                                                            <?php echo e( date('d/m/Y', strtotime($email->fechaEntrega))); ?>
                                                                                        </div> 
                                                                                    </div>
                                                                                </div> 
                                                                                <div class="col-lg-6">
                                                                                    <div class="form-group row" > 
                                                                                        <div class="col-md-7"> 
                                                                                            <label class="col-md-4 col-form-label text-md-right" style="color:black">Fecha de Devolución: </label>
                                                                                            <?php echo e(date('d/m/Y', strtotime($email->fechaDevolucion))); ?>
                                                                                        </div> 
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6">
                                                                                    <div class="form-group row" > 
                                                                                        <div class="col-md-6">
                                                                                            <label class="col-md-4 col-form-label text-md-right" style="color:black">Hora de Entrega: </label> 
                                                                                            <?php echo e($email->horaEntrega); ?>
                                                                                        </div> 
                                                                                    </div>
                                                                                </div> 
                                                                                <div class="col-lg-6">
                                                                                    <div class="form-group row" > 
                                                                                        <div class="col-md-6"> 
                                                                                            <label class="col-md-4 col-form-label text-md-right" style="color:black">Hora de Devolución: </label>
                                                                                            <?php echo e($email->horaDevolucion); ?>
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