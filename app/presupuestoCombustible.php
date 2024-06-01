<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class presupuestoCombustible extends Model
{
    protected $primaryKey = 'idPC';
    public $incrementing = false;
    protected $fillable = [
        'idPC',
        'fechaRegistro',
        'montoEstablecido', 
        'montoRestante',
        'presupuestoGeneral',
    ]; 
}
