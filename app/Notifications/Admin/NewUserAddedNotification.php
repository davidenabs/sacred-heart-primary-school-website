<?php

namespace App\Notifications\Admin;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewUserAddedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public User $user
    )
    {}

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
        return (new MailMessage)
        ->subject('New User Added!')
        ->greeting('Dear Admin')
        ->line('This is to notify you that a new user has been added to the database!')
        ->line('See details below:')
        ->line('- -')
        ->line('Name: ' . $this->user->name)
        ->line('Email Address: ' . $this->user->email)
        ->line('Role: ' . $this->user->role)
        ->line('Bio' . $this->user->bio)
        ->line('Date: ' . date('M d, Y h:ia', strtotime($this->user->created_at)))
        ->action('Take Action', url(route('admin.users.show', [$this->user->role, $this->user->id])))
        ->line(env('app.name') .'!');
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
