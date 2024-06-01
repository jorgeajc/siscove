<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PresuMinGas extends Mailable
{
    use Queueable, SerializesModels;
    public $email;
    public function __construct($email)
    {
        $this->email = $email;
    } 
    public function build()
    {
        return $this->markdown('mails.PresuMinGas') 
                    ->subject('Alerta de presupueato mínimo de combustible - SISCOVE');
    }
}
