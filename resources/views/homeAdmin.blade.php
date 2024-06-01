@extends('welcome') 

@section('content') 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/toastr.min.css" rel="stylesheet"> 
    <style> 
        .responsive {
            width: 105%; 
            height: auto;
            border-radius: 2%; 
        }
        .imgUser{
            width: 50%; 
            height: auto;
            border-radius: 2%; 
            display:block;
            margin:auto;
        }
    </style>
    <script src="/js/jquery-3.3.1.min.js" type="text/javascript"></script>  
    <script src="/js/toastr.min.js" type="text/javascript"> </script>    
    <script>
        $(document).ready(function(){  
            notificar();   
            chart();
        });
        function notificar(){
            $.each(@json($arrayMensajes), function(i, item) {   
                if(item != null){  
                    toastr.error(
                        item, "Aviso.",{
                        timeOut:10000, 
                        closeButton: true, 
                        progressBar: true,
                        preventDuplicates: true,
                        }
                    );   
                } 
            });       
        }; 
        function chart(){
            var presupuesto = @json($arrayFiltros);  
            {
                if(presupuesto[0] != null) {progressBar('#MecaCarProgres1', '#MecaCarProgres2', "#mecanicaCarroLabel1", "#mecanicaCarroLabel2", presupuesto[0]);}
                if(presupuesto[1] != null) {progressBar('#mecanicaMoto1', '#mecanicaMoto2', "#mecanicaMotoLabel1", "#mecanicaMotoLabel2", presupuesto[1]);}
                if(presupuesto[2] != null) {progressBar('#repuestoCarro1', '#repuestoCarro2', "#repuestoCarroLabel1", "#repuestoCarroLabel2", presupuesto[2]);}
                if(presupuesto[3] != null) {progressBar('#repuestoMoto1', '#repuestoMoto2', "#repuestoMotoLabel1", "#repuestoMotoLabel2", presupuesto[3]);}
                if(presupuesto[4] != null) {progressBar('#lavado1', '#lavado2', "#lavadoLabel1", "#lavadoLabel2", presupuesto[4]);}
                if(presupuesto[5] != null) {progressBar('#aireAcondicionado1', '#aireAcondicionado2', "#aireAcondicionadoLabel1", "#aireAcondicionadoLabel2", presupuesto[5]);}
                if(presupuesto[6] != null) {progressBar('#administracionComb1', '#administracionComb2', "#administracionCombLabel1", "#administracionCombLabel2", presupuesto[6]);}
                if(presupuesto[7] != null) {progressBar('#desarrolloUrbanoComb1', '#desarrolloUrbanoComb2', "#desarrolloUrbanoCombLabel1", "#desarrolloUrbanoCombLabel2", presupuesto[7]);}
                if(presupuesto[8] != null) {progressBar('#direccionTecnicaComb1', '#direccionTecnicaComb2', "#direccionTecnicaCombLabel1", "#direccionTecnicaCombLabel2", presupuesto[8]);}
            }
            {
                
                if(presupuesto[0] !=null) {crearChart(presupuesto[0], 'mecanicaCarro', 0);}
                if(presupuesto[1] !=null) {crearChart(presupuesto[1], 'mecanicaMoto', 1);}
                if(presupuesto[2] !=null) {crearChart(presupuesto[2], 'repuestoCarro', 2);}
                if(presupuesto[3] !=null) {crearChart(presupuesto[3], 'repuestoMoto', 3);}
                if(presupuesto[4] !=null) {crearChart(presupuesto[4], 'lavado', 4);}
                if(presupuesto[5] !=null) {crearChart(presupuesto[5], 'aireAcondicionado', 5);}
                if(presupuesto[6] !=null) { crearChart(presupuesto[6], 'administracionComb', 6);}
                if(presupuesto[7] !=null) { crearChart(presupuesto[7], 'desarrolloUrbanoComb', 7);}
                if(presupuesto[8] !=null) { crearChart(presupuesto[8], 'direccionTecnicaComb', 8);}
            }
        } 
        function crearChart(presupuesto, grafico, indice){
            var gastado = ((presupuesto.gastado * 100) / presupuesto.montoEstablecido).toFixed(2);   
            var restante = ((presupuesto.montoRestante * 100) / presupuesto.montoEstablecido).toFixed(2);  
            var ctx = document.getElementById(grafico).getContext("2d");  
            
            var color = '#1A87F4';
            if(indice == 1 || indice == 3){
                color = presupuesto.montoRestante >= 500000 ? '#1A87F4': '#F53235';
            }else if(indice == 4){
                color = presupuesto.montoRestante >= 75000 ? '#1A87F4': '#F53235';
            }else if(indice == 0 || indice == 2 || indice == 5 || indice == 6 || indice == 7 || indice == 8){
                color = presupuesto.montoRestante >= 100000 ? '#1A87F4': '#F53235';
            } 
            var data = {
                labels: [ 
                    'Gastado', 
                    'Restante'
                ],
                datasets: [{
                    data: [
                        gastado, 
                        restante
                    ],
                    backgroundColor: [
                        color,
                        '#FFFFFF'
                    ],
                    borderColor: [
                        color,
                        '#1A87F4'
                    ]
                }]
            }; 
            var options = {
                hover: {
                    mode: 'label',
                },
                tooltips: {
                    enabled: true,
                    callbacks: {
                        label: function(tooltipItem, data) {  
                            var label = data.labels[tooltipItem.index];
                            var val = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                            return label + ': ' + val + '%'; 
                        }
                    } 
                },
                responsive: true, 
                cutoutPercentage: 80,
                legend: {
                    display: true,
                    reverse: true 
                },  
                animation: {
                    onComplete: function (event) { 
                        var xCenter = this.chart.width/2;
                        var yCenter = this.chart.height/1.7;

                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'middle';

                        var progressLabel = gastado + '%';
                        ctx.font = '20px Helvetica';
                        ctx.fillStyle = 'black';
                        ctx.fillText(progressLabel, xCenter, yCenter);
                    },
                    animateRotate: true,
                    render: false,
                }
            };  
            Chart.defaults.global.tooltips.enabled = false; 
            new Chart(ctx, {
                type: 'doughnut',
                data: data,
                options: options,
                
            });
        } 
        function progressBar(progress1, progress2, label1, label2, presupuesto){
            //calculo de porcentaje
            var x = (presupuesto.montoRestante * 100) / presupuesto.montoEstablecido; 
            var y = 100 - x;
            /*progress gastado*/$(progress1).attr('aria-valuenow', y).css('width', y+'%');
            /*progress restante*/$(progress2).attr('aria-valuenow', x).css('width', x+'%');
            /*label gastado*/$(label1).text(presupuesto.gastado); 
            /*label gastado*/$(label2).text(presupuesto.montoRestante);
        }
    </script>
</head>
<body>  
    <div class="row"> 
        <div class="col-md-6"> 
            <div class="main-card mb-3 card">
                <div class="row"> 
                    <div class="col-md-8" style="text-align:center;"> 
                        <img src="/images/muni2.jpg" class="responsive">   
                    </div>
                    <div class="col-md-4">
                        <img src="/images/user.png" class="card-img imgUser">  
                        <h5 class="card-title" style="text-align:center;">Cantidad de usuarios registrados</h5>
                        <h2 style="font-weight: bold; color: green; text-align: center;">{{$arrayFiltros[9]}}</h2> 
                    </div>
                </div>  
            </div> 
        </div>
        <div class="col-md-3">   
            <div class="main-card mb-3 card"> 
                <canvas id="mecanicaCarro"></canvas>  
                <div class="card-body">
                    <h5 class="card-title" style="text-align:center;">Presupuesto mecanica para carros</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-left">Gastado</h5>
                            <h6 class="text-left"><label id="mecanicaCarroLabel1"></label></h6> 
                        </div>
                        <div class="col-md-6"> 
                            <h5 class="text-right">Restante</h5>
                            <h6 class="text-right"><label id="mecanicaCarroLabel2"></label></h6> 
                        </div>
                    </div> 
                    <div class="mb-3 progress">
                        <div class="progress-bar progress-bar-animated bg-danger progress-bar-striped" role="progressbar" aria-valuemin="0" aria-valuemax="100" id="MecaCarProgres1"></div>
                        <div class="progress-bar progress-bar-animated bg-success progress-bar-striped" role="progressbar" aria-valuemin="0" aria-valuemax="100" id="MecaCarProgres2"></div> 
                    </div>
                </div> 
            </div> 
        </div> 
        <div class="col-md-3">
            <div class="main-card mb-3 card">
                <canvas id="mecanicaMoto"></canvas>  
                <div class="card-body">
                    <h5 class="card-title" style="text-align:center;">Presupuesto mecanica para motos</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-left">Gastado</h5>
                            <h6 class="text-left"><label id="mecanicaMotoLabel1"></label></h6> 
                        </div>
                        <div class="col-md-6"> 
                            <h5 class="text-right">Restante</h5>
                            <h6 class="text-right"><label id="mecanicaMotoLabel2"></label></h6> 
                        </div> 
                    </div> 
                    <div class="mb-3 progress">
                        <div class="progress-bar progress-bar-animated bg-danger progress-bar-striped" role="progressbar" aria-valuemin="0" aria-valuemax="100" id="mecanicaMoto1"></div>
                        <div class="progress-bar progress-bar-animated bg-success progress-bar-striped" role="progressbar" aria-valuemin="0" aria-valuemax="100" id="mecanicaMoto2"></div> 
                    </div>
                </div> 
            </div> 
        </div>  
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="main-card mb-3 card"> 
                <canvas id="repuestoCarro"></canvas>  
                <div class="card-body">
                    <h5 class="card-title" style="text-align:center;">Presupuesto repuesto para carros</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-left">Gastado</h5>
                            <h6 class="text-left"><label id="repuestoCarroLabel1"></label></h6> 
                        </div>
                        <div class="col-md-6"> 
                            <h5 class="text-right">Restante</h5>
                            <h6 class="text-right"><label id="repuestoCarroLabel2"></label></h6> 
                        </div>  
                    </div> 
                    <div class="mb-3 progress">
                        <div class="progress-bar progress-bar-animated bg-danger progress-bar-striped" role="progressbar"aria-valuemin="0" aria-valuemax="100" id="repuestoCarro1"></div>
                        <div class="progress-bar progress-bar-animated bg-success progress-bar-striped" role="progressbar"aria-valuemin="0" aria-valuemax="100" id="repuestoCarro2"></div> 
                    </div>
                </div>  
            </div> 
        </div>    
        <div class="col-md-3">
            <div class="main-card mb-3 card">
                <canvas id="repuestoMoto"></canvas>  
                <div class="card-body">
                    <h5 class="card-title" style="text-align:center;">Presupuesto respuesto para motos</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-left">Gastado</h5>
                            <h6 class="text-left"><label id="repuestoMotoLabel1"></label></h6> 
                        </div>
                        <div class="col-md-6"> 
                            <h5 class="text-right">Restante</h5>
                            <h6 class="text-right"><label id="repuestoMotoLabel2"></label></h6> 
                        </div> 
                    </div> 
                    <div class="mb-3 progress">
                        <div class="progress-bar progress-bar-animated bg-danger progress-bar-striped" role="progressbar"aria-valuemin="0" aria-valuemax="100" id="repuestoMoto1"></div>
                        <div class="progress-bar progress-bar-animated bg-success progress-bar-striped" role="progressbar"aria-valuemin="0" aria-valuemax="100" id="repuestoMoto2"></div> 
                    </div>
                </div>  
            </div> 
        </div>   
        <div class="col-md-3">
            <div class="main-card mb-3 card">  
                <canvas id="lavado"></canvas> 
                <div class="card-body">
                    <h5 class="card-title" style="text-align:center;">Presupuesto para lavado</h5> 
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-left">Gastado</h5>
                            <h6 class="text-left"><label id="lavadoLabel1"></label></h6> 
                        </div>
                        <div class="col-md-6"> 
                            <h5 class="text-right">Restante</h5>
                            <h6 class="text-right"><label id="lavadoLabel2"></label></h6> 
                        </div> 
                    </div> 
                    <div class="mb-3 progress">
                        <div class="progress-bar progress-bar-animated bg-danger progress-bar-striped" role="progressbar"aria-valuemin="0" aria-valuemax="100" id="lavado1"></div>
                        <div class="progress-bar progress-bar-animated bg-success progress-bar-striped" role="progressbar"aria-valuemin="0" aria-valuemax="100" id="lavado2"></div> 
                    </div>
                </div>  
            </div> 
        </div>   
        <div class="col-md-3">
            <div class="main-card mb-3 card"> 
                <canvas id="aireAcondicionado"></canvas>  
                <div class="card-body">
                    <h5 class="card-title" style="text-align:center;">Presupuesto para aires acondicionados</h5> 
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-left">Gastado</h5>
                            <h6 class="text-left"><label id="aireAcondicionadoLabel1"></label></h6> 
                        </div>
                        <div class="col-md-6"> 
                            <h5 class="text-right">Restante</h5>
                            <h6 class="text-right"><label id="aireAcondicionadoLabel2"></label></h6> 
                        </div> 
                    </div> 
                    <div class="mb-3 progress">
                        <div class="progress-bar progress-bar-animated bg-danger progress-bar-striped" role="progressbar"aria-valuemin="0" aria-valuemax="100" id="aireAcondicionado1"></div>
                        <div class="progress-bar progress-bar-animated bg-success progress-bar-striped" role="progressbar"aria-valuemin="0" aria-valuemax="100" id="aireAcondicionado2"></div> 
                    </div>
                </div>  
            </div> 
        </div>   
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="main-card mb-3 card">
                <canvas id="administracionComb"></canvas>  
                <div class="card-body">
                    <h5 class="card-title" style="text-align:center;">Presupuesto para administración combustible</h5> 
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-left">Gastado</h5>
                            <h6 class="text-left"><label id="administracionCombLabel1"></label></h6> 
                        </div>
                        <div class="col-md-6"> 
                            <h5 class="text-right">Restante</h5>
                            <h6 class="text-right"><label id="administracionCombLabel2"></label></h6> 
                        </div>
                    </div> 
                    <div class="mb-3 progress"> 
                        <div class="progress-bar progress-bar-animated bg-danger progress-bar-striped" role="progressbar"aria-valuemin="0" aria-valuemax="100" id="administracionComb1"></div>
                        <div class="progress-bar progress-bar-animated bg-success progress-bar-striped" role="progressbar"aria-valuemin="0" aria-valuemax="100" id="administracionComb2"></div> 
                    </div>
                </div> 
            </div> 
        </div>   
        <div class="col-md-3">
            <div class="main-card mb-3 card">
                <canvas id="desarrolloUrbanoComb"></canvas>  
                <div class="card-body">
                    <h5 class="card-title" style="text-align:center;">Presupuesto para desarrollo urbano combustible</h5> 
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-left">Gastado</h5>
                            <h6 class="text-left"><label id="desarrolloUrbanoCombLabel1"></label></h6> 
                        </div>
                        <div class="col-md-6"> 
                            <h5 class="text-right">Restante</h5>
                            <h6 class="text-right"><label id="desarrolloUrbanoCombLabel2"></label></h6> 
                        </div>
                    </div> 
                    <div class="mb-3 progress">
                        <div class="progress-bar progress-bar-animated bg-danger progress-bar-striped" role="progressbar"aria-valuemin="0" aria-valuemax="100" id="desarrolloUrbanoComb1"></div>
                        <div class="progress-bar progress-bar-animated bg-success progress-bar-striped" role="progressbar"aria-valuemin="0" aria-valuemax="100" id="desarrolloUrbanoComb2"></div> 
                    </div>
                </div> 
            </div> 
        </div>   
        <div class="col-md-3">
            <div class="main-card mb-3 card"> 
                <canvas id="direccionTecnicaComb"></canvas>  
                <div class="card-body">
                    <h5 class="card-title" style="text-align:center;">Presupuesto para dirección técnica combustible</h5> 
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-left">Gastado</h5>
                            <h6 class="text-left"><label id="direccionTecnicaCombLabel1"></label></h6> 
                        </div>
                        <div class="col-md-6"> 
                            <h5 class="text-right">Restante</h5>
                            <h6 class="text-right"><label id="direccionTecnicaCombLabel2"></label></h6> 
                        </div>
                    </div> 
                    <div class="mb-3 progress">
                        <div class="progress-bar progress-bar-animated bg-danger progress-bar-striped" role="progressbar"aria-valuemin="0" aria-valuemax="100" id="direccionTecnicaComb1"></div>
                        <div class="progress-bar progress-bar-animated bg-success progress-bar-striped" role="progressbar"aria-valuemin="0" aria-valuemax="100" id="direccionTecnicaComb2"></div> 
                    </div>
                </div> 
            </div> 
        </div>   
    </div>  
</body>
</html>
@endsection 