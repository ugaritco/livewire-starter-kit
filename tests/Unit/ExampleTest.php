<?php

namespace Tests\Unit;

use Heritage\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_that_true_is_true(): void
    {
        $this->assertTrue(true);
    }
}
