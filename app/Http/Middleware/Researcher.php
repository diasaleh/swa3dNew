<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\auth;
use Closure;

class Researcher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if($user->userType != 2){
            return redirect()->route('home');
        }
        return $next($request);
    }
}