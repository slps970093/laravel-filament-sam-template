<?php

namespace App\Http\Controllers;

use App\Http\Requests\SwitchLanguageRequest;
use Illuminate\Http\Request;

class SwitchLanguageController extends Controller
{
    public function setLang(SwitchLanguageRequest $request)
    {
        app()->setLocale($request->post('language'));

        return response()->noContent();
    }
}
