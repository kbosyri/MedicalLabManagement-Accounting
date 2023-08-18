<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAuthReception
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        error_log("check-auth-reception");
        if(Auth::user()->role)
        {
            error_log("role");
            if(!Auth::user()->role->finance)
            {
                error_log("fail");
                return response()->json(['message'=>'المستخدم غير مسموح له باستخدام هذا الرابط'],403);
            }
        }
        else if(!Auth::user()->is_admin && !Auth::user()->is_reception)
        {
            error_log("admin check");
            return response()->json([
                'message'=>'المستخدم غير مسموح له باستعمال هذا الرابط'
            ],403);
        }
        return $next($request);
    }
}
