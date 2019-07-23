<?php

namespace Styde\Strategy\Tests;

use Styde\Strategy\Config;

class ConfigTest extends TestCase
{
    /** @test */
    function sets_and_gets_values()
    {
        $config = new Config;
        $config->set('a-key', 'a value');
        $config->set('another-key', 'another value');

        $this->assertSame('a value', $config->get('a-key'));
        $this->assertSame('another value', $config->get('another-key'));
    }
}