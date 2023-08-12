<?php

namespace App\Http\Controllers\Guest\Post;

use App\Http\Controllers\Controller;
use App\Models\Blog\Category;
use App\Models\Blog\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{
    public $tags;
    public $categories;
    public $popularPosts;
    public $recentPosts;

    public function __construct()
    {
        $this->categories = Category::orderBy('title')
            ->take(6)
            ->get(['id', 'title', 'slug']);

        $this->popularPosts = Post::inRandomOrder()
            ->orderBy('views', 'desc')
            ->take(5)
            ->get(['id', 'title', 'slug', 'category_id', 'featured_image', 'created_at']);

        $this->recentPosts = Post::orderBy('created_at', 'desc')
            ->take(5)
            ->get(['id', 'title', 'slug', 'category_id', 'featured_image', 'created_at']);

    }

    public function index(Request $request)
    {
        $posts = Post::with([
            'author' => function ($query) {
                $query->select('id', 'name',);
            },
        ])
        ->published()
        ->searched()
        ->orderBy('created_at', 'desc')
        ->paginate(10,
        [
            'id',
            'author_id',
            'category_id',
            'title',
            'summary',
            'content',
            'meta_description',
            'featured_image',
            'slug',
            'created_at'
        ]);

        return view('guest.blog.index', [
            'posts' => $posts,
            'categories' => $this->categories,
            'recentPosts' => $this->recentPosts,
            'popularPosts' => $this->popularPosts,
        ])->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function show(Post $post)
    {
        if (request()->query('search') == true) {

            return $this->index();
        } else {
        $category = Category::find($post->category_id);

        if ($category) {
            $relatedPosts = $category->posts()->where('id', '!=', $post->id)->get(['category_id', 'title', 'slug', 'featured_image']);
        }

        // post view counter
        // $blogKey = 'blog_' . $post->id;

        // if (!Session::has($blogKey)) {
        //     $post->increment('views');
        //     Session::put($blogKey, 1);
        // }

        return view('guest.blog.show', [
            'post' => $post,
            'categories' => $this->categories,
            'recentPosts' => $this->recentPosts,
            'popularPosts' => $this->popularPosts,
            'relatedPosts' => $relatedPosts
        ]);

    }
    }
}
