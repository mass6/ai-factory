<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LanguageController extends Controller
{
    public function switchLang(Request $request, string $lang)
    {
        if (array_key_exists($lang, config('languages'))) {
            logger()->info('current locale setting', [session()->get('locale')]);
            logger()->info('setting preferred locale in session', [$lang]);
            session()->put('locale', $lang);
        }
        return Redirect::back();
    }
}
