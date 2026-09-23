<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Http\Responders;

use Heritage\Http\JsonResponse;
use Ugarit\Artifacts\Geography\Outcomes\GeographyOutcome;

/**
 * Class GeographyResponder
 *
 * Transforms GeographyOutcome instances into standardized HTTP JSON responses.
 */
class GeographyResponder
{
    /**
     * Convert a domain GeographyOutcome into an HTTP response (JSON or Web redirect).
     *
     * @param  GeographyOutcome  $outcome  The domain outcome envelope.
     * @param  int  $status  Default HTTP status code on success.
     * @return mixed Standardized JSON or Web redirect response.
     */
    public function toResponse(GeographyOutcome $outcome, int $status = 200): mixed
    {
        $request = request();

        // Web form submission redirect (POST, PUT, PATCH, DELETE) when not expecting JSON
        if ($request && ! $request->expectsJson() && ! $request->is('api/*') && in_array($request->method(), ['POST', 'PUT', 'PATCH', 'DELETE'])) {
            if ($outcome->successful) {
                return back()->with('success', $outcome->message)->with('data', $outcome->data);
            }

            return back()->withErrors($outcome->errors ?? [$outcome->message])->withInput();
        }

        // Return JSON response using provided status on success or 422 Unprocessable Entity on failure
        return new JsonResponse(
            $outcome->toArray(),
            $outcome->successful ? $status : 422
        );
    }
}
