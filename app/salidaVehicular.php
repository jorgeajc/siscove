<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class salidaVehicular extends Model
{
    protected $fillable = [
        'oficinaSolicitante',
        'fechaAutorizacionSalida',
        'fechaAutorizacionIngreso',
        'placa', 
    ]; 
}
