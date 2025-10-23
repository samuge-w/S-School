<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class LanguageController extends Controller
{
    /**
     * Switch the application language
     *
     * @param string $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function switchLang($locale)
    {
        // Normalize locale (e.g., pt-PT, pt_BR -> pt)
        $normalized = substr(strtolower(str_replace('_', '-', $locale)), 0, 2);

        // Validate locale
        if (!in_array($normalized, ['en', 'pt'], true)) {
            abort(400);
        }

        // Store in session and apply
        Session::put('locale', $normalized);
        App::setLocale($normalized);

        // Update user preference if logged in
        if (Auth::check()) {
            $user = Auth::user();
            $user->language = $normalized;
            $user->save();
        }

        return redirect()->back();
    }
}




