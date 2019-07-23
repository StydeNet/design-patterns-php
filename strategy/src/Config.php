<?php

namespace Styde\Strategy;

class Config
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
}