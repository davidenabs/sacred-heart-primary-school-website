<?php

namespace App\Notifications\Admin;

use App\Models\Blog\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Post $post
    ) {
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
            ->subject('New Post Added!')
            ->greeting('Dear Admin')
            ->line('This is to notify you that a new post has been added and waiting for approval!')
            ->line('See details below:')
            ->line('- -')
            ->line('Title: ' . $this->post->title)
            ->line('Author: ' . $this->post->author->name)
            ->line('Summary' . $this->post->summary)
            ->line('Date: ' . date('M d, Y h:ia', strtotime($this->post->created_at)))
            ->line('URL: ' . url(route('blog.show', [$this->post->slug])))
            ->action('Take Action', url(route('admin.posts.show', [$this->post->slug])))
            ->line(env('app.name') . '!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        // dd($this->post);
        return [
            "message" => "New post created: Awaiting approval",
            "data" => [
                'category_id' => $this->post->category_id,
                'author_id'  => $this->post->author_id,
                'title'  => $this->post->title,
                'slug'  => $this->post->slug,
                'summary'  => $this->post->summary,
                'created_at'  => $this->post->created_at,
            ]
        ];
    }
}
