<?php

namespace App\Http\Middleware;

use App\Models\Blog\Post;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class TrackPostView
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $postId = $request->route('post');
        $key = 'viewed_post_' .$postId;

        if (!$request->session()->has($key)) {
            $post = Post::find($postId);
            dd($post);
            if ($post) {
                $post->increment('view');
                $request->session()->put($key, true);

                // set a cookie to prevent duplicate views from the same user for a limitted time
                $cookieMinutes = 1440;
                Cookie::queue(Cookie::make($key, true, $cookieMinutes));
            }
        }

        return $next($request);
    }
}
