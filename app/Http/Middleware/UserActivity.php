<?php

namespace App\Http\Middleware;

use App\Models\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class UserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $expireAt = Carbon::now()->addMinute(1);
            Cache::put('user-is-online-' . Auth::id(), true, $expireAt);

            User::whereId(Auth::id())->update(['last_seen' => (new \DateTime())->format('Y-m-d H:i:s')]);
        }

        return $next($request);
    }
}
