<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class licencias extends Model
{
    protected $fillable = [
        'id',
        'vencimiento', 
        'tipo', 
    ]; 
}
