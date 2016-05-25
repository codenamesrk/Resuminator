<?php

namespace App\Http\Middleware;

use Closure;
use Redis;

class VerifyDomain
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
        $domain_ref = Redis::hget('order:' . $request->orderid,'domainref');
        // Domain Verification
        if($request->domainref == $domain_ref)
        {
            return $next($request);
        } else {
            return 'Domain verfication error';
        }
    }
}
