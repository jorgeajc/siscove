<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class historicoAdminiCombus extends Model
{
    protected $primaryKey = 'idHAC';
    public $incrementing = false;
    protected $table = 'historico_admini_combuses';
    protected $fillable = [
        'idHAC',
        'fechaCreacion',
        'numeroCupon',
        'numeroFactura',
        'placa',
        'cantLitros',
        'montoFactura', 
        'administracion_combus', 
    ];
}
