<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class Kyc
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
        if(Auth::user()->id_verify_status==1){
            return $next($request);
        }
        elseif(Auth::user()->id_verify_status==2){
            return redirect('/user/kyc-status');
        }
        else{
        return redirect('/user/identity-document')->with('kyc_needed', 'Buy a package and active your account for access this link');
        }
    }
}
