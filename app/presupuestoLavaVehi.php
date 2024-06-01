<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class presupuestoLavaVehi extends Model
{
    protected $primaryKey = 'idPLV';
    public $incrementing = false;
    protected $table = 'presupuesto_lava_vehis';
    protected $fillable = [
        'idPLV',
        'monto',
        'montoRestante', 
        'fecha',
        //'presupuestoGeneral',
    ];
}
