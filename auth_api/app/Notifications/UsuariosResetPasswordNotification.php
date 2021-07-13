<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UsuariosResetPasswordNotification extends Notification
{
    //Places this task to a queue if its enabled
    use Queueable;

    //Token handler
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    //Notifications sent via email
    public function via($notifiable)
    {
        return ['mail'];
    }

    //Content of email sent to the Seller
    public function toMail($notifiable)
    {
        return (new MailMessage)
        ->subject('Solicitação de Mudança de Senha')
        ->greeting('Olá!')
        ->line('Você está recebendo este email pois recebemos uma notificação de mudança de senha para a sua conta')
        ->action('Trocar Senha', url('trocarsenha', $this->token))
        ->line('Se você não fez esta solicitação, nenhuma ação é necessária.')
        ->salutation('Atenciosamente');
    }
}
