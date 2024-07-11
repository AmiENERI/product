<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
public function switchLang($lang)
{
if (array_key_exists($lang, config('app.locales'))) {
App::setLocale($lang);
}
return redirect()->back();
}
}