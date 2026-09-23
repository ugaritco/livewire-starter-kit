<?php

declare(strict_types=1);

use Heritage\Support\Facades\Route;
use Ugarit\Artifacts\Geography\Http\Controllers\CityController;
use Ugarit\Artifacts\Geography\Http\Controllers\CountryController;
use Ugarit\Artifacts\Geography\Http\Controllers\DistrictController;
use Ugarit\Artifacts\Geography\Http\Controllers\GovernorateController;
use Ugarit\Artifacts\Geography\Http\Controllers\LocationController;

/*
|--------------------------------------------------------------------------
| Ugarit Geography Artifact Local Web Routes
|--------------------------------------------------------------------------
|
| Registers in-application web resource routes for territorial management:
| - Countries
| - Governorates
| - Cities
| - Districts
| - Locations
|
| Enables seamless direct dashboard, form submissions, and administrative UI integration.
|
*/

Route::prefix(config('geography.routes.web.prefix', 'geography'))
    ->middleware(config('geography.routes.web.middleware', ['web']))
    ->name(config('geography.routes.web.as', 'geography.'))
    ->group(function () {
        Route::resource('countries', CountryController::class);
        Route::resource('governorates', GovernorateController::class);
        Route::resource('cities', CityController::class);
        Route::resource('districts', DistrictController::class);
        Route::resource('locations', LocationController::class);
    });
