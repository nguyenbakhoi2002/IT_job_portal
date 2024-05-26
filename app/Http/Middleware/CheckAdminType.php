<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use  Session;
class CheckAdminType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth('admin')->user();
        if ($user && $user->type == 0) {
            Session::flash('error', 'Tài khoản của bạn không có quyền thực hiện hành động này');
            return redirect()->back();
        }

        return $next($request);
    }
}
