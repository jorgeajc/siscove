<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class talleres extends Model
{
   protected $primaryKey = 'CedulaJuridica'; 
    public $incrementing = false;
     protected $fillable = [
        'CedulaJuridica', 'nombre', 'Ubicacion', 'Contacto', 'Correo', 'Estado',
     ];

     protected $table = 'talleres';
     
}