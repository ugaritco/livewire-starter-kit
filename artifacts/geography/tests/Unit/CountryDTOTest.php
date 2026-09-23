<?php

declare(strict_types=1);

use Ugarit\Artifacts\Geography\DTOs\CountryDTO;

test('country dto converts from and to array cleanly', function () {
    $data = [
        'id' => 1,
        'name' => 'Saudi Arabia',
        'iso_alpha_2' => 'SA',
        'iso_alpha_3' => 'SAU',
        'dial_code' => '+966',
        'currency_code' => 'SAR',
        'flag_emoji' => '🇸🇦',
        'is_active' => true,
    ];

    $dto = CountryDTO::fromArray($data);

    expect($dto->name)->toBe('Saudi Arabia')
        ->and($dto->isoAlpha2)->toBe('SA')
        ->and($dto->dialCode)->toBe('+966')
        ->and($dto->toArray()['iso_alpha_3'])->toBe('SAU');
});
