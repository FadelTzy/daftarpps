<?php

namespace App\Http\Middleware;

use App\Models\setting;
use Closure;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
class role
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
            if (Auth::user()->role == 2) {
                $seetingd =  setting::first();
                Session::put('namaapp', $seetingd->nama);
                Session::put('logoapp', $seetingd->logo);
                return $next($request);
                
                
            } else {
                return redirect()->intended('/admin');
            }
        
    }
}
