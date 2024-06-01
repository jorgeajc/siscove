<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gasolineras extends Model
{
    protected $primaryKey = 'cedulaJuridica'; 
    public $incrementing = false;
    protected $fillable = [
        'cedulaJuridica',
        'nombre', 
        'ubicacion', 
        'contacto', 
        'correo',
        'estado', 
    ];

    
    protected $table = 'gasolineras';
}




