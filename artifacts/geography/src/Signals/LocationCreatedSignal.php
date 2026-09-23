<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Signals;

use Ugarit\Artifacts\Geography\DTOs\LocationDTO;

/**
 * Class LocationCreatedSignal
 *
 * Domain event signal dispatched upon the creation of a Location entity.
 */
readonly class LocationCreatedSignal
{
    /**
     * Initialize the signal with the created location DTO.
     *
     * @param  LocationDTO  $location  The location DTO instance.
     */
    public function __construct(
        public LocationDTO $location
    ) {}
}
