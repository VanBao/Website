<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

use Session;

class checkAdmin
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
        if(!Auth::guard("admin")->check()){
            Session::flash("messageFailed", "Bạn chưa đăng nhập");
            return redirect()->route("loginAdmin");
        }
        return $next($request);
    }
}
