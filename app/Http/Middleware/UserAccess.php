<?php

namespace App\Http\Middleware;

use App\User;
use Auth;
use Closure;

class UserAccess
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
        if(Auth::user()->hasAnyRole('user')){
            return $next($request);
        }
        return redirect('login');
        
    }
}
