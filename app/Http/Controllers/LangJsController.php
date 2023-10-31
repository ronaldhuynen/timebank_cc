<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class LangJsController extends Controller
{
    /**
     * Returns a JavaScript file containing all the translations for the supported locales in Laravel.
     *
     * @return \Illuminate\Http\Response
     */
    public function js()
    {
        $locales = config('app.locales');
        $translations = [];

        foreach ($locales as $locale) {
            $strings = File::get(resource_path("lang/{$locale}.json"));
            ds($strings)->label('LanJsController');
            $translations[$locale] = json_decode($strings, true);
        }

        $js = "window.i18n = " . json_encode($translations) . ";";
        $response = response($js, 200);
        $response->header('Content-Type', 'text/javascript');
        return $response;
    }
}
