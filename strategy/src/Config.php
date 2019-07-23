<?php

namespace Styde\Strategy;

use ArrayAccess;

class Config implements ArrayAccess
{
    protected $items;

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function set($key, $value)
    {
        $this->items[$key] = $value;
    }

    public function get($key, $default = null)
    {
        if ($this->has($key)) {
            return $this->items[$key];
        }

        return $default;
    }

    public function has($key)
    {
        return array_key_exists($key, $this->items);
    }

    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }

    public function offsetUnset($offset)
    {
        $this->set($offset, null);
    }
}