<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class presupuestoHistoricoLV extends Model
{
    protected $primaryKey = 'idHLV';
    public $incrementing = false;
    protected $table = 'presupuesto_historico_l_vs';
    protected $fillable = [
        'idHLV',
        'fechaCreacion',
        'placa',
        'numFactura',
        'montoFactura', 
        'presupuesto_lava_vehi', 
    ];
    
}
