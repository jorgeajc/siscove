<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class presupuestoAireAcond extends Model
{
    protected $primaryKey = 'idPAA';
    public $incrementing = false;
    protected $table = 'presupuesto_aire_aconds';
    protected $fillable = [
        'idPAA',
        'fechaRegistro',
        'montoEstablecido', 
        'montoRestante',
        //'presupuestoGeneral',
    ]; 
}
