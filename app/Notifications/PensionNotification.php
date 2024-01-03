<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Cliente;
use App\Models\User;
use App\Models\TipoCliente;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Notifications\ClienteNotification;
use App\Database;

class PensionNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(TipoCliente $tipocliente)
    {
        $this->tipocliente = $tipocliente;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'id' => $this->tipocliente->id,
            'tipo' => $this->tipocliente->tipo,
            'Fecha_Final' => $this->tipocliente->Fecha_Final,
            'cliente_id' => $this->tipocliente->cliente_id,
        ];
    }
}
