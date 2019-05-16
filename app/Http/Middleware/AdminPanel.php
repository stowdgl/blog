<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class AdminPanel
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

        if (auth()->check()){
            if (auth()->user()->user_type){
                return $next($request);
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }
    }
}
