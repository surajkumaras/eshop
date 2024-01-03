<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       
        if(Auth::user())
        {
            $user =  Auth::user()->role;
            
            if($user == 1)
            {
                return redirect()->route('dashboard');
            }

            if($user == 0)
            {
                return redirect()->route('home');
            }
        }
        

        return $next($request);
    }
}
