<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Security
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::check()){
            return response()->view('login');
        }

        if(Auth::user()->status == 'admin'){
            return $next($request);
        }

        if(Auth::user()->status == 'lecturer'){

            if(str_contains($request->url(),'lecturer') && !str_contains($request->url(),'admin')){
                return $next($request);
            }
        }

        if(Auth::user()->status == 'student'){

            if(str_contains($request->url(),'student') && !str_contains($request->url(),'admin')){
                return $next($request);
            }
        }

        return response()->view('login');
    }
}
