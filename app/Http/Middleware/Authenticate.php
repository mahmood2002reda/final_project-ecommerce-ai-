<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->is('admin/dashboard')) {
            return route('admin.login');
        } elseif ($request->is('vendor/dashboard')) {
            return route('vendor.login');
        } else {
            return route('selection');
        }
    }
}
