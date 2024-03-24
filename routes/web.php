<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('ajax/language', [\App\Http\Controllers\SwitchLanguageController::class,'setLang'])
    ->name('ajax.switch.language');

// 切換語系 middleware
Route::middleware('switch-lang')->group(function () {
    // 要切換語系的 path 放這邊
});
