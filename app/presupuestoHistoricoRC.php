<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class presupuestoHistoricoRC extends Model
{
    protected $primaryKey = 'idHRC';
    public $incrementing = false;
    protected $table = 'presupuesto_historico_r_cs';
    protected $fillable = [
        'idHRC',
        'fechaCreacion',
        'placa',
        'numFactura',
        'montoFactura',
        'presupuesto_R_C',
    ];
}
