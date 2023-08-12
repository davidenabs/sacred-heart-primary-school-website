<?php

namespace App\Notifications\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class NewMailSentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public $data
    )
    {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        // dd($this->data->user);
        return (new MailMessage)
        ->subject('New Mail Notification')
        ->greeting('Dear Admin')
        ->line('A new mail has been sent from the school website by one of the admins.')
        ->line('Sender Name: ' . $this->data->user->name)
        ->line('Sender Email: ' . $this->data->user->email)
        ->line('Subject: ' . $this->data->subject)
        ->line('Message:')
        ->line( new HtmlString($this->data->body))
        ->action('View Mail', url(route('admin.mail.show', $this->data->id)));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            "message" => "Mail broadcast was sent by " .$this->data->user->name,
            "data" => [
                'id' =>  $this->data->id,
                'from' =>  $this->data->email,
                'subject' => $this->data->subject,
                'user_id' => $this->data->user_id,
            ],
        ];
    }
}
