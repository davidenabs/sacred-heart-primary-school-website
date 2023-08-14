<?php

namespace App\Http\Controllers\Guest\Sitemap;

use App\Http\Controllers\Controller;
use App\Models\Blog\Post;
use Illuminate\Http\Request;

class PostSitemapController extends Controller
{
    public function index()
    {
        $alphas = range('a', 'z');

        return response()->view('guest.sitemap.posts.index', [
            'alphas' => $alphas,
        ])->header('Content-Type', 'text/xml');
    }

    public function show($letter){
        $posts = Post::where('title', 'LIKE', "$letter%")->get();

        return response()->view('guest.sitemap.posts.show', [
            'posts' => $posts,
        ])->header('Content-Type', 'text/xml');
    }
}
