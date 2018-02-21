<?php

namespace Styde\Tests;

use Mockery;

class TestCase extends \PHPUnit\Framework\TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }
}