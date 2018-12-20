<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewArchievement extends Notification
{
    use Queueable;

    protected $description;
    protected $avatar;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($description,$avatar)
    {
        $this->description = $description;
        $this->avatar = $avatar;
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

    public function toDatabase($notifiable)
    {
        return [
            'description' => $this->description,
            'avatar' => $this->avatar,
            'user' => auth()->user()
        ];
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
            //
        ];
    }
}
