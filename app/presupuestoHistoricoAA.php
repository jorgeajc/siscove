<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class presupuestoHistoricoAA extends Model
{
    protected $primaryKey = 'idHAA';
    public $incrementing = false;
    protected $table = 'presupuesto_historico_a_as';
    protected $fillable = [
        'idHAA',
        'fechaCreacion',
        'placa',
        'numFactura',
        'montoFactura', 
        'presupuesto_aire_acond', 
    ];
}
