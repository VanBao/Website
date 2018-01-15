<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class checkOrder
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
        if(session('cart')->getNumOfProduct() == 0)
        {
            Session::flash("messageFailed", "Giỏ hàng rỗng. Vui lòng kiểm tra lại");
            return redirect()->route('cart');
        }
        return $next($request);
    }
}
