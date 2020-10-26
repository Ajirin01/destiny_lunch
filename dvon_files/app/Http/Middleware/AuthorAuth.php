<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth as Auth;
use Closure;

class AuthorAuth
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
        if(Auth::user()){
            if(Auth::user()->type !== 'author'){
                return (request()->header('referer')) ? redirect()->back() : redirect()->home();
                // return redirect('login');
            }
            return $next($request);
        }else{
            return redirect('login');
        }
    }
}
