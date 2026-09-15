<?php

namespace App\Http\Responses;

use App\Http\Responses\Concerns\RedirectsToCurrentTeam;
use Heritage\Http\JsonResponse;
use Ugarit\Fortify\Contracts\VerifyEmailResponse as VerifyEmailResponseContract;
use Ugarit\Fortify\Fortify;
use Symfony\Component\HttpFoundation\Response;

class VerifyEmailResponse implements VerifyEmailResponseContract
{
    use RedirectsToCurrentTeam;

    public function toResponse($request): Response
    {
        return $request->wantsJson()
            ? new JsonResponse('', 204)
            : redirect()->intended($this->redirectPathForCurrentTeam($request, Fortify::redirects('email-verification')).'?verified=1');
    }
}
