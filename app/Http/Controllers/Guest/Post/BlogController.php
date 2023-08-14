<?php

namespace App\Http\Controllers\Guest\Post;

use App\Http\Controllers\Controller;
use App\Models\Blog\Category;
use App\Models\Blog\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public $tags;
    public $categories;
    public $popularPosts;
    public $recentPosts;
    public $seoData;

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

    public function index(Request $request  = null)
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
                'page' => new SEOData(
                    title: 'Blog posts, news and events',
                    description: 'Explore the latest blog posts from Sacred Heart Primary School. Discover valuable insights on education, student development, community engagement, and more. Join us on a journey of knowledge and inspiration.',
                ),
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

        $shareButtons = \Share::page(
            url(route('blog.show', $post->slug)),
            Str::limit($post->summary, 60, '...')
      )
            ->facebook()
            ->twitter()
            ->telegram()
            ->whatsapp();

        return view('guest.blog.show', [
            'post' => $post,
            'categories' => $this->categories,
            'recentPosts' => $this->recentPosts,
            'popularPosts' => $this->popularPosts,
            'relatedPosts' => $relatedPosts,
            'shareButtons' => $shareButtons,
        ]);

    }
    }
}
