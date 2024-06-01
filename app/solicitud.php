<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class solicitud extends Model
{
    protected $primaryKey = 'idSolicitud';
    public $incrementing = false; 
    protected $fechaEntrega = 'fechaEntrega';
    protected $fillable = [
        'idSolicitud',
        'id',
        'primerNombre',
        'segundoNombre',
        'primerApellido',
        'segundoApellido',
        'departamento',
        'telefono',
        'email',
        'descripcion',
        'destino',
        'numPersonas',
        'placa',
        'fechaEntrega',
        'horaEntrega',
        'fechaDevolucion',
        'horaDevolucion',
        'estado',
        'conductor'
    ];
}
