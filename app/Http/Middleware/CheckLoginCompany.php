<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLoginCompany
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth('company')->check()){
            if(auth('company')->user()->status ==0){
                //chuyển hướng đến trang thông báo bị chặn
                return  redirect()->route('company.block');
            }
            return $next($request);
        }
        return  redirect()->route('company.login');
    }
}
