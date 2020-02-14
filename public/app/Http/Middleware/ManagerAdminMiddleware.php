<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;


class ManagerAdminMiddleware
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
        $isAdmin = auth()->user()->hasRole('admin');
        $isManager = auth()->user()->hasRole('manager');
         if( $isAdmin || $isManager){
             return $next($request);
         }
         abort(403);
    }
}
