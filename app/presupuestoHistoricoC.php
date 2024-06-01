<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class presupuestoHistoricoC extends Model
{
    protected $primaryKey = 'idHC';
    public $incrementing = false;
    protected $table = 'presupuesto_historico_cs';
    protected $fillable = [
        'idHC',
        'fechaCreacion',
        'numeroCupon',
        'numeroFactura',
        'placa',
        'cantLitros',
        'montoFactura', 
        'presupuesto_combustible', 
    ];
}
