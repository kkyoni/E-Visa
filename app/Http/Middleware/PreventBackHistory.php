<?php

namespace App\Http\Middleware;

use Closure;
use App\SiteSetting;
class PreventBackHistory
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
         $response = $next($request);
         return $response->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate')
             ->header('Pragma','no-cache')
             ->header('Expires','Fri, 01 Jan 1990 00:00:00 GMT');
    }
}
