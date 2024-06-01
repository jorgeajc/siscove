<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class control_accesorios extends Model
{
    protected $fillable = [
        'idSalidaVehicular',
        'radio',
        'encenderdor',
        'alfombra', 
        'antena',
        'espejoExterior',
        'espejoInterior',
        'extintor', 
        'gata',
        'llaveRana',
        'llaveRepuesto',
        'triangulos',
        'observaciones',
        'estado' 
    ];
}
