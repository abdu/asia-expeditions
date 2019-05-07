<?php

namespace App\Http\Middleware;

use Closure;
use App\Cart;
use App\User;
use Session;


class CheckCustomer
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
        // return $next($request);

        if (\Auth::check()){
            return $next($request);
        }else{
            return redirect ('register');
        }

    }
}
