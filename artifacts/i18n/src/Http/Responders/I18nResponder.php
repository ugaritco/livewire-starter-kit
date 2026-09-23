<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\I18n\Http\Responders;

use Heritage\Http\JsonResponse;
use Ugarit\Artifacts\I18n\Outcomes\I18nOutcome;

/**
 * Class I18nResponder
 *
 * Transforms I18nOutcome instances into standardized HTTP JSON responses.
 */
class I18nResponder
{
    /**
     * Convert a domain I18nOutcome into an HTTP response (JSON or Web redirect).
     *
     * @param  I18nOutcome  $outcome  The domain outcome envelope.
     * @param  int  $status  Default HTTP status code on success.
     * @return mixed Standardized JSON or Web redirect response.
     */
    public function toResponse(I18nOutcome $outcome, int $status = 200): mixed
    {
        $request = request();

        // Web form submission redirect (POST, PUT, PATCH, DELETE) when not expecting JSON
        if ($request && ! $request->expectsJson() && ! $request->is('api/*') && in_array($request->method(), ['POST', 'PUT', 'PATCH', 'DELETE'])) {
            if ($outcome->successful) {
                return back()->with('success', $outcome->message)->with('data', $outcome->data);
            }

            return back()->withErrors($outcome->errors ?? [$outcome->message])->withInput();
        }

        // Return JSON response using provided status on success or 422 on failure
        return new JsonResponse(
            $outcome->toArray(),
            $outcome->successful ? $status : 422
        );
    }
}
