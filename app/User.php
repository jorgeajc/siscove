<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable 
{
    use Notifiable;
    use HasRoles;
    protected $fillable = [
        'id',
        'primerNombre',
        'segundoNombre',
        'primerApellido',
        'segundoApellido',
        'telefono',
        'email', 
        'password',
        'tipoUsuario',
        'descripcion',
        'estado',
    ]; 
    protected $hidden = [
        /*'password', */'remember_token',
    ]; 
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function scopeName($query, $primerNombre)
    {  
        if($primerNombre) 
            return $query->where(\DB::raw("CONCAT(Users.id, ' ',
                                                Users.primerNombre, ' ',
                                                Users.segundoNombre, ' ', 
                                                Users.primerApellido, ' ', 
                                                Users.segundoApellido)"
                                        ), "LIKE",  "%$primerNombre%"); 
    }  
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

}
