<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class presupuestoRepuestoMoto extends Model
{
    protected $primaryKey = 'idPRM';
    public $incrementing = false;
    protected $fillable = [
        'idPRM',
        'fechaRegistro',
        'montoEstablecido',
        'montoRestante',
        'presupuestoGeneral',
        
    ];
}
