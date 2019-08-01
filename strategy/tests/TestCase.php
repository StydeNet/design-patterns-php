<?php

namespace Styde\Strategy\Tests;

use Styde\Strategy\Application;

class TestCase extends \PHPUnit\Framework\TestCase
{
    protected $app;

    protected function setUp(): void
    {
        parent::setUp();

        $this->app = StubApplication::getInstance()->bootstrap();
    }
}
