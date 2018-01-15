<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

use Session;

class checkLogin
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
        if(!Auth::check()){
            Session::flash("messageFailed", "Bạn chưa đăng nhập");
            return redirect()->route("login");
        }
        return $next($request);
    }
}
