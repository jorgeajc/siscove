<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class control_carroceria extends Model
{
    protected $fillable = [
        'idSalidaVehicular',
        'bumperTrasero',
        'bumperDelantero',
        'guardaBarroDD', 
        'guardaBarroDI',
        'guardaBarroTD',
        'guardaBarroTI', 
        'tapaBaul',
        'tapaMotor', 
        'parabrisasTrasero',
        'parabrisasDelantero',
        'puertaDD',
        'puertaDI', 
        'puertaTD',
        'puertaTI',
        'quisioD', 
        'quisioI', 
        'techo', 
        'observaciones', 
    ];
}
