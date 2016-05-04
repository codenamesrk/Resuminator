<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepositoryInterface;

class RedirectVerifiedUser
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
        if (Auth::check()) {            
            if(Auth::user()->has_paid) {
                if(Auth::user()->has_uploaded) {
                    return redirect()->route('user::dashboard');
                }
                return redirect()->route('user::upload.resume');
            }
            return redirect()->route('user::payment.resume');
        } 
        return $next($request); 
    }
}
