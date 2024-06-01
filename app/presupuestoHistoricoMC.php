<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class presupuestoHistoricoMC extends Model
{
    protected $primaryKey = 'idHMC';
    public $incrementing = false;
    protected $table = 'presupuesto_historico_m_cs';
    protected $fillable = [
        'idHMC',
        'fechaCreacion',
        'placa',
        'numFactura',
        'montoFactura', 
        'presupuesto_meca_carro', 
    ];
}
