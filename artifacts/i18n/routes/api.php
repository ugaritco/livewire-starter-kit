<?php

declare(strict_types=1);

use Heritage\Support\Facades\Route;
use Ugarit\Artifacts\I18n\Http\Controllers\LanguageController;
use Ugarit\Artifacts\I18n\Http\Controllers\LocaleController;
use Ugarit\Artifacts\I18n\Http\Controllers\TranslationController;

/*
|--------------------------------------------------------------------------
| Ugarit Internationalization (i18n) Artifact API Routes
|--------------------------------------------------------------------------
|
| Registers RESTful resource endpoints for linguistic entities:
| - Locales
| - Languages
| - Translations
|
| Configurable via config('i18n.routes.prefix') and config('i18n.routes.middleware').
|
*/

Route::prefix(config('i18n.routes.prefix', 'api/v1/i18n'))
    ->middleware(config('i18n.routes.middleware', ['api']))
    ->group(function () {
        Route::apiResource('locales', LocaleController::class);
        Route::apiResource('languages', LanguageController::class);
        Route::apiResource('translations', TranslationController::class);
    });
