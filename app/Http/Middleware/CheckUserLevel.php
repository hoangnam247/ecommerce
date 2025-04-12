<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class CheckUserLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */    public function handle(Request $request, Closure $next)
    {
        if(!(Auth::check()))
        {
            
            return  redirect()->route('login');
        
        }
        if(((Auth::check())))
        {
            if( Auth::user()->level == 3 )
            {
                return  redirect()->route('home');
            }
        }
        return $next($request);

    }
    public function isLogin(){
        return true;
    }
}
