<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class direccionTecnicaCombus extends Model
{
    protected $primaryKey = 'idDTC';
    public $incrementing = false;
    protected $fillable = [
        'idDTC',
        'fechaRegistro',
        'montoEstablecido', 
        'montoRestante',
        'presupuestoGeneral',
    ]; 
}
