<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mantenimientoVehicular extends Model
{
    protected $primaryKey = 'idMV';
    public $incrementing = false;
    protected $fillable = [
        'idMV',
        //outomovil, pickap etc
        'tipoVehiculo',
        'Motor', 
        'placa',
        'modelo',
        'kilometros',
        'fechaIngreso',
        'propietario',
        'descripcion',
    ]; 
}
