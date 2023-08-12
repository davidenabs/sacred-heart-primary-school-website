<?php

namespace App\Http\Middleware;

use App\Models\Blog\Post;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class TrackPostViews
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $postId = $request->route('post');

        $post = Post::find($postId)->first();

        $viewed = session()->get('viewed_post', []);

        if (!in_array($post->id, $viewed)) {
            if ($post) {
                $post->increment('views');
                session()->push('viewed_post', $post->id);

                // set a cookie to prevent duplicate views from the same user for a limitted time
                $cookieMinutes = 1440;
                Cookie::queue(Cookie::make('viewed_post', true, $cookieMinutes));
            }
        }

        return $next($request);
    }
}
