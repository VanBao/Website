<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

class checkAdmin2
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
        if(!Auth::guard("admin")->user()->level == 2){
            Session::flash("messageFailed", "Bạn chưa đăng nhập");
            return redirect()->route("loginAdmin");
        }
        return $next($request);
    }
}
