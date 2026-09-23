<?php

declare(strict_types=1);

use Ugarit\Artifacts\I18n\DTOs\LocaleDTO;
use Ugarit\Artifacts\I18n\Enums\TextDirection;

test('locale dto converts from and to array cleanly', function () {
    $data = [
        'id' => 1,
        'code' => 'ar',
        'name' => 'العربية',
        'direction' => 'rtl',
        'script' => 'Arab',
        'regional' => 'ar_SA',
        'is_default' => true,
        'is_active' => true,
    ];

    $dto = LocaleDTO::fromArray($data);

    expect($dto->code)->toBe('ar')
        ->and($dto->direction)->toBe(TextDirection::RTL)
        ->and($dto->direction->isRtl())->toBeTrue()
        ->and($dto->toArray()['code'])->toBe('ar');
});
