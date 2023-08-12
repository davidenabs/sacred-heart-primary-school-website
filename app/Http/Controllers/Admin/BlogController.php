<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\PostRequest;
use App\Mail\NewPostPublisdedMail;
use App\Models\Blog\Category;
use App\Models\Blog\Post;
use App\Models\Subscribe;
use App\Models\User;
use App\Notifications\User\AccountRestoredNotification;
use App\Notifications\Writer\PostPublishedNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class BlogController extends Controller
{
    public $posts, $draft_posts, $pending_posts, $trash_posts;

    public function getData()
    {
        $this->posts = Post::latest()->get();
        $this->draft_posts = Post::editor()->draft()->latest()->get();
        $this->pending_posts = Post::unpublished()->latest()->get();
        $this->trash_posts = Post::editor()->onlyTrashed()->latest()->get();
    }

    /**
     * Display a listing of the resource.
     */
    public function index($type = 'posts')
    {
        $this->getData();
        $postsCount = $this->posts->count();
        $draftCount = $this->draft_posts->count();
        $pendingCount = $this->pending_posts->count();
        $trashCount = $this->trash_posts->count();

        if ($type === 'draft') {
            $posts = $this->draft_posts;
        } elseif ($type === 'pending') {
            $posts = $this->pending_posts;
        } elseif ($type === 'trash') {
            $posts = $this->trash_posts;
        } else {
            $posts = $this->posts;
        }

        $data = [
            'posts' => $posts,
            'postsCount' => $postsCount,
            'draftCount' => $draftCount,
            'pendingCount' =>  $pendingCount,
            'trashCount' =>  $trashCount,
            'is_trash' => $type == 'trash' ? true : false
        ];

        return view('admin.pages.blog.post.index', $data);
    }

    public function showPostsByCategory(Category $category)
    {
        $this->getData();
        $postsCount = $this->posts->count();
        $draftCount = $this->draft_posts->count();
        $pendingCount = $this->pending_posts->count();
        $trashCount = $this->trash_posts->count();

        $data = [
            'posts' => $category->posts()->with([
                'author' => function ($query) {
                    $query->select('id', 'name',);
                },
            ])->orderBy('created_at', 'desc')->get(),
            'postsCount' => $postsCount,
            'draftCount' => $draftCount,
            'pendingCount' =>  $pendingCount,
            'trashCount' =>  $trashCount,
            'is_trash' => false
        ];

        return view('admin.pages.blog.post.index', $data);
    }

    public function showPostsByUser($user)
    {
        $this->getData();
        $user = User::withTrashed()->whereId($user)->firstOrFail();

        $postsCount = $this->posts->count();
        $draftCount = $this->draft_posts->count();
        $pendingCount = $this->pending_posts->count();
        $trashCount = $this->trash_posts->count();

        $data = [
            'posts' => $user->posts()->orderBy('created_at', 'desc')->get(),
            'postsCount' => $postsCount,
            'draftCount' => $draftCount,
            'pendingCount' =>  $pendingCount,
            'trashCount' =>  $trashCount,
            'is_trash' => false
        ];

        return view('admin.pages.blog.post.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.blog.post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        // Post::create($request->all());

        $image = $request->file('file');

        // Validate the uploaded image if needed

        // Move the uploaded image to the public directory
        $path = $image->store('public/shs_images/posts');

        // Generate the URL of the uploaded image
        $imageUrl = asset(str_replace('public/', '', $path));

        return response()->json(['url' => $imageUrl]);

        // return redirect()->route('admin.pages.blog.post.index')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($post)
    {
        $post = $this->getPost($post);

        return view('admin.pages.blog.post.show', compact('post'));
    }

    public function showComments($post)
    {
        $post = $this->getPost($post);

        return view('admin.pages.blog.post.show-comments', compact('post'));
    }

    public function deleteComments(Post $post)
    {
        $post->comments()->delete();
        return response()->json();
    }

    public function showAnalytics($post)
    {
        $post = $this->getPost($post);

        return response()->json([
            'views' => $post->views,
            'shares' => $post->shares,
            'comments' => $post->comments()->count()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('admin.pages.blog.post.create', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->all());

        return redirect()->route('admin.pages.blog.post.index')
            ->with('success', 'Post updated successfully!');
    }

    public function publishPost($post)
    {
        $post = $this->getPost($post);


        $updatePost = [
            'is_published' => true,
            'is_draft' => false,
            'published_at' => Carbon::now(),
        ];

        $post->where('is_published', false)->update($updatePost);

        // notify editor
        if (!$post->notified) {
            // $post->author->notify(new PostPublishedNotification($post));

            $subscribers = Subscribe::whereStatus(true)->get(['name', 'email']);
            // dd($subscribers);

            if ($subscribers) {
                foreach ($subscribers as $subscriber) {
                    // dd($subscriber->email);
                    try {
                        Mail::to($subscriber->email)->send(new NewPostPublisdedMail($post, $subscriber));
                    } catch (\Throwable $th) {
                        // dd($th);
                        // info($th);
                        // Handle the exception here if needed
                        // If you want to skip sending to the current email and continue with the next one,
                        // you don't need to use 'continue' here because it will automatically continue with the next iteration
                    }
                }
            }

            $post->update(['notified' => true]);
        }


        return redirect()->back()->with('success', 'Published successfully!');
    }

    public function undraftPost(Request $request, $post)
    {
        $post = $this->getPost($post);

        $updatePost = ['is_draft' => false];

        $post->update($updatePost);

        if ($request->wantsJson()) {
            return response()->json('Post undrafted successfully!');
        } else {
            return redirect()->back()->with('success', 'Post undrafted successfully!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Post $post)
    {
        // unlink($post->featured_image);

        $post->delete();

        if ($request->wantsJson()) {
            return response()->json('Post moved to trash successfully!');
        } else {
            return redirect()->route('admin.pages.blog.post.index')->with('success', 'Post moved to trash successfully!');
        }
    }

    public function forceDestroy(Request $request, $post)
    {
        $post = $this->getPost($post);

        unlink($post->featured_image);

        $post->forceDelete();

        if ($request->wantsJson()) {
            return response()->json('Post deleted successfully!');
        } else {
            return redirect()->route('admin.pages.blog.post.index')->with('success', 'Post deleted successfully!');
        }
    }

    public function restore($post)
    {

        $post = $this->getPost($post);

        $post->restore();

        session()->flash('success', 'Post restored successfully!');

        // send mail
        $post->author->notify(new AccountRestoredNotification($post->author));

        return redirect()->back();
    }

    protected function getPost($postSlug, $withTrashed = true): Post
    {
        if ($withTrashed) {
            $post = Post::withTrashed()->whereSlug($postSlug)->firstOrFail();
        } else {
            $post = Post::withoutTrashed()->whereSlug($postSlug)->firstOrFail();
        }

        return $post;
    }

    public static function formatNumber($num)
    {
        if($num > 1000) {

            $x = round($num);
            $x_number_format = number_format($x);
            $x_array = explode(',', $x_number_format);
            $x_parts = array('k', 'm', 'b', 't');
            $x_count_parts = count($x_array) - 1;
            $x_display = $x;
            $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
            $x_display .= $x_parts[$x_count_parts - 1];

            return $x_display;

        }

        return $num;
    }
}
