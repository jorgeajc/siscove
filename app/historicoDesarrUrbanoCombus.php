<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class historicoDesarrUrbanoCombus extends Model
{
    protected $primaryKey = 'idHDUC';
    public $incrementing = false;
    protected $table = 'historico_desarr_urbano_combuses';
    protected $fillable = [
        'idHDUC',
        'fechaCreacion',
        'numeroCupon',
        'numeroFactura',
        'placa',
        'cantLitros',
        'montoFactura', 
        'desarr_urbano_combus', 
    ];
}
