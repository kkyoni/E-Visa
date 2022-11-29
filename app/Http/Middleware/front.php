<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
class front
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
        if(Auth::guard($guard)->check()) {
            if (in_array(Auth::user()->user_type,['user'])){
                if(Auth::user()->status == "active"){
                    return $next($request);
                }else{
                    Auth::logout();
                    return redirect()->route('front.index');
                }

            }else{
                session()->flash('isLogin', false);
                return redirect()->route('front.index');
            }
        } else{
            session()->flash('isLogin', false);
            return redirect()->route('front.index');
        }
    }
}
