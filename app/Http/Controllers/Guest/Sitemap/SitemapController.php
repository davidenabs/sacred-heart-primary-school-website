<?php

namespace App\Http\Controllers\Guest\Sitemap;

use App\Http\Controllers\Controller;
use App\Models\Blog\Post;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        $post = Post::orderBy('updated_at', 'desc')->first();

        return response()->view('guest.sitemap.index', [
            'post' => $post,
        ])->header('Content-Type', 'text/xml');
    }
}
