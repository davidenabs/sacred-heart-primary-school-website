<?php

namespace App\Http\Controllers\Guest\Post;

use App\Http\Controllers\Controller;
use App\Models\Blog\Category;
use App\Models\Blog\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public $tags;
    public $categories;
    public $recentPosts;

    public function __construct()
    {
        $this->categories = Category::orderBy('title')
        ->take(6)
        ->get(['id', 'title', 'slug']);

        $this->recentPosts = Post::published()
        ->searched()
        ->undraft()
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get(['id', 'title', 'slug', 'category_id', 'featured_image', 'created_at']);

    }

    public function show(Category $category)
    {
        $posts = $category->posts()->with([
            'author' => function ($query) {
                $query->select('id', 'name',);
            },
        ])
        ->searched()
        ->orderBy('created_at', 'desc')
        ->paginate(4,
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
            'category'=> $category,
            'posts' => $posts,
            'categories' => $this->categories,
            'recentPosts' => $this->recentPosts,
        ]);
    }
}
