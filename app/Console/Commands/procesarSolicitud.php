<?php

namespace App\Console\Commands;

use App\solicitud;
use Carbon\Carbon;

use Illuminate\Console\Command;

class procesarSolicitud extends Command
{ 
    protected $signature = 'solicitud:procesarSolicitud';
 
    protected $description = 'Verificación de fecha de solicitud';
 
    public function __construct()
    {
        parent::__construct();
    } 
    public function handle()
    { 
        $hoy = Carbon::now("GMT-6");
        $fecha = $hoy->format('Y-m-d');
        $hora = $hoy->format('H:i:s'); 

        $solicitud = solicitud::where("fechaEntrega", $fecha)->where('horaEntrega', "<=", $hora)->get();

        if($solicitud->count() > 0){
             if($solicitud->estado = "pendiente"){
                solicitud::where("fechaDevolucion", $fecha)->where('horaDevolucion', "<=", $hora)->update(['estado' => 'En uso']);
            } 
            if($solicitud->estado = 'En uso'){ 
                solicitud::where("fechaDevolucion", $fecha)->where('horaDevolucion', "<=", $hora)->update(['estado' => 'Activo']);
            }
        }
    }
}
