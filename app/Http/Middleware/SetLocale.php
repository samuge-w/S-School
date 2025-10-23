<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Priority order: Session > User Preference > Accept-Language > Config Default
        $locale = null;

        if (Session::has('locale')) {
            $locale = Session::get('locale');
        } elseif (Auth::check() && Auth::user()->language) {
            $locale = Auth::user()->language;
            Session::put('locale', $locale);
        } else {
            // Use browser preferred language when available
            $preferred = $request->getPreferredLanguage(['pt', 'en']);
            $locale = $preferred ?: config('app.locale', 'en');
        }

        // Normalize to base language (e.g., pt-PT, pt_BR -> pt)
        $normalizedLocale = $this->normalizeLocale($locale);

        $availableLocales = config('app.available_locales', ['en', 'pt']);
        if (in_array($normalizedLocale, $availableLocales, true)) {
            App::setLocale($normalizedLocale);
            // Persist normalized locale in session
            Session::put('locale', $normalizedLocale);
        }

        return $next($request);
    }

    private function normalizeLocale(string $locale): string
    {
        $standardized = strtolower(str_replace('_', '-', $locale));
        $base = substr($standardized, 0, 2);
        return in_array($base, ['en', 'pt'], true) ? $base : 'en';
    }
}




