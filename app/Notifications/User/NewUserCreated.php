<?php

namespace App\Notifications\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewUserCreated extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public $data
    )
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $role = '';
        if ($this->data['role'] === 'ADM') {
            $role = 'Admin';
        } elseif ($this->data['role'] === 'WRT')  {
            $role = 'Author';
        }
        return (new MailMessage)
        ->greeting('Hey dear!')
        ->subject('An '.$role.'\'s account has Been created with this email address')
                    ->line('A new account was created with this email address.')
                    ->line('Here is is the login password.')
                    ->line('Password:'.$this->data['password'])
                    ->line('Kindly do well to change your password after you login')
                    ->action('Login', url(route('login')));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
