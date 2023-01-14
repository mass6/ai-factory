<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocaleMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        $all = $request->session()?->all();
        logger()->info('session vars', $all);
        $locale = session()->get('locale');
        logger()->info('session locale', [$locale]);
        $browserLocale = $request->getLocale();
        logger()->info('browser locale', [$browserLocale]);

        $locale = $locale ?? $browserLocale;

        logger()->info('locale detected in middleware', [$locale]);
        if (!$locale || !array_key_exists($locale, config('languages'))) {
            $locale = config('app.fallback_locale');
            logger()->info('fallback locale set in middleware', [$locale]);
        }
        $this->setLocale($locale);

        return $next($request);
    }

    private function setLocale(string $locale):void
    {
        logger()->info('setting application locale', [$locale]);
        App::setLocale($locale);
        logger()->info('putting session application locale', [$locale]);
        session()->put('locale', $locale);
    }
}
