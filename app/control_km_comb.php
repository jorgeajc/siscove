<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class control_km_comb extends Model
{
    protected $fillable = [
        'idSalidaVehicular',
        'dia',
        'fecha',
        'horaSalida',
        'horaIngreso',
        'kmSalida',
        'kmIngreso',
        'combustibleSalida',
        'combustibleIngreso',
        'ChoferSalida',    
        'ChoferIngreso',
        'GuardaSalida',
        'GuardaIngreso'
    ];
}
