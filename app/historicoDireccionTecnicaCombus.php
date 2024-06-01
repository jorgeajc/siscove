<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class historicoDireccionTecnicaCombus extends Model
{
    protected $primaryKey = 'idHDTC';
    public $incrementing = false;
    protected $table = 'historico_direccion_tecnica_combuses';
    protected $fillable = [
        'idHDTC',
        'fechaCreacion',
        'numeroCupon',
        'numeroFactura',
        'placa',
        'cantLitros',
        'montoFactura', 
        'direc_tec_combus', 
    ];
}
