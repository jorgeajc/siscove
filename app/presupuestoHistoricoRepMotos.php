<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class presupuestoHistoricoRepMotos extends Model
{
    protected $primaryKey = 'idHRM';
    public $incrementing = false;
    protected $fillable = [
        'idHRM',
        'fechaCreacion',
        'placa',
        'numFactura',
        'montoFactura', 
        'presu_rep_moto', 
    ];
}
