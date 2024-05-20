<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckCandidateStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        $user = Auth('candidate')->user();
        if ($user && $user->status == 0) {
            return  redirect()->route('client.block')->with('error', 'Tài khoản của bạn hiện đã bị chặn, hiện không thể thực hiện thao tác này');
        }

        return $next($request);
    }
}
