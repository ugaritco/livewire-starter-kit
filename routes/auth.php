<?php

use Heritage\Support\Facades\Route;
use Ugarit\WorkOS\Http\Requests\AuthKitAuthenticationRequest;
use Ugarit\WorkOS\Http\Requests\AuthKitLoginRequest;
use Ugarit\WorkOS\Http\Requests\AuthKitLogoutRequest;

Route::middleware(['guest'])->group(function () {
    Route::get('login', fn (AuthKitLoginRequest $request) => $request->redirect())->name('login');

    Route::get('authenticate', fn (AuthKitAuthenticationRequest $request) => tap(
        redirect()->intended(route('dashboard')),
        fn () => $request->authenticate(),
    ));
});

Route::post('logout', fn (AuthKitLogoutRequest $request) => $request->logout())
    ->middleware(['auth'])->name('logout');
