<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vehiculos extends Model
{
    protected $primaryKey = 'placa';
    public $incrementing = false;
    protected $fillable = [
        'placa',
        'marca',
        'modelo',
        'cantidadAsientos',
        'tipo',
        'estado',
        'marchamo',
        'riteve',
    ];
    public function scopeBusqueda($query, $dato)
    {  
        if($dato) 
            return $query->where(\DB::raw("CONCAT(vehiculos.placa, ' ',
                                                vehiculos.marca, ' ',
                                                vehiculos.modelo, ' ', 
                                                vehiculos.cantidadAsientos, ' ', 
                                                vehiculos.tipo)"
                                        ), "LIKE",  "%$dato%"); 
    }   
}
