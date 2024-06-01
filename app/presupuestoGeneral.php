<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class presupuestoGeneral extends Model
{
    protected $primaryKey = 'idPG';
    public $incrementing = false;
    protected $fillable = [
        'idPG',
        'fechaRegistro',
        'montoEstablecido', 
        'montoRestante',
    ]; 
}
