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
| Ugarit Geography Artifact API Routes
|--------------------------------------------------------------------------
|
| Registers RESTful resource endpoints for all territorial entities:
| - Countries
| - Governorates
| - Cities
| - Districts
| - Locations
|
| Configurable via config('geography.routes.prefix') and config('geography.routes.middleware').
|
*/

Route::prefix(config('geography.routes.prefix', 'api/v1/geography'))
    ->middleware(config('geography.routes.middleware', ['api']))
    ->group(function () {
        Route::apiResource('countries', CountryController::class);
        Route::apiResource('governorates', GovernorateController::class);
        Route::apiResource('cities', CityController::class);
        Route::apiResource('districts', DistrictController::class);
        Route::apiResource('locations', LocationController::class);
    });
