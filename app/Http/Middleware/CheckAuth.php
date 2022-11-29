<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if ((Auth::user()->role === 'user') && (Auth::user()->isAdmin === '0')) {
                abort(403);
            }elseif(in_array(Auth::user()->role,['web_master','super_admin']) === true && Auth::user()->isActive === '1'){
                Auth::logout();
                return redirect()->route('admin.login');
            }
        }
        return $next($request);
    }
}
