<?php

namespace App\Notifications\Subscribers;

use App\Models\Blog\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewPostPublishedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Post $post
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
        ->subject('New Published Post: [Post Title]')
        ->line('Dear Subscriber,')
        ->line('We are pleased to inform you about a new post that has been published on our website:')
        ->line('** Post Title: '.$this->post->title .'**')
        ->line('You can read the full post by clicking the link below:')
        ->action('Read Post', url(route('blog.show', $this->post->slug))) // Replace with the actual URL of the new post
        ->line('Stay updated with our latest posts and news by visiting our website.')
        ->line('If you no longer wish to receive notifications, you can unsubscribe:')
        ->action('Unsubscribe', url('unsubscribe', )) // Replace with the URL for the unsubscribe page
        ->line('Thank you for being a valued subscriber!')
        ->salutation('Sincerely,')
        ->line('[Your Organization Name]');

    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [

        ];
    }
}
