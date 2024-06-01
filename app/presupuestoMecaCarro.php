<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class presupuestoMecaCarro extends Model
{
    protected $primaryKey = 'idPMC';
    public $incrementing = false;
    protected $fillable = [
        'idPMC',
        'fechaRegistro',
        'montoEstablecido',
        'montoRestado',
        'presupuestoGeneral',
        
    ];
}
