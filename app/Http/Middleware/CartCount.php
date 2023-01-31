<?php

namespace App\Http\Middleware;

use App\Models\cart;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartCount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            error_log('has cart order');
            $cartCount = cart::where('userId', Auth::user()->id)->sum('qty');
        } else {
            $cartCount = 0;
        }

        config(['cartCount' => $cartCount]);
        return $next($request);
    }
}
