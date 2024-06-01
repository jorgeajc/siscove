<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class presupuestoMecaMoto extends Model
{
    protected $primaryKey = 'idPMM';
    public $incrementing = false;
    protected $fillable = [
        'idPMM',
        'fechaRegistro',
        'montoEstablecido',
        'montoRestante',
        'presupuestoGeneral',
        
    ];
}
