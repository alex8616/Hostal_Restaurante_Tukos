<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProblemaRegistradoNotification extends Notification
{
    use Queueable;

    protected $problema;

    public function __construct($problema)
    {
        $this->problema = $problema;
    }
    
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'problema_id' => $this->problema->id,
            'user_id' => $this->problema->user_id,
            'problema_titulo' => $this->problema->titulo,
            'description' => $this->problema->description,
            'asignado_fecha' => $this->problema->asignado_fecha,
            'resuelto_fecha' => $this->problema->resuelto_fecha,
            'solution' => $this->problema->solution,
            'estado' => $this->problema->estado,
            'tipoproblema' => $this->problema->tipoproblema,
            'mensaje' => 'Se ha registrado un nuevo problema.',
        ];
    }
}
