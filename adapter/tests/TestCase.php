<?php

namespace Styde\Tests;

use Mockery as m;

class TestCase extends \PHPUnit\Framework\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        //...
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        m::close();
    }
}
