<?php

namespace Styde\Tests;

use Mockery;

class TestCase extends \PHPUnit\Framework\TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    protected function removeIndentation($expected)
    {
        return str_replace([PHP_EOL, '    '], '', $expected);
    }
}
