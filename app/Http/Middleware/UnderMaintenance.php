<?php

namespace App\Http\Middleware;

use App\SiteSetting;
use Closure;
use Illuminate\Support\Facades\Auth;
class UnderMaintenance
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
        $getSettingValue = SiteSetting::where('meta_key','site_maintenance')->first()->meta_value;
        if($getSettingValue === '1'){
            Auth::logout();
            return redirect()->route('underMaintenance');
        }else{
            return $next($request);
        }
    }
}
