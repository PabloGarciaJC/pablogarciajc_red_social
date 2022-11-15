<?php

namespace App\Notifications;

use App\Models\Follower;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AgregarAmigoNotification extends Notification
{
    use Queueable;

    protected $followers;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Follower $followers)
    {
        $this->followers = $followers;
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
            'alias' => $this->followers->user->alias,
            'created_at' => $this->followers->created_at,
            'mensaje' => 'Te Envio una Notificacion'
        ];
    }
}
