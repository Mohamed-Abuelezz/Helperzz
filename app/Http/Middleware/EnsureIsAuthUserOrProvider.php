<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureIsAuthUserOrProvider
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
     //  dd(Auth::guard('provider')->check());
  //   dd(Auth::check());

        if (Auth::check() == false && Auth::guard('provider')->check()  == false) {

           // dd(Auth::check());
            if ($request->ajax() || $request->wantsJson()) {
                return myAjaxResponse(null,'Unauthorized',401);
            } else {

                return redirect(route('auth'));

            }

        }

        // if (Auth::guard('provider')->check() == false) {
        //     if ($request->ajax() || $request->wantsJson()) {
        //         return myAjaxResponse(null,'Unauthorized',401);
        //     } else {

        //         return redirect(route('auth'));

        //     }
        // }

        return $next($request);
    }
}
