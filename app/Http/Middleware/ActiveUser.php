<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ActiveUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if (auth()->user()->deleted_at) {
        //     auth()->logout();

        //     session()->flash('error', 'This account has been blocked!');
        //     return redirect()->route('login');
        // }
        
        return $next($request);
    }
}
