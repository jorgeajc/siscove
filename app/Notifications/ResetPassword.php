<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification
{
    use Queueable; 
    public $actionUrl;
    public function __construct($token)
    {
        $this->actionUrl = action('Auth\ResetPasswordController@showResetForm',$token);
    } 
    public function via($notifiable)
    {
        return ['mail'];
    } 
    public function toMail($notifiable)
    {
        return (new MailMessage)   
        ->subject('Recuperar contraseña - SISCOVE') 
        ->greeting('Hola!')
        ->line('Recibió este correo electrónico porque recibimos una solicitud de restablecimiento de contraseña para su cuenta.')
        ->action('Restablecer la contraseña', $this->actionUrl)
        ->line('Si no solicitó un restablecimiento de contraseña, no se requiere ninguna otra acción.')
        ->salutation('Saludos, SISCOVE');
    } 
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
