<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class AdminGuardMiddleware
{
    
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check() && Auth::user()->user_type === 'admin'){
            return $next($request);
        }else{
            return response()->json([
                'status' => 'error',
                'code' => 401,
                'message' => "You can't acces this request",
            ],401);
        }
        
    }
}
