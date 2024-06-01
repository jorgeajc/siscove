<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PresupuestoRC extends Model
{
    protected $primaryKey = 'idPRC';
    public $incrementing = false; 
    protected $table = 'presupuesto_r_cs';
    protected $fillable = [
    'idPRC','fechaRegistro', 'montoEstablecido', 'montoRestado', //'presupuestoGeneral',

   ];
}
