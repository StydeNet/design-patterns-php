<?php

namespace Styde\Strategy;

class Config
{
    protected $items = [];

    public function set($key, $value)
    {
        $this->items[$key] = $value;
    }

    public function get($key)
    {
        return $this->items[$key];
    }
}