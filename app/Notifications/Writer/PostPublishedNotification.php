<?php

namespace App\Notifications\Writer;

use App\Models\Blog\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostPublishedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Post $post
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
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->subject('Post Published!')
        ->greeting('Dear ' . $this->post->author->name)
        ->line('This is to inform you that your post has been published and live on the website!')
        ->line('See details below:')
        ->line('- -')
        ->line('Title: ' . $this->post->title)
        ->line('Summary' . $this->post->summary)
        ->line('Published date: ' . date('M d, Y h:ia', strtotime($this->post->published_at)))
        ->line('URL: ' . url(route('blog.show', [$this->post->slug])))
        ->action('See Post', url(route('writer.posts.show', [$this->post->slug])))
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
            'message' => 'Your post has been approved, and now published',
            'data' => $this->post,
        ];
    }
}
