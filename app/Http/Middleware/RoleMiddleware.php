<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

     // Thêm $role 
    public function handle(Request $request, Closure $next, $role ): Response
    {
        if($request->user()->role != $role){
            
            // abort(403);
            toastr()->error('Bạn không có quyền truy cập trang Admin');
            return redirect()->route('user.dashboard');
        }
        return $next($request);
    }
}
