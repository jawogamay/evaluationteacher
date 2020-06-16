<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($guard == "web_admin" && Auth::guard($guard)->check()) {
            return redirect(route('admin.home'));
        }
        if ($guard == "web_faculty" && Auth::guard($guard)->check()) {
            return redirect(route('faculty.home'));
        }
        if ($guard == "web_student" && Auth::guard($guard)->check()) {
            return redirect(route('student.home'));
        }

        return $next($request);
    }
}
