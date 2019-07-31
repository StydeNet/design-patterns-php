<?php

namespace Styde\Strategy\Tests;

use Styde\Strategy\Application;

class TestCase extends \PHPUnit\Framework\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        (new Application())->bootstrap();
    }
}
