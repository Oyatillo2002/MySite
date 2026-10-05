<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->get('admin_logged_in')) {
            return redirect('/admin/login');
        }
        return $next($request);
    }
}
