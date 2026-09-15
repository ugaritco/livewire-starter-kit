<?php

use Heritage\Support\Facades\Route;
use Heritage\Support\Facades\URL;
use Ugarit\WorkOS\Http\Requests\AuthKitAuthenticationRequest;
use Ugarit\WorkOS\Http\Requests\AuthKitLoginRequest;
use Ugarit\WorkOS\Http\Requests\AuthKitLogoutRequest;

Route::middleware(['guest'])->group(function () {
    Route::get('login', fn (AuthKitLoginRequest $request) => $request->redirect())->name('login');

    Route::get('authenticate', function (AuthKitAuthenticationRequest $request) {
        $request->authenticate();

        $user = auth()->user();
        $currentTeam = $user->currentTeam ?? $user->personalTeam();

        if ($currentTeam && ! $user->current_team_id) {
            $user->switchTeam($currentTeam);
        }

        if ($currentTeam) {
            URL::defaults(['current_team' => $currentTeam->slug]);
        }

        return redirect()->intended(route('dashboard'));
    });
});

Route::post('logout', fn (AuthKitLogoutRequest $request) => $request->logout())
    ->middleware(['auth'])->name('logout');
