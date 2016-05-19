<?php

namespace App\Http\Middleware;

use Closure;

class ReportEditable
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
        if($request->report->resume->review->name == 'reviewing')
        {
            return $next($request);
        }
        \Session::flash('msg','Oops. You cant edit a published report!');
        return redirect()->route('admin::dashboard.reports');
    }
}
