<?php

namespace App\Http\Middleware;


use Closure;
// use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ProvidersRouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Https\RedirectResponse)  $next
     * @param strring|null ...$guards
     * @return \Illuminate\Https\Response\|Illuminate\Https\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards) 
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            }
        }
        
        return $next($request);
    }
}
