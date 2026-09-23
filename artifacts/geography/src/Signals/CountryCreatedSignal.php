<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Signals;

use Ugarit\Artifacts\Geography\DTOs\CountryDTO;

/**
 * Class CountryCreatedSignal
 *
 * Domain event signal dispatched upon the creation of a Country entity.
 */
readonly class CountryCreatedSignal
{
    /**
     * Initialize the signal with the created country DTO.
     *
     * @param  CountryDTO  $country  The country DTO instance.
     */
    public function __construct(
        public CountryDTO $country
    ) {}
}
