<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user =  Auth::user();

        if($user)
        {
            if($user['role'] === '1')
            {
                return $next($request);
            }
            return redirect()->route('admin.login');
        }
        else 
        {
            return redirect()->route('admin.login');
        }
    }
}
