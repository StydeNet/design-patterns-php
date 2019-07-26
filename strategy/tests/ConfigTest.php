<?php

namespace Styde\Strategy\Tests;

use ArrayAccess;
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
    function gets_values_in_subarrays()
    {
        $config = new Config([
            'a1' => [
                'b1' => 'value in b1',
                'b2' => [
                    'c1' => [
                        'd1' => 'value in d1',
                    ],
                    'c2' => [
                        'd2' => 'value in d2',
                        'd3' => 'value in d3',
                    ],
                    'c3' => 'value in c3',
                ],
            ],
        ]);

        $this->assertIsArray($config['a1']);
        $this->assertSame('value in b1', $config['a1.b1']);
        $this->assertIsArray($config['a1.b2']);
        $this->assertSame('value in d1', $config['a1.b2.c1.d1']);
        $this->assertSame('value in d2', $config['a1.b2.c2.d2']);
        $this->assertSame('value in d3', $config['a1.b2.c2.d3']);
        $this->assertSame('value in c3', $config['a1.b2.c3']);

        $this->assertNull($config['a1.b99']);
        $this->assertSame(
            'a default value',
            $config->get('a1.b99', 'a default value')
        );
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

    /** @test */
    function implements_array_access()
    {
        $this->assertInstanceOf(ArrayAccess::class, new Config);
    }

    /** @test */
    function sets_and_gets_values_with_array_access()
    {
        $config = new Config;
        $config['a-key'] = 'a value';
        $config['another-key'] = 'another value';

        $this->assertSame('a value', $config['a-key']);
        $this->assertSame('another value', $config['another-key']);
    }

    /** @test */
    function checks_it_has_a_key_or_not_with_array_access()
    {
        $config = new Config([
            'a-key' => 'a value',
            'a-key-with-null' => null,
        ]);

        $this->assertArrayHasKey('a-key', $config);
        $this->assertArrayHasKey('a-key-with-null', $config);
        $this->assertArrayNotHasKey('non-existent-key', $config);
    }

    /** @test */
    function unsets_a_key()
    {
        $config = new Config([
            'a-key' => 'a value',
        ]);

        $this->assertArrayHasKey('a-key', $config);
        unset($config['a-key']);
        $this->assertArrayHasKey('a-key', $config);
        $this->assertNull($config['a-key']);
    }
}
