<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\License;
use Symfony\Component\HttpFoundation\Response;

class CheckLicense
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip license check for login, logout, and license activation routes
        $excludedRoutes = ['users/login', 'users/logout', 'license/activate', 'license/settings'];
        
        foreach ($excludedRoutes as $route) {
            if ($request->is($route)) {
                return $next($request);
            }
        }

        // Get active license
        $license = License::where('status', 'active')->first();

        // If no license exists, redirect to license settings
        if (!$license) {
            return redirect('/license/settings')->with('error', 'No active license found. Please activate a license key.');
        }

        // Check license status
        $license->checkStatus();

        // If license is not valid, redirect to license settings
        if (!$license->isValid()) {
            return redirect('/license/settings')->with('error', 'Your license has expired. Please renew your license.');
        }

        // If license is expiring soon, add a flash message
        if ($license->isExpiringSoon()) {
            $days = $license->daysUntilExpiry();
            session()->flash('license_warning', "Your license will expire in {$days} days. Please renew soon.");
        }

        return $next($request);
    }
}




