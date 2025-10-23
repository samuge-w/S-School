<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Illuminate\Support\Facades\Auth;
class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission_name)
    {
        // Allow admins by default
        if (Auth::check() && strcasecmp(Auth::user()->group, 'Admin') === 0) {
            return $next($request);
        }

        $role = strtolower(Auth::user()->group);

        // Check explicit permission assignment for the user's role
        $permission = DB::table('permission')
            ->where('permission_group', $role)
            ->where('permission_name', $permission_name)
            ->where('permission_type', 'yes')
            ->first();

        if ($permission) {
            return $next($request);
        }

        // Return a proper 403 Forbidden instead of a missing route redirect
        abort(403);
    }
}
