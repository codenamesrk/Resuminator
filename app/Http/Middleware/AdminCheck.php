<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminCheck
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
        if( $user->hasRole('admin')) {
            return $next($request);    
        } 
        Auth::logout();
        alert()->error('Sorry. You don\'t have the privileges');
        return redirect()->guest('login');        
    }
}
