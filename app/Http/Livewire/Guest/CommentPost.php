<?php

namespace App\Http\Livewire\Guest;

use Illuminate\Foundation\Http\Middleware\RateLimited;
use App\Models\Blog\Comment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CommentPost extends Component
{
    public $email, $name, $page, $is_admin = false;
    public $comments, $post, $content, $reply_content, $parentID, $replyToId, $follow = true;

    protected $rules = [
        'name' => 'required|string',
        'email' => 'required|email',
        'content' => 'required|string|max:500',
        // 'parent_id' => 'nullable|exists:comments,id'
    ];

    public function mount($comments, $post, $page, $is_admin)
    {
        $this->comments = $comments;
        $this->post = $post;
        $this->page = $page;

        if ($is_admin) {
            $this->email = env('APP_EMAIL', 'sacredheartprimaryschool2023@gmail.com');
            $this->name = "Admin";
        } else {
            if (Auth::check()) {
                $this->email = auth()->user()->email;
            $this->name = auth()->user()->name;
            }
        }
        $this->is_admin = $is_admin;
    }

    public function storeComment()
    {
        $this->validate();

        if ($this->parentID) {
            return $this->storeReplyTo($this->parentID, $this->replyToId);
        }

        // Check if a comment with the same email already exists
        $existingComment = Comment::where('email', $this->email)->first();

        // If the user's email is recognized, use their name
        $name = $existingComment ? $existingComment->name : $this->name;

        $comment = new Comment();
        $comment->name = $name;
        $comment->content = $this->content;
        $comment->email = $this->email;
        // $comment->user_id = 1;

        $this->post->comments()->save($comment);

        session()->flash('success', 'Comment added successfully');

        $this->reset(['content', 'name', 'email']);
        return redirect($this->page);
    }

    public function storeReplyTo($parent_id, $reply_to_id = null)
    {
        $this->validate();

       try {
         // Check if a comment with the same email already exists
         $existingComment = Comment::where('email', $this->email)->first();

         // If the user's email is recognized, use their name
         $name = $existingComment ? $existingComment->name : $this->name;

         $reply = new Comment();
         $reply->content = $this->content;
         $reply->parent_id = $parent_id;
         $reply->reply_to_id = $reply_to_id;

         $reply->email = $this->email;
         $reply->name = $name;

         $this->post->comments()->save($reply);

         $this->reset(['content', 'name', 'email']);
         $this->parentID = '';
         $this->replyToId = '';
         session()->flash('success', 'Reply added');
         return redirect($this->page);
       } catch (\Throwable $th) {

       }
    }

    public function repyId($parentID, $replyToId = null)
    {
        $this->parentID = $parentID;
        $this->replyToId = $replyToId;
    }

    public function deleteComment($commentId)
    {
        $comment = Comment::find($commentId);
        $comment->delete();


        $this->dispatchBrowserEvent(
            'showAlert',
            ['type' => 'success', 'message' => 'Deleted successfully!!']
        );

        return redirect($this->page);
    }

    // Apply the throttle middleware to the storeComment method
    public function middleware()
    {
        return [
            'throttle:10,1',
        ];
    }

    public function render()
    {
        return view('livewire.guest.comment-post');
    }
}
