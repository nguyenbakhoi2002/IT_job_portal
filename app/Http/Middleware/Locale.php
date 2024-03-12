<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    //dịch ngôn ngữ
    public function handle(Request $request, Closure $next)
    {
        if ($lang = $request->session()->get('lang')) {
            App::setLocale($lang);
        }

        return $next($request);
    }
}
