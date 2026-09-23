<?php

declare(strict_types=1);

use Heritage\Support\Facades\Route;
use Ugarit\Artifacts\I18n\Http\Controllers\LanguageController;
use Ugarit\Artifacts\I18n\Http\Controllers\LocaleController;
use Ugarit\Artifacts\I18n\Http\Controllers\TranslationController;

/*
|--------------------------------------------------------------------------
| Ugarit Internationalization (i18n) Artifact Local Web Routes
|--------------------------------------------------------------------------
|
| Registers in-application web resource routes for linguistic management:
| - Locales
| - Languages
| - Translations
|
| Enables local dashboard, language management, and content translation execution.
|
*/

Route::prefix(config('i18n.routes.web.prefix', 'i18n'))
    ->middleware(config('i18n.routes.web.middleware', ['web']))
    ->name(config('i18n.routes.web.as', 'i18n.'))
    ->group(function () {
        Route::resource('locales', LocaleController::class);
        Route::resource('languages', LanguageController::class);
        Route::resource('translations', TranslationController::class);
    });
