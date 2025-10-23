<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\License;
use Carbon\Carbon;

class LicenseController extends Controller
{
    /**
     * Show the license settings page
     */
    public function settings()
    {
        $license = License::where('status', 'active')->first();
        return view('app.license_settings', compact('license'));
    }

    /**
     * Activate a license key
     */
    public function activate(Request $request)
    {
        $request->validate([
            'license_key' => 'required|string'
        ]);

        $licenseKey = $request->input('license_key');

        // Check if license key exists in database
        $license = License::where('license_key', $licenseKey)->first();

        if (!$license) {
            return back()->with('error', 'Invalid license key.');
        }

        // Deactivate any existing active licenses
        License::where('status', 'active')->update(['status' => 'suspended']);

        // Activate the new license
        $license->activate();

        return redirect('/license/settings')->with('success', 'License activated successfully!');
    }

    /**
     * Generate a new license key (for admin use)
     */
    public function generate(Request $request)
    {
        $request->validate([
            'type' => 'required|in:monthly,yearly,2year,lifetime',
            'school_id' => 'nullable|string',
            'notes' => 'nullable|string'
        ]);

        $licenseKey = 'BCBA-' . strtoupper(substr(md5(time() . rand()), 0, 12));

        $license = License::create([
            'license_key' => $licenseKey,
            'type' => $request->input('type'),
            'issued_date' => Carbon::now(),
            'status' => 'active',
            'school_id' => $request->input('school_id'),
            'notes' => $request->input('notes')
        ]);

        $license->activate();

        return back()->with('success', "License key generated: {$licenseKey}");
    }

    /**
     * Check license status via API
     */
    public function check()
    {
        $license = License::where('status', 'active')->first();

        if (!$license) {
            return response()->json(['valid' => false, 'message' => 'No active license']);
        }

        $license->checkStatus();

        return response()->json([
            'valid' => $license->isValid(),
            'type' => $license->type,
            'expiry_date' => $license->expiry_date,
            'days_until_expiry' => $license->daysUntilExpiry(),
            'expiring_soon' => $license->isExpiringSoon()
        ]);
    }
}




