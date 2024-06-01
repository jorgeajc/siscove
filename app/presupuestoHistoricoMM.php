<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class presupuestoHistoricoMM extends Model
{
    protected $primaryKey = 'idHMM';
    public $incrementing = false;
    protected $table = 'presupuesto_historico_m_ms';
    protected $fillable = [
        'idHMM',
        'fechaCreacion',
        'placa',
        'numFactura',
        'montoFactura', 
        'presupuesto_meca_moto', 
    ];
}
