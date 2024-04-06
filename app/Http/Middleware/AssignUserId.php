<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AssignUserId
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            // Access controller
            $controller = $request->route()->controller;
            $controller->userId = Auth::id();
        }

        return $next($request);
    
    }
}


