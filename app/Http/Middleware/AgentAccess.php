<?php

namespace App\Http\Middleware;

use Auth;
use App\User;
use Closure;

class AgentAccess
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
        if(Auth::user()->hasAnyRole('agent')){
            return $next($request);
        }
        redirect('home');
    }
}
