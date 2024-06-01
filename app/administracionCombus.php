<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class administracionCombus extends Model
{
    protected $primaryKey = 'idAC';
    public $incrementing = false;
    protected $fillable = [
        'idAC',
        'fechaRegistro',
        'montoEstablecido', 
        'montoRestante',
        'presupuestoGeneral',
    ]; 
}
