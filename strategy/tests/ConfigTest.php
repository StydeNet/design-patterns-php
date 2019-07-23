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

    /** @test */
    function initializes_values()
    {
        $config = new Config([
            'a-key' => 'a value',
            'another-key' => 'another value',
        ]);

        $this->assertSame('a value', $config->get('a-key'));
        $this->assertSame('another value', $config->get('another-key'));
    }

    /** @test */
    function checks_it_has_a_key_or_not()
    {
        $config = new Config([
            'a-key' => 'a value',
            'a-key-with-null' => null,
        ]);

        $this->assertTrue($config->has('a-key'));
        $this->assertTrue($config->has('a-key-with-null'));
        $this->assertFalse($config->has('non-existent-key'));
    }

    /** @test */
    function get_returns_null_by_default()
    {
        $config = new Config;

        $this->assertNull($config->get('a-key'));
    }

    /** @test */
    function get_can_return_a_custom_default_value()
    {
        $config = new Config;

        $this->assertSame('a default value', $config->get('a-key', 'a default value'));
        $this->assertSame('another default value', $config->get('a-key', 'another default value'));
    }

    /** @test */
    function get_returns_null_if_the_key_contains_null()
    {
        $config = new Config([
            'a-key-with-null' => null,
        ]);

        $this->assertNull($config->get('a-key-with-null', 'a default value'));
    }
}
