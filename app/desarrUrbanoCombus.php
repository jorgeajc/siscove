<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class desarrUrbanoCombus extends Model
{
    protected $primaryKey = 'idDUC';
    public $incrementing = false;
    protected $fillable = [
        'idDUC',
        'fechaRegistro',
        'montoEstablecido', 
        'montoRestante',
        'presupuestoGeneral',
    ]; 
}
